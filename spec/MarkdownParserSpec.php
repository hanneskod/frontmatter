<?php

declare(strict_types = 1);

namespace spec\hkod\frontmatter;

use hkod\frontmatter\MarkdownParser;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MarkdownParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(MarkdownParser::CLASS);
    }

    function it_parses_markdown(\Parsedown $parser)
    {
        $this->beConstructedWith($parser);
        $parser->parse('markdown-content')->willReturn('parsed');
        $this->__invoke('markdown-content')->shouldEqual('parsed');
    }
}
