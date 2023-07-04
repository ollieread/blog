<?php

$input  = __DIR__ . '/data/';

$redirects = json_decode(file_get_contents($input . 'redirects.json'), true, 512, JSON_THROW_ON_ERROR);
$stub      = file_get_contents(__DIR__ . '/stubs/redirect.blade.stub');

foreach ($redirects as $item) {
    $from  = $item['from'];
    $to    = $item['to'];
    $parts = explode('/', trim($from, '/'));
    $file  = array_pop($parts);
    $path  = __DIR__ . '/../source';

    foreach ($parts as $part) {
        $path .= '/' . $part;

        if (! is_dir($path) && ! mkdir($path)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $path));
        }
    }

    file_put_contents($path .'/' . $file . '.blade.php', str_replace('{{REDIRECT}}', $to, $stub));
}