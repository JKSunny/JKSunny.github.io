FROM php:8.3-cli-alpine

RUN apk add --no-cache \
    curl \
    dcron

WORKDIR /app

COPY ./app /app
COPY cron/github-metrics-cron /etc/crontabs/root

EXPOSE 8080

CMD sh -c "crond -f & php -S 0.0.0.0:8080 -t /app"