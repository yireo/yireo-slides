#!/bin/bash
ssh yireo-php 'cd /home/yireo/public_html/yireo-slides && git pull origin master && composer install'

yireo opcache:refresh 8.1
#ssh root@yireo "/etc/init.d/php73-php-fpm reload"
