#!/bin/bash
ssh yireo 'cd /home/yireo/public_html/slides.yireo.com && git pull origin master && composer install'

yireo opcache:refresh 7.3
