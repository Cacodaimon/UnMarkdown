<?php
namespace UnMarkdown;

/**
 * Class Stripper
 * TODO: find a better name for this…
 * @package UnMarkdown
 */
class Stripper
{
    /**
     * @var array
     */
    private $replacements;

    /**
     * @var array
     */
    private $codeBlocks;

    /**
     * Stripper constructor.
     *
     * @param string $linkPrefix
     * @param string $imagePrefix
     * @param string $quotePrefix
     * @param string $unorderedListPrefix
     * @param string $checkedTaskListPrefix
     * @param string $unCheckedTaskListPrefix
     */
    public function __construct(
        string $linkPrefix = '🔗 ',
        string $imagePrefix = '🖼️ ',
        string $quotePrefix = '💬 ',
        string $unorderedListPrefix = '⚫',
        string $checkedTaskListPrefix = '⚫ ❌ ',
        string $unCheckedTaskListPrefix = '⚫ ⭕ '
    )
    {
        $this->replacements = [
            new UnMarkdownReplacement(
                '/(?:^|\n)(?:={3,}|-{3,}|\*{3,}|_{3,})(?:\s*?)(?:\n|\Z)/',
                '',
                'heading (======, ------), hr (---, ***, ___)',
                UnMarkdownReplacement::TYPE_LEAF_BLOCK
            ),
            new UnMarkdownReplacement(
                '/(?:\ *(`|~){3})(.*)\n(.*)(?:\s*?\1{3})/Us',
                function ($matches) {
                    return $this->preserveCodeBlock($matches);
                },
                'code block (```, ```java, ~~~, ~~~php)',
                UnMarkdownReplacement::TYPE_LEAF_BLOCK
            ),
            new UnMarkdownReplacement(
                '/(?:^|\n)\s*\>{1,}\s(.*)/',
                "\n$quotePrefix\${1}",
                'blockquotes',
                UnMarkdownReplacement::TYPE_CONTAINER_BLOCK
            ),
            new UnMarkdownReplacement(
                '/(?:^|\n)\s*#{1,6}\s(.*)/',
                "\n\${1}\n",
                'heading with #',
                UnMarkdownReplacement::TYPE_LEAF_BLOCK
            ),
            new UnMarkdownReplacement(
                '/(_|\*)\1((?!(\1| )).+?)\1{2}/',
                '${2}',
                'strong with _|*',
                UnMarkdownReplacement::TYPE_INLINE
            ),
            new UnMarkdownReplacement(
                '/(\*|_)((?!(\1| )).+?)\1/',
                '${2}',
                'italic with _|*',
                UnMarkdownReplacement::TYPE_INLINE
            ),
            new UnMarkdownReplacement(
                '/~~((?!(~| )).+?)~~/',
                '${1}',
                'strikethrough',
                UnMarkdownReplacement::TYPE_INLINE
            ),
            new UnMarkdownReplacement(
                '/(?:^|\n)(\s*)(\*|\+|-) {1,3}\[x\] +((?!\2).+?)(?:\n|\Z)/i',
                "\${1}$checkedTaskListPrefix\${3}",
                'task list (checked) with *|+|-',
                UnMarkdownReplacement::TYPE_CONTAINER_BLOCK
            ),
            new UnMarkdownReplacement(
                '/(?:^|\n)(\s*)(\*|\+|-) {1,3}\[ \] +((?!\2).+?)(?:\n|\Z)/i',
                "\${1}$unCheckedTaskListPrefix\${3}",
                'task list (un checked) with *|+|-',
                UnMarkdownReplacement::TYPE_CONTAINER_BLOCK
            ),
            new UnMarkdownReplacement(
                '/(?:^|\n)(\s*)(\*|\+|-)((?!\2).+?)(?:\n|\Z)/',
                "\${1}$unorderedListPrefix\${3}",
                'list with *|+|-',
                UnMarkdownReplacement::TYPE_CONTAINER_BLOCK
            ),
            new UnMarkdownReplacement(
                '/!\[([^\[]+)\]\(([^\)]+)\)/',
                "$imagePrefix\${1}",
                'image (inline)',
                UnMarkdownReplacement::TYPE_INLINE
            ),
            new UnMarkdownReplacement(
                '/!\[([^\[]+)\]\[([^\[]+)\]/',
                "$imagePrefix\${1}",
                'image (reference)',
                UnMarkdownReplacement::TYPE_INLINE
            ),
            new UnMarkdownReplacement(
                '/\[([^\[]+)\]\(([^\)]+)\)/',
                "$linkPrefix\${2}",
                'link (inline)',
                UnMarkdownReplacement::TYPE_INLINE
            ),
            new UnMarkdownReplacement(
                '/\[([^\[]+)\]\[([^\[]+)\]/',
                "$linkPrefix\${1}",
                'link (reference)',
                UnMarkdownReplacement::TYPE_INLINE
            ),
            new UnMarkdownReplacement(
                '/`((?!`).+?)`/',
                '${1}',
                'code (inline)',
                UnMarkdownReplacement::TYPE_INLINE
            ),
        ];
    }

    /**
     * Strips markdown from the given strings.
     *
     * @param string $markdown
     * @return string
     */
    public function strip(string $markdown): string
    {
        return $this->replaceAll($markdown);
    }

    /**
     * Performs all UnMarkdownReplacement in the given order.
     *
     * @param string $markdown
     * @return string
     */
    private function replaceAll(string $markdown): string {
        $this->codeBlocks = [];
        $result = $markdown;
        foreach ($this->replacements as $replacement) {
            $result = $replacement->replace($result);
        }

        return $this->recoverCodeBlocks($result);
    }

    /**
     * Stores code blocks temporary to prevent modification.
     * Replaces code blocks with a placeholder e.g. @@@<id>@@@.
     *
     * @param array $matches
     * @return string
     */
    private function preserveCodeBlock(array $matches): string
    {
        $id = count($this->codeBlocks);
        $this->codeBlocks[$id = "@@@CODE_BLOCK:$id@@@"] = "$matches[3]\n";

        return $id;
    }

    /**
     * Replaces the code blocks back at it's positions.
     *
     * @param string $markdown
     * @return string
     */
    private function recoverCodeBlocks(string $markdown): string
    {
        return str_replace(array_keys($this->codeBlocks), $this->codeBlocks, $markdown);
    }
}
