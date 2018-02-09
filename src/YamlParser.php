<?php

declare(strict_types = 1);

namespace hkod\frontmatter;

use Symfony\Component\Yaml\Parser;

/**
 * Parse yaml content using symfony yaml
 */
class YamlParser
{
    /**
     * @var Parser
     */
    private $parser;

    public function __construct(Parser $parser = null)
    {
        $this->parser = $parser ?: new Parser;
    }

    public function __invoke($yaml)
    {
        return $this->parser->parse($yaml);
    }
}
