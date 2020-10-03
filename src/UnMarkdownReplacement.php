<?php
namespace UnMarkdown;

use InvalidArgumentException;

/**
 * Class UnMarkdownReplacement
 * @package UnMarkdown
 * @author Guido Krömer <mail@cacodaemon.de>
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
     * @var string|callable
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
        $this->regex = $regex;
        $this->setReplace($replace);
        $this->description = $description;
        $this->type = $type;
    }

    /**
     * Perfroms the replace operation on the given text.
     *
     * @param string $markdown The text to modify.
     * @return string The modified text.
     */
    public function replace(string $markdown): string
    {
        if ($this->isString) {
            return preg_replace($this->regex, $this->replace, $markdown);
        }

        return preg_replace_callback($this->regex, $this->replace, $markdown);
    }

    /**
     * Sets the replacement string or function.
     *
     * @param string|callable $replace The replacement operation.
     */
    public function setReplace($replace): void
    {
        $this->isString = is_string($replace);
        if (!is_callable($replace) && !$this->isString) {
            throw new InvalidArgumentException('$replace must be of type string or a callable.');
        }

        $this->replace = $replace;
    }

    /**
     * Gets the description text.
     *
     * @return string The description.
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
