<?php

namespace App\Listeners;

use TightenCo\Jigsaw\Jigsaw;

class GenerateIndex
{
    public function handle(Jigsaw $jigsaw)
    {
        $data = collect($jigsaw->getCollection('articles'))
            ->merge($jigsaw->getCollection('archive'))
            ->map(function ($page) use ($jigsaw) {
                return [
                    'title'    => $page->title,
                    'category' => $page->category,
                    'link'     => rightTrimPath($jigsaw->getConfig('baseUrl')) . $page->getPath(),
                    'snippet'  => $page->description,
                ];
            })->values();

        file_put_contents($jigsaw->getDestinationPath() . '/index.json', json_encode($data));
    }
}
