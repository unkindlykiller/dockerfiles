<?php

namespace Shaarli\NetscapeBookmarkParser;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Katzgrau\KLogger\Logger;

/**
 * Generic Netscape bookmark parser
 */
class NetscapeBookmarkParser implements LoggerAwareInterface
{
    protected $keepNestedTags;
    protected $defaultTags;
    protected $defaultPub;
    protected $normalizeDates;
    protected $dateRange;
    protected $items;

    /**
     * @var LoggerInterface instance.
     */
    protected $logger;

    const TRUE_PATTERN = 'y|yes|on|checked|ok|1|true|array|\+|okay|yes|t|one';
    const FALSE_PATTERN = 'n|no|off|empty|null|false|nil|0|-|exit|die|neg|f|zero|void';

    /**
     * Instantiates a new NetscapeBookmarkParser
     *
     * @param bool   $keepNestedTags Tag links with parent folder names
     * @param array  $defaultTags    Tag all links with these values
     * @param mixed  $defaultPub     Link publication status if missing
     *                               - '1' => public
     *                               - '0' => private)
     * @param string $logDir         Log directory
     * @param bool   $normalizeDates Whether parsed dates are expected to fall within
     *                               a given date/time interval
     * @param string $dateRange      Delta used to compute the "acceptable" date/time interval
     */
    public function __construct(
        $keepNestedTags=true,
        $defaultTags=array(),
        $defaultPub='0',
        $logDir=null,
        $normalizeDates=true,
        $dateRange='30 years'
    )
    {
        if ($keepNestedTags) {
            $this->keepNestedTags = true;
        }
        if ($defaultTags) {
            $this->defaultTags = $defaultTags;
        } else {
            $this->defaultTags = array();
        }
        $this->defaultPub = $defaultPub;

        $this->setLogger(new Logger(
            $logDir == null ? __DIR__ . '/logs/' : $logDir,
            LogLevel::INFO,
            array(
                'prefix' => 'import.',
                'extension' => 'log',
            )
        ));

        $this->normalizeDates = $normalizeDates;
        $this->dateRange = $dateRange;
    }

    /**
     * Parses a Netscape bookmark file
     *
     * @param string $filename Bookmark file to parse
     *
     * @return array An associative array containing parsed links
     */
    public function parseFile($filename)
    {
        $this->logger->info('Starting to parse '. $filename);
        return $this->parseString(file_get_contents($filename));
    }

    /**
     * Parses a string containing Netscape-formatted bookmarks
     *
     * Output format:
     *
     *     Array
     *     (
     *         [0] => Array
     *             (
     *                 [note]  => Some comments about this link
     *                 [pub]   => 1
     *                 [tags]  => a list of tags
     *                 [time]  => 1459371397
     *                 [title] => Some page
     *                 [uri]   => http://domain.tld:5678/some-page.html
     *             )
     *         [1] => Array
     *             (
     *                 ...
     *             )
     *     )
     *
     * @param string $bookmarkString String containing Netscape bookmarks
     *
     * @return array An associative array containing parsed links
     */
    public function parseString($bookmarkString) {
        $i = 0;
        $next = false;
        $folderTags = array();

        $lines = explode("\n", $this->sanitizeString($bookmarkString));

        foreach ($lines as $line_no => $line) {
            $this->logger->info('PARSING LINE #'. $line_no);
            $this->logger->debug('[#' . $line_no . '] Content: '. $line);
            if (preg_match('/^<h\d.*>(.*)<\/h\d>/i', $line, $m1)) {
                // a header is matched:
                // - links may be grouped in a (sub-)folder
                // - append the header's content to the folder tags
                $tag = $this->sanitizeTagString($m1[1]);

                $folderTags[] = $tag;
                $this->logger->debug('[#' . $line_no . '] Header found: ' . $tag);
                continue;

            } elseif (preg_match('/^<\/DL>/i', $line)) {
                // </DL> matched: stop using header value
                $tag = array_pop($folderTags);
                $this->logger->debug('[#' . $line_no . '] Header ended: ' . $tag);
                continue;
            }

            if (preg_match('/<a/i', $line, $m2)) {
                $this->logger->debug('[#' . $line_no . '] Link found');
                if (preg_match('/href="(.*?)"/i', $line, $m3)) {
                    $this->items[$i]['uri'] = $m3[1];
                    $this->logger->debug('[#' . $line_no . '] URL found: ' . $m3[1]);
                } else {
                    $this->items[$i]['uri'] = '';
                    $this->logger->debug('[#' . $line_no . '] Empty URL');
                }

                if (preg_match('/<a.*>(.*?)<\/a>/i', $line, $m4)) {
                    $this->items[$i]['title'] = $m4[1];
                    $this->logger->debug('[#' . $line_no . '] Title found: ' . $m4[1]);
                } else {
                    $this->items[$i]['title'] = 'untitled';
                    $this->logger->debug('[#' . $line_no . '] Empty title');
                }

                if (preg_match('/(description|note)="(.*?)"/i', $line, $m5)) {
                    $this->items[$i]['note'] = $m5[2];
                    $this->logger->debug('[#' . $line_no . '] Content found: ' . substr($m5[2], 0, 50) . '...');
                } elseif (preg_match('/<dd>(.*?)$/i', $line, $m6)) {
                    $this->items[$i]['note'] = str_replace('<br>', "\n", $m6[1]);
                    $this->logger->debug('[#' . $line_no . '] Content found: ' . substr($m6[1], 0, 50) . '...');
                } else {
                    $this->items[$i]['note'] = '';
                    $this->logger->debug('[#' . $line_no . '] Empty content');
                }

                $tags = array();
                if ($this->defaultTags) {
                    $tags = array_merge($tags, $this->defaultTags);
                }
                if ($this->keepNestedTags) {
                    $tags = array_merge($tags, $folderTags);
                }

                if (preg_match('/(tags?|labels?|folders?)="(.*?)"/i', $line, $m7)) {
                    $tags = array_merge($tags, explode(' ', strtr($m7[2], ',', ' ')));
                }
                $this->items[$i]['tags'] = implode(' ', $tags);
                $this->logger->debug('[#' . $line_no . '] Tag list: '. $this->items[$i]['tags']);

                if (preg_match('/add_date="(.*?)"/i', $line, $m8)) {
                    $this->items[$i]['time'] = $this->parseDate($m8[1]);
                } else {
                    $this->items[$i]['time'] = time();
                }
                $this->logger->debug('[#' . $line_no . '] Date: '. $this->items[$i]['time']);

                if (preg_match('/(public|published|pub)="(.*?)"/i', $line, $m9)) {
                    $this->items[$i]['pub'] = $this->parseBoolean($m9[2], false) ? 1 : 0;
                } elseif (preg_match('/(private|shared)="(.*?)"/i', $line, $m10)) {
                    $this->items[$i]['pub'] = $this->parseBoolean($m10[2], true) ? 0 : 1;
                } else {
                    $this->items[$i]['pub'] = $this->defaultPub;
                }
                $this->logger->debug('[#' . $line_no . '] Visibility: '. ($this->items[$i]['pub'] ? 'public' : 'private'));

                $i++;
            }
        }
        ksort($this->items);
        $this->logger->info('File parsing ended');
        return $this->items;
    }

    /**
     * Parses a formatted date
     *
     * @see http://php.net/manual/en/datetime.formats.compound.php
     * @see http://php.net/manual/en/function.strtotime.php
     *
     * @param string $date formatted date
     *
     * @return int Unix timestamp corresponding to a successfully parsed date,
     *             else current date and time
     */
    public function parseDate($date)
    {
        if (strtotime('@'.$date)) {
            // Unix timestamp
            if ($this->normalizeDates) {
                $date = $this->normalizeDate($date);
            }
            return strtotime('@'.$date);
        } else if (strtotime($date)) {
            // attempt to parse a known compound date/time format
            return strtotime($date);
        }
        // current date & time
        return $time;
    }

    /**
     * Normalizes a date by supposing it is comprised in a given range
     *
     * Although most bookmarking services return dates formatted as a Unix epoch
     * (seconds elapsed since 1970-01-01 00:00:00) or human-readable strings,
     * some services return microtime epochs (microseconds elapsed since
     * 1970-01-01 00:00:00.000000) WITHOUT using a delimiter for the microseconds
     * part...
     *
     * This is likely to raise issues in the distant future!
     *
     * @see https://stackoverflow.com/questions/33691428/datetime-with-microseconds
     * @see https://stackoverflow.com/questions/23929145/how-to-test-if-a-given-time-stamp-is-in-seconds-or-milliseconds
     * @see https://stackoverflow.com/questions/539900/google-bookmark-export-date-format
     * @see https://www.wired.com/2010/11/1110mars-climate-observer-report/
     *
     * @param string $epoch     Unix timestamp to normalize
     *
     * @return string Unix timestamp in seconds, within the expected range
     */
    public function normalizeDate($epoch) {
        $date = new \DateTime('@'.$epoch);
        $maxDate = new \DateTime('+'.$this->dateRange);

        for ($i = 1; $date > $maxDate; $i++) {
            // trim the provided date until it falls within the expected range
            $date = new \DateTime('@'.substr($epoch, 0, strlen($epoch) - $i));
        }

        return $date->getTimestamp();
    }


    /**
     * Parses the value of a supposedly boolean attribute
     *
     * @param string $value   Attribute value to evaluate
     *
     * @return mixed 'true' when the value is evaluated as true
     *               'false' when the value is evaluated as false
     *               $this->defaultPub if the value is not a boolean
     */
    public function parseBoolean($value) {
        if (! $value) {
            return false;
        }
        if (! is_string($value)) {
            return true;
        }

        if (preg_match("/^(".self::TRUE_PATTERN.")$/i", $value)) {
            return true;
        }
        if (preg_match("/^(".self::FALSE_PATTERN.")$/i", $value)) {
            return false;
        }
        return $this->defaultPub;
    }

    /**
     * Sanitizes the content of a string containing Netscape bookmarks
     *
     * This removes:
     * - comment blocks
     * - metadata: DOCTYPE, H1, META, TITLE
     * - extra newlines, trailing spaces and tabs
     *
     * @param string $bookmarkString Original bookmark string
     *
     * @return string Sanitized bookmark string
     */
    public static function sanitizeString($bookmarkString)
    {
        $sanitized = $bookmarkString;

        // trim comments
        $sanitized = preg_replace('@<!--.*?-->@mis', '', $sanitized);

        // keep one XML element per line to prepare for linear parsing
        $sanitized = preg_replace('@>(\s*?)<@mis', ">\n<", $sanitized);

        // trim unused metadata
        $sanitized = preg_replace('@(<!DOCTYPE|<META|<TITLE|<H1|<P).*\n@i', '', $sanitized);

        // trim whitespace
        $sanitized = trim($sanitized);

        // trim carriage returns, replace tabs by a single space
        $sanitized = str_replace(array("\r", "\t"), array('',' '), $sanitized);

        // convert multiline descriptions to one-line descriptions
        // line feeds are converted to <br>
        $sanitized = preg_replace_callback(
            '@<DD>(.*?)(</?(:?DT|DD|DL))@mis',
            function($match) {
                return '<DD>'.str_replace("\n", '<br>', trim($match[1])).PHP_EOL. $match[2];
            },
            $sanitized
        );

        // convert multiline descriptions inside <A> tags to one-line descriptions
        // line feeds are converted to <br>
        $sanitized = preg_replace_callback(
            '@<A(.*?)</A>@mis',
            function($match) {
                return '<A'.str_replace("\n", '<br>', trim($match[1])).'</A>';
            },
            $sanitized
        );

        // concatenate all information related to the same entry on the same line
        // e.g. <A HREF="...">My Link</A><DD>List<br>- item1<br>- item2
        $sanitized = preg_replace('@\n<br>@mis', "<br>", $sanitized);
        $sanitized = preg_replace('@\n<DD@i', '<DD', $sanitized);

        return $sanitized;
    }

    /**
     * Sanitizes a space-separated list of tags
     *
     * This removes:
     * - duplicate whitespace
     * - leading punctuation
     * - undesired characters
     *
     * @param string $tagString Space-separated list of tags
     *
     * @return string Sanitized space-separated list of tags
     */
    public static function sanitizeTagString($tagString)
    {
        $tags = explode(' ', strtolower($tagString));

        foreach ($tags as $key => &$value) {
            if (ctype_alnum($value)) {
                continue;
            }

            // trim leading punctuation
            $value = preg_replace('/^[[:punct:]]/', '', $value);

            // trim all but alphanumeric characters, underscores and non-leading dashes
            $value = preg_replace('/[^\p{L}\p{N}\-_]++/u', '', $value);

            if ($value == '') {
                unset($tags[$key]);
            }
        }

        return implode(' ', $tags);
    }

    /**
     * Set the logger, must be PSR-3 compliant.
     *
     * @see https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md
     *
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}
