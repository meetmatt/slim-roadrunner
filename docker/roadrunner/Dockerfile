FROM 512k/roadrunner:1.5.1

RUN apk add --update --no-cache \
    php php-json

ENTRYPOINT ["/usr/bin/rr", "serve", "-dv", "-c", "/etc/roadrunner/.rr.yaml"]