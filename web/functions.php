<?php

function debug($data)
{
    print_r('<pre>');
    print_r($data);
    print_r('</pre>');
}

function populateENV()
{
    $envFile = __DIR__ . '/../.env';

    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        list($name, $value) = explode('=', $line, 2);

        $name = trim($name);
        $value = trim($value);

        putenv("$name=$value");
        $_ENV[$name] = $value;
    }
}