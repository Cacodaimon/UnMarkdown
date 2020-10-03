<?php
namespace UnMarkdown;

use InvalidArgumentException;

/**
 * Class UnMarkdownReplacement
 * @package UnMarkdown
 */
class UnMarkdownReplacement
{
    const TYPE_LEAF_BLOCK = 1;
    const TYPE_CONTAINER_BLOCK = 2;
    const TYPE_INLINE = 3;
    const TYPE_SPECIAL = 4; // special: no markdown e.g. cleanup etc.

    /**
     * @var string
     */
    private $regex;

    /**
     * @var string
     */
    private $replace;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $type;

    /**
     * @var boolean
     */
    private $isCallable;

    /**
     * @var boolean
     */
    private $isString;

    /**
     * UnMarkdownReplacement constructor.
     *
     * @param string $regex The regex to exec.
     * @param string|callable $replace The replace pattern or callback function.
     * @param string $description A short description about the replacement e.g. "heading with # (h1 to h6)"
     * @param int $type Any of TYPE_INLINE, TYPE_LEAF_BLOCK, TYPE_CONTAINER_BLOCK or TYPE_SPECIAL, only informational.
     */
    public function __construct(string $regex, $replace, string $description = '', int $type = self::TYPE_INLINE)
    {
        $this->isCallable = is_callable($replace);
        $this->isString = is_string($replace);
        if (!$this->isCallable && !$this->isString) {
            throw new InvalidArgumentException('$replace must be a string or a callable.');
        }

        $this->regex = $regex;
        $this->replace = $replace;
        $this->description = $description;
        $this->type = $type;
    }

    /**
     * @param string $markdown
     * @return string
     */
    public function replace(string $markdown): string
    {
        if ($this->isString) {
            return preg_replace($this->regex, $this->replace, $markdown);
        }

        return preg_replace_callback($this->regex, $this->replace, $markdown);
    }
}
