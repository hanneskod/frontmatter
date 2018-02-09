<?php

declare(strict_types = 1);

namespace hkod\frontmatter;

/**
 * Separate the frontmatter from document body
 */
class BlockParser
{
    /**
     * Parsing first line
     */
    const STATE_INIT = 'STATE_INIT';

    /**
     * Parsing frontmatter
     */
    const STATE_FRONTMATTER = 'STATE_FRONTMATTER';

    /**
     * Parsing body
     */
    const STATE_BODY = 'STATE_BODY';

    /**
     * @var string
     */
    private $frontmatterStartToken;

    /**
     * @var string
     */
    private $frontmatterEndToken;

    public function __construct(string $frontmatterStartToken = '---', string $frontmatterEndToken = '---')
    {
        $this->frontmatterStartToken = $frontmatterStartToken;
        $this->frontmatterEndToken = $frontmatterEndToken;
    }

    public function parse(string $source): Result
    {
        $state = self::STATE_INIT;

        $blocks = [
            self::STATE_FRONTMATTER => '',
            self::STATE_BODY => ''
        ];

        $stream = fopen('php://memory','r+');
        fwrite($stream, $source);
        rewind($stream);

        while (($line = fgets($stream)) !== false) {
            $trimmedLine = rtrim($line, "\r\n");

            if ($state == self::STATE_INIT && $trimmedLine == $this->frontmatterStartToken) {
                $state = self::STATE_FRONTMATTER;
                continue;
            }

            if ($state == self::STATE_FRONTMATTER && $trimmedLine == $this->frontmatterEndToken) {
                $state = self::STATE_BODY;
                continue;
            }

            if ($state == self::STATE_INIT) {
                $state = self::STATE_BODY;
            }

            $blocks[$state] .= $line;
        }

        return new Result($blocks[self::STATE_FRONTMATTER], $blocks[self::STATE_BODY]);
    }
}
