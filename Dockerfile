FROM alpine:3
RUN apk update && apk upgrade && apk add --no-cache php7 && apk add --no-cache php7-mysqli && apk add --no-cache php7-sockets
WORKDIR /appli
COPY appliccm .
COPY script.sh .
RUN chmod +x script.sh
ENTRYPOINT ["sh","script.sh"]


