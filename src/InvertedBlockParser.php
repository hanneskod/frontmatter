<?php

declare(strict_types = 1);

namespace hkod\frontmatter;

/**
 * An inverted block parser expects the fronmatter last instead of first in the file
 */
class InvertedBlockParser extends BlockParser
{
    public function parse(string $source): Result
    {
        $result = parent::parse($this->invertLineOrder($source));

        return new Result(
            $this->invertLineOrder($result->getFrontmatter()),
            $this->invertLineOrder($result->getBody())
        );
    }

    private function invertLineOrder(string $source): string
    {
        $stream = fopen('php://memory','r+');
        fwrite($stream, $source);
        rewind($stream);

        $lines = [];

        while (($line = fgets($stream)) !== false) {
            $lines[] = $line;
        }

        return implode(array_reverse($lines));
    }
}
