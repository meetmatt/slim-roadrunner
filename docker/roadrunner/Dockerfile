FROM 512k/roadrunner:1.5.1

RUN apk add --update --no-cache \
    php php-json

ADD entrypoint.sh /entrypoint.sh

ENTRYPOINT ["/bin/sh", "/entrypoint.sh"]