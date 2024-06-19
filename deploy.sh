#!/bin/bash
git commit . -m 'Pending changes'
git push origin master
ssh yireo-php 'cd /home/yireo/public_html/yireo-slides && git pull origin master && composer install'

yireo opcache:refresh 8.2
