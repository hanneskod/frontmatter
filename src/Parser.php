<?php

declare(strict_types = 1);

namespace hkod\frontmatter;

/**
 * The frontmatter parser
 */
class Parser
{
    /**
     * @var BlockParser
     */
    private $blockParser;

    /**
     * @var callable
     */
    private $frontmatterParser;

    /**
     * @var callable
     */
    private $bodyParser;

    public function __construct(
        callable $frontmatterParser = null,
        callable $bodyParser = null,
        BlockParser $blockParser = null
    ) {
        $this->frontmatterParser = $frontmatterParser ?: new VoidParser;
        $this->bodyParser = $bodyParser ?: new VoidParser;
        $this->blockParser = $blockParser ?: new BlockParser;
    }

    public function parse(string $source, $context = null): Result
    {
        $blocks = $this->blockParser->parse($source);

        return new Result(
            ($this->frontmatterParser)($blocks->getFrontmatter(), $context),
            ($this->bodyParser)($blocks->getBody(), $context)
        );
    }
}
