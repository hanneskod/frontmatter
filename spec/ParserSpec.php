<?php

declare(strict_types = 1);

namespace spec\hkod\frontmatter;

use hkod\frontmatter\Parser;
use hkod\frontmatter\BlockParser;
use hkod\frontmatter\Result;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Parser::CLASS);
    }

    function it_parses_blocks_by_default()
    {
        $this->parse('foobar')->shouldBeLike(new Result('', 'foobar'));
    }

    function it_calls_frontmatter_and_body_parsers(BlockParser $blockParser, Result $result)
    {
        $concat = function ($source, $context) {
            return $source . $context;
        };

        $this->beConstructedWith($concat, $concat, $blockParser);

        $blockParser->parse('foobar', 'baz')->willReturn($result);
        $result->getFrontmatter()->willReturn('foo');
        $result->getBody()->willReturn('bar');

        $this->parse('foobar', 'baz')->shouldBeLike(new Result('foobaz', 'barbaz'));
    }
}
