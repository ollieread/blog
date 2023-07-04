<?php

$input  = __DIR__ . '/data/';
$output = __DIR__ . '/../source/_archive/';

$categories = json_decode(file_get_contents($input . 'categories.json'), true, 512, JSON_THROW_ON_ERROR);
$articles   = json_decode(file_get_contents($input . 'articles.json'), true, 512, JSON_THROW_ON_ERROR);
$stub       = file_get_contents(__DIR__ . '/stubs/article.md.stub');

foreach ($articles as $item) {
    $article = [
        'title'       => $item['name'],
        'description' => $item['excerpt'],
        'date'        => $item['post_at'],
        'category'    => $categories[$item['category_id']],
        'archived'    => 'true',
        'content'     => $item['content'],
    ];

    $file = str_replace(
        [
            '{{TITLE}}',
            '{{DESCRIPTION}}',
            '{{DATE}}',
            '{{CATEGORY}}',
            '{{ARCHIVED}}',
            '{{CONTENT}}',
        ],
        $article,
        $stub
    );

    file_put_contents($output . $item['slug'] . '.md', $file);
}