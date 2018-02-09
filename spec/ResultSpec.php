<?php

declare(strict_types = 1);

namespace spec\hkod\frontmatter;

use hkod\frontmatter\Result;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ResultSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('frontmatter', 'body');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Result::CLASS);
    }

    function it_contains_frontmatter()
    {
        $this->getFrontmatter()->shouldEqual('frontmatter');
    }

    function it_contains_body()
    {
        $this->getBody()->shouldEqual('body');
    }
}
