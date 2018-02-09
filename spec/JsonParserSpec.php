<?php

declare(strict_types = 1);

namespace spec\hkod\frontmatter;

use hkod\frontmatter\JsonParser;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JsonParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(JsonParser::CLASS);
    }

    function it_parses_json()
    {
        $this->__invoke('{"a": "b"}')->shouldEqual(['a' => 'b']);
    }
}
