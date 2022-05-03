#!/bin/bash
echo $1 | sudo -S -k service redis-server stop
echo $1 | sudo -S -k service redis-server start
echo $1 | sudo -S -k /usr/local/nginx/sbin/nginx -s stop
echo $1 | sudo -S -k /usr/local/nginx/sbin/nginx -s start