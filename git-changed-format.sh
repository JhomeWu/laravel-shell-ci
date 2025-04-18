#!/bin/bash
files=$(git diff --name-only --diff-filter=ACM HEAD -- '*.php')

if [ -n "$files" ]; then
    echo "Running rector"
    ./vendor/bin/rector process $files

    echo "Running php_codesniffer cbf..."
    ./vendor/bin/phpcbf $files

    echo "Running php_codesniffer checks..."
    ./vendor/bin/phpcs $files

    echo "Running laravel/pint fixes"
	./vendor/bin/pint  $files
fi
