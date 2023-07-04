<?php
declare(strict_types=1);

namespace App\Markdown\Notices;

use League\CommonMark\Parser\Block\BlockStart;
use League\CommonMark\Parser\Block\BlockStartParserInterface;
use League\CommonMark\Parser\Cursor;
use League\CommonMark\Parser\MarkdownParserStateInterface;

class NoticeStartParser implements BlockStartParserInterface
{
    public function tryStart(Cursor $cursor, MarkdownParserStateInterface $parserState): ?BlockStart
    {
        if ($cursor->isIndented()) {
            return BlockStart::none();
        }

        $indent = $cursor->getIndent();
        $notice = $cursor->match('/^(\:\:\:[a-z\-]*)/');

        if ($notice === null) {
            return BlockStart::none();
        }

        $notice       = ltrim($notice, " \t");
        $noticeLength = strlen($notice);
        $type         = substr($notice, 3);

        return BlockStart::of(new NoticeParser($noticeLength, $indent, $type))->at($cursor);
    }
}