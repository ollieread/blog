<?php
declare(strict_types=1);

namespace App\Markdown;

use App\Markdown\Notices\Notice;
use App\Markdown\Notices\NoticeRenderer;
use App\Markdown\Notices\NoticeStartParser;
use App\Markdown\Renderers\HeadingRenderer;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\Extension\ExtensionInterface;

class OlliereadExtension implements ExtensionInterface
{
    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment->addBlockStartParser(new NoticeStartParser(), -100)
                    ->addRenderer(Notice::class, new NoticeRenderer())
                    ->addRenderer(Heading::class, new HeadingRenderer());
    }
}