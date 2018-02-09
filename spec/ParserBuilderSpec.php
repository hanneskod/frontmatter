<?php

declare(strict_types = 1);

namespace spec\hkod\frontmatter;

use hkod\frontmatter\ParserBuilder;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ParserBuilderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ParserBuilder::CLASS);
    }
}
