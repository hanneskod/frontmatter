<?php

declare(strict_types = 1);

namespace spec\hkod\frontmatter;

use hkod\frontmatter\MustacheParser;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MustacheParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(MustacheParser::CLASS);
    }

    function it_parses_markdown(\Mustache_Engine $parser)
    {
        $this->beConstructedWith($parser);
        $parser->render('template', 'context')->willReturn('parsed');
        $this->__invoke('template', 'context')->shouldEqual('parsed');
    }
}
