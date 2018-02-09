<?php

declare(strict_types = 1);

namespace hkod\frontmatter;

/**
 * Interface for building complex parsers
 */
class ParserBuilder
{
    /**
     * @var callable
     */
    private $frontmatterParser;

    /**
     * @var callable
     */
    private $bodyParser;

    /**
     * @var BlockParser
     */
    private $blockParser;

    public function __construct()
    {
        $this->frontmatterParser = new VoidParser;
        $this->bodyParser = new VoidParser;
        $this->blockParser = new BlockParser;
    }

    public function addFrontmatterPass(callable $parser): self
    {
        $oldParser = $this->frontmatterParser;

        $this->frontmatterParser = function ($source, $context) use ($parser, $oldParser) {
            return $parser($oldParser($source, $context), $context);
        };

        return $this;
    }

    public function addBodyPass(callable $parser): self
    {
        $oldParser = $this->bodyParser;

        $this->bodyParser = function ($source, $context) use ($parser, $oldParser) {
            return $parser($oldParser($source, $context), $context);
        };

        return $this;
    }

    public function setBlockParser(BlockParser $blockParser): self
    {
        $this->blockParser = $blockParser;
        return $this;
    }

    public function buildParser(): Parser
    {
        return new Parser(
            $this->frontmatterParser,
            $this->bodyParser,
            $this->blockParser
        );
    }
}
