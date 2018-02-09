<?php

declare(strict_types = 1);

namespace hkod\frontmatter;

/**
 * A markdown parser using Parsedown
 */
class MarkdownParser
{
    /**
     * @var \Parsedown
     */
    private $parser;

    public function __construct(\Parsedown $parser = null)
    {
        $this->parser = $parser ?: new \Parsedown;
    }

    public function __invoke($markdown)
    {
        return $this->parser->parse($markdown);
    }
}
