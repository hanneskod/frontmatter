<?php

declare(strict_types = 1);

namespace hkod\frontmatter;

/**
 * Parse ini formatted strings
 */
class IniParser
{
    public function __invoke(string $ini): array
    {
        return parse_ini_string($ini, true, INI_SCANNER_TYPED);
    }
}
