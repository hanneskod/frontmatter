<?php

declare(strict_types = 1);

namespace spec\hkod\frontmatter;

use hkod\frontmatter\YamlParser;
use Symfony\Component\Yaml\Parser;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class YamlParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(YamlParser::CLASS);
    }

    function it_parses_yaml(Parser $parser)
    {
        $this->beConstructedWith($parser);
        $parser->parse('yaml-content')->willReturn('parsed');
        $this->__invoke('yaml-content')->shouldEqual('parsed');
    }
}
