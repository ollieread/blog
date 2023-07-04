<?php
declare(strict_types=1);

namespace App\Markdown\Notices;

use League\CommonMark\Node\Block\AbstractBlock;

class Notice extends AbstractBlock
{
    /**
     * @var string
     */
    private string $type;

    private string $content;

    /**
     * @param string $type
     */
    public function __construct(string $type)
    {
        parent::__construct();

        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return Notice
     */
    public function setContent(string $content): Notice
    {
        $this->content = $content;
        return $this;
    }
}