#!/bin/bash
files=$(git diff --name-only --diff-filter=ACM HEAD -- '*.php')

if [ -n "$files" ]; then
    echo "Running ./vendor/bin/phpstan analyse --memory-limit 2G -c phpstan.neon" $@ $files
    ./vendor/bin/phpstan analyse --memory-limit 2G -c phpstan.neon $@ $files
fi
