<?php
declare(strict_types=1);

namespace App\Markdown\Notices;

use League\CommonMark\Extension\CommonMark\Node\Block\BlockQuote;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\CommonMark\Xml\XmlNodeRendererInterface;

class NoticeRenderer implements NodeRendererInterface, XmlNodeRendererInterface
{
    /**
     * @param BlockQuote $node
     *
     * {@inheritDoc}
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): \Stringable
    {
        Notice::assertInstanceOf($node);

        $attrs = array_merge($node->data->get('attributes'), ['class' => 'notice notice--' . $node->getType()]);

        $filling        = $childRenderer->renderNodes($node->children());
        $innerSeparator = $childRenderer->getInnerSeparator();

        if ($filling === '') {
            return new HtmlElement('div', $attrs, $innerSeparator);
        }

        return new HtmlElement(
            'div',
            $attrs,
            $innerSeparator . $filling . $innerSeparator
        );
    }

    public function getXmlTagName(Node $node): string
    {
        return 'notice';
    }

    /**
     * @param BlockQuote $node
     *
     * @return array<string, scalar>
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function getXmlAttributes(Node $node): array
    {
        Notice::assertInstanceOf($node);

        return ['type' => $node->getType()];
    }
}