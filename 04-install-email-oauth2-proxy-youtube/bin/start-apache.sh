#!/bin/bash

docker run --rm -p 8080:80 -v $( pwd )/html:/var/www/html jmacdonald/php:8.1.12-apache-imap

