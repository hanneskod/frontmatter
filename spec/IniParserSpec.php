<?php

declare(strict_types = 1);

namespace spec\hkod\frontmatter;

use hkod\frontmatter\IniParser;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IniParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(IniParser::CLASS);
    }

    function it_parses_ini_strings()
    {
        $ini = "
[first_section]
var = foo

[second_section]
var = false
";
        $this->__invoke($ini)->shouldEqual([
            'first_section' => [
                'var' => 'foo'
            ],
            'second_section' => [
                'var' => false
            ]
        ]);
    }
}
