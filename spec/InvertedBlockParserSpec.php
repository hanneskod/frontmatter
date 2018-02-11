<?php

declare(strict_types = 1);

namespace spec\hkod\frontmatter;

use hkod\frontmatter\InvertedBlockParser;
use hkod\frontmatter\Result;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InvertedBlockParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(InvertedBlockParser::CLASS);
    }

    function it_parses_content()
    {
        $source = "body
---
frontmatter
---
";

        $this->parse($source)->shouldBeLike(new Result("frontmatter\n", "body\n"));
    }

    function it_ignores_frontmatter_if_not_on_last_line()
    {
        $source = "body
---
frontmatter
---

";

        $this->parse($source)->shouldBeLike(new Result('', "body\n---\nfrontmatter\n---\n\n"));
    }

    function it_recognizes_body_with_no_frontmatter()
    {
        $this->parse("body")->shouldBeLike(new Result('', "body"));
    }

    function it_can_set_custom_separators()
    {
        $this->beConstructedWith("*", "*");
        $source = "body
*
frontmatter
*
";

        $this->parse($source)->shouldBeLike(new Result("frontmatter\n", "body\n"));
    }

    function it_ignores_multiple_separators()
    {
        $source = "body
---
still body
---
frontmatter
---
";

        $this->parse($source)->shouldBeLike(new Result("frontmatter\n", "body\n---\nstill body\n"));
    }
}
