<?php

declare(strict_types = 1);

namespace hkod\frontmatter;

/**
 * Parse json content
 */
class JsonParser
{
    public function __invoke($source)
    {
        return json_decode($source, true);
    }
}
