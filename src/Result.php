<?php

declare(strict_types = 1);

namespace hkod\frontmatter;

/**
 * Parser result data transfer object
 */
class Result
{
    /**
     * @var mixed
     */
    private $frontmatter;

    /**
     * @var mixed
     */
    private $body;

    /**
     * @param mixed $frontmatter The frontmatter parse result
     * @param mixed $body        The body parse result
     */
    public function __construct($frontmatter, $body)
    {
        $this->frontmatter = $frontmatter;
        $this->body = $body;
    }

    /**
     * @return mixed Whatever was loaded as the frontmatter parse result
     */
    public function getFrontmatter()
    {
        return $this->frontmatter;
    }

    /**
     * @return mixed Whatever was loaded as the body parse result
     */
    public function getBody()
    {
        return $this->body;
    }
}
