<?php
declare(strict_types=1);

namespace App\Markdown\Renderers;

use Illuminate\Support\Str;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\CommonMark\Xml\XmlNodeRendererInterface;

class HeadingRenderer implements NodeRendererInterface, XmlNodeRendererInterface
{
    /**
     * @param Heading $node
     *
     * {@inheritDoc}
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): \Stringable
    {
        Heading::assertInstanceOf($node);

        $tag         = 'h' . ($node->getLevel() + 1);
        $attrs       = $node->data->get('attributes');
        $contents    = $childRenderer->renderNodes($node->children());
        $anchorName  = Str::slug(strip_tags($contents));
        $attrs['id'] = $anchorName;
        $anchor      = new HtmlElement('a', [
            'href'  => '#' . $anchorName,
            'class' => 'link link--anchor',
        ]);

        return new HtmlElement($tag, $attrs, $anchor . $contents);
    }

    public function getXmlTagName(Node $node): string
    {
        return 'heading';
    }

    /**
     * @param Heading $node
     *
     * @return array<string, scalar>
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function getXmlAttributes(Node $node): array
    {
        Heading::assertInstanceOf($node);

        return ['level' => $node->getLevel()];
    }
}