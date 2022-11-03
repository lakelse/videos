#!/bin/bash

docker run \
  --env IMAP_USERNAME=$IMAP_USERNAME \
  --env IMAP_PASSWORD=$IMAP_PASSWORD \
  --network host \
  --rm \
  -v $( pwd )/html:/var/www/html \
  jmacdonald/php:8.1.12-apache-imap
