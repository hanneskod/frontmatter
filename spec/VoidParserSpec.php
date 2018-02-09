<?php

declare(strict_types = 1);

namespace spec\hkod\frontmatter;

use hkod\frontmatter\VoidParser;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class VoidParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(VoidParser::CLASS);
    }

    function it_returns_value_to_parse()
    {
        $this->__invoke('foobar')->shouldEqual('foobar');
    }
}
