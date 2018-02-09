<?php

declare(strict_types = 1);

namespace hkod\frontmatter;

/**
 * Parser of mustache templates
 */
class MustacheParser
{
    /**
     * @var \Mustache_Engine
     */
    private $mustache;

    public function __construct(\Mustache_Engine $mustache = null)
    {
        $this->mustache = $mustache ?: new \Mustache_Engine;
    }

    public function __invoke($source, $context)
    {
        return $this->mustache->render($source, $context);
    }
}
