<?php

declare(strict_types = 1);

namespace hkod\frontmatter;

/**
 * A void parser that simply returns source
 */
class VoidParser
{
    public function __invoke($source)
    {
        return $source;
    }
}
