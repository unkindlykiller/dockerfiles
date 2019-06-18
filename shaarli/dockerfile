FROM xataz/nginx-php

RUN cd /tmp \
&& wget https://github.com/shaarli/Shaarli/releases/download/v0.10.4/shaarli-v0.10.4-full.tar.gz \
&& tar xzf shaarli-v0.10.4-full.tar.gz \
&& cp -r /tmp/Shaarli / \
&& cd /Shaarli && chmod +w cache pagecache data tmp \
&& apk del --quiet --no-cache --progress --purge && rm -rf /var/cache/apk/* /usr/src/*

COPY nginx/sites-enabled/shaarli.conf /nginx/sites-enabled/

COPY nginx/conf.d/*.conf /nginx/conf.d/

COPY startup /usr/local/bin/

RUN chmod +x /usr/local/bin/startup

VOLUME /Shaarli

ENTRYPOINT ["/usr/local/bin/startup"]
CMD ["/bin/s6-svscan", "/etc/s6.d"]
