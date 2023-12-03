#!/bin/bash

if ! pgrep -f "nodejs/index.js" > /dev/null; then
    systemctl restart node-script.service
fi