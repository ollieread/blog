<?php

use App\Markdown\OlliereadExtension;
use Carbon\Carbon;
use Illuminate\Support\Str;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use League\CommonMark\Extension\DisallowedRawHtml\DisallowedRawHtmlExtension;
use League\CommonMark\Extension\Embed\Bridge\OscaroteroEmbedAdapter;
use League\CommonMark\Extension\Embed\EmbedExtension;
use League\CommonMark\Extension\ExternalLink\ExternalLinkExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\Extension\Mention\Generator\MentionGeneratorInterface;
use League\CommonMark\Extension\Mention\Mention;
use League\CommonMark\Extension\Mention\MentionExtension;
use League\CommonMark\Extension\Strikethrough\StrikethroughExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\Extension\TableOfContents\TableOfContentsExtension;
use League\CommonMark\Extension\TaskList\TaskListExtension;
use League\CommonMark\Node\Inline\AbstractInline;
use Torchlight\Block;
use Torchlight\Commonmark\V2\TorchlightExtension;

$torchlight = new TorchlightExtension();
$torchlight->useCustomBlockRenderer(function (Block $block) {
    $inner = '';

    // Clones come from multiple themes.
    $blocks = $block->clones();
    array_unshift($blocks, $block);

    foreach ($blocks as $block) {
        $code  = strtr($block->highlighted, [
            "<{{&#39;?php&#39;}}" => '<?php',
            "{{&#39;@&#39;}}"     => '&#64;',
            '@{{'                 => '{{',
            '@{!!'                => '{!!',
        ]);
        $inner .= "<code {$block->attrsAsString()}class='{$block->classes}' style='{$block->styles}'>{$code}</code>";
    }

    return "<pre>$inner</pre>";
});

return [
    'baseUrl'         => '',
    'production'      => false,
    'siteName'        => 'ollieread.com',
    'siteDescription' => 'Home of Ollie Read',
    'siteAuthor'      => 'Ollie Read',
    'commonmark'      => [
        'config'     => [
            'external_link'     => [
                'internal_hosts'     => 'localhost',
                'open_in_new_window' => true,
                'html_class'         => 'link link--external',
                'nofollow'           => '',
                'noopener'           => 'external',
                'noreferrer'         => 'external',
            ],
            'embed'             => [
                'adapter'         => new OscaroteroEmbedAdapter(), // See the "Adapter" documentation below
                'allowed_domains' => ['youtube.com', 'twitter.com', 'github.com'],
                'fallback'        => 'link',
            ],
            'heading_permalink' => [
                'html_class'        => 'hidden',
                'id_prefix'         => '',
                'fragment_prefix'   => '',
                'insert'            => 'before',
                'min_heading_level' => 1,
                'max_heading_level' => 6,
                'title'             => 'Permalink',
                'symbol'            => '',
                'aria_hidden'       => true,
            ],
            'mentions'          => [
                'github_handle'  => [
                    'prefix'    => 'gh:',
                    'pattern'   => '[a-z\d](?:[a-z\d]|-(?=[a-z\d])){0,38}(?!\w)',
                    'generator' => new class implements MentionGeneratorInterface {

                        public function generateMention(Mention $mention): ?AbstractInline
                        {
                            $mention->setUrl(sprintf('https://github.com/%s', $mention->getIdentifier()));
                            $mention->setLabel(sprintf('@%s', $mention->getIdentifier()));

                            return $mention;
                        }
                    },
                ],
                'twitter_handle' => [
                    'prefix'    => 'tw:',
                    'pattern'   => '[A-Za-z0-9_]{1,15}(?!\w)',
                    'generator' => new class implements MentionGeneratorInterface {

                        public function generateMention(Mention $mention): ?AbstractInline
                        {
                            $mention->setUrl(sprintf('https://twitter.com/%s', $mention->getIdentifier()));
                            $mention->setLabel(sprintf('@%s', $mention->getIdentifier()));

                            return $mention;
                        }
                    },
                ],
            ],
            'table_of_contents' => [
                'html_class'        => 'toc',
                'position'          => 'placeholder',
                'style'             => 'bullet',
                'min_heading_level' => 1,
                'max_heading_level' => 6,
                'normalize'         => 'relative',
                'placeholder'       => '[[toc]]',
            ],
        ],
        'extensions' => [
            new AutolinkExtension(),
            new DisallowedRawHtmlExtension(),
            new StrikethroughExtension(),
            new TableExtension(),
            new TaskListExtension(),
            new AttributesExtension(),
            new ExternalLinkExtension(),
            new EmbedExtension(),
            new MentionExtension(),
            new HeadingPermalinkExtension(),
            new TableOfContentsExtension(),
            $torchlight,
            new OlliereadExtension(),
        ],
    ],

    // collections
    'collections'     => [
        'posts'      => [
            'author' => 'Author Name', // Default author, if not provided in a post
            'sort'   => '-date',
            'path'   => 'blog/{filename}',
        ],
        'archive'    => [
            'author' => 'Ollie Read',
            'sort'   => '-date',
            'path'   => 'archive/read/{filename}',
        ],
        'articles'    => [
            'author' => 'Ollie Read',
            'sort'   => '-date',
            'path'   => 'articles/read/{filename}',
        ],
    ],

    // helpers
    'getDate'         => function ($page) {
        return Carbon::createFromFormat('U', $page->date);
    },
    'isActive'        => function ($page, $pattern) {
        return Str::is($pattern, $page->getPath());
    },
];
