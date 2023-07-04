<?php
declare(strict_types=1);

namespace App\Markdown\Notices;

use League\CommonMark\Node\Block\AbstractBlock;
use League\CommonMark\Parser\Block\AbstractBlockContinueParser;
use League\CommonMark\Parser\Block\BlockContinue;
use League\CommonMark\Parser\Block\BlockContinueParserInterface;
use League\CommonMark\Parser\Block\BlockContinueParserWithInlinesInterface;
use League\CommonMark\Parser\Cursor;
use League\CommonMark\Parser\InlineParserEngineInterface;

class NoticeParser extends AbstractBlockContinueParser implements BlockContinueParserWithInlinesInterface
{
    private int    $length;
    private string $content = '';
    private int    $offset;
    private string $type;
    private Notice $block;

    public function __construct(int $length, int $offset, string $type)
    {

        $this->length = $length;
        $this->offset = $offset;
        $this->type   = $type;
        $this->block  = new Notice($this->type);
    }

    public function getBlock(): Notice
    {
        return $this->block;
    }

    public function isContainer(): bool
    {
        return true;
    }

    public function canHaveLazyContinuationLines(): bool
    {
        return true;
    }

    public function canContain(AbstractBlock $childBlock): bool
    {
        return true;
    }

    public function tryContinue(Cursor $cursor, BlockContinueParserInterface $activeBlockParser): ?BlockContinue
    {
        $match = $cursor->match('/^ {0,' . $this->offset . '}:::/');

        if ($match !== null) {
            return BlockContinue::finished();
        }

        return BlockContinue::at($cursor);
    }

    public function addLine(string $line): void
    {
        $this->content .= "\n" . $line;
    }

    public function parseInlines(InlineParserEngineInterface $inlineParser): void
    {
        $inlineParser->parse($this->content, $this->block);
    }
}