<?php

declare(strict_types = 1);

namespace spec\hkod\frontmatter;

use hkod\frontmatter\BlockParser;
use hkod\frontmatter\Result;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BlockParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BlockParser::CLASS);
    }

    function it_parses_content()
    {
        $source = "---
frontmatter
---
body";

        $this->parse($source)->shouldBeLike(new Result("frontmatter\n", "body"));
    }

    function it_ignores_frontmatter_if_not_on_first_line()
    {
        $source = "
---
frontmatter
---
body";

        $this->parse($source)->shouldBeLike(new Result('', "\n---\nfrontmatter\n---\nbody"));
    }

    function it_recognizes_body_with_no_frontmatter()
    {
        $this->parse("body")->shouldBeLike(new Result('', "body"));
    }

    function it_can_set_custom_separators()
    {
        $this->beConstructedWith("*", "*");
        $source = "*
frontmatter
*
body";

        $this->parse($source)->shouldBeLike(new Result("frontmatter\n", "body"));
    }

    function it_ignores_multiple_separators()
    {
        $this->beConstructedWith("-", "*");
        $source = "-
f
-
*
*
b
-";

        $this->parse($source)->shouldBeLike(new Result("f\n-\n", "*\nb\n-"));
    }
}
