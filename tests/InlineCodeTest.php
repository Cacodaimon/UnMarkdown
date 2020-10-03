<?php
namespace UnMarkdown\Tests;

use UnMarkdown\MarkdownRemover;
use PHPUnit\Framework\TestCase;

/**
 * Class InlineCodeTest
 * @package UnMarkdown\Tests
 * @author Guido Krömer <mail@cacodaemon.de>
 */
class InlineCodeTest extends TestCase
{
    /**
     * @var MarkdownRemover
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new MarkdownRemover();
    }

    public function testInlineCode(): void
    {
        self::assertSame(
            'Test code replacement',
            $this->classUnderTest->strip('`Test` code replacement')
        );

        self::assertSame(
            'Test code replacement',
            $this->classUnderTest->strip('Test `code` replacement')
        );

        self::assertSame(
            'Test code replacement',
            $this->classUnderTest->strip('Test code `replacement`')
        );

        self::assertSame(
            'Test code replacement',
            $this->classUnderTest->strip('`Test` `code` `replacement`')
        );
    }

    public function testNotInlineCode(): void
    {
        self::assertSame(
            '`` code replacement',
            $this->classUnderTest->strip('`` code replacement')
        );

        self::assertSame(
            'Test `` replacement',
            $this->classUnderTest->strip('Test `` replacement')
        );

        self::assertSame(
            'Test code ``',
            $this->classUnderTest->strip('Test code ``')
        );

        self::assertSame(
            '``` code replacement',
            $this->classUnderTest->strip('``` code replacement')
        );

        self::assertSame(
            'Test ``` replacement',
            $this->classUnderTest->strip('Test ``` replacement')
        );

        self::assertSame(
            'Test code ```',
            $this->classUnderTest->strip('Test code ```')
        );

        self::assertSame(
            "\n```\n",
            $this->classUnderTest->strip("\n\```\n")
        );
    }

    public function testEscapedInlineCode(): void
    {
        self::assertSame(
            'foo`bar',
            $this->classUnderTest->strip('`foo\`bar`')
        );

        self::assertSame(
            '`Test` code replacement',
            $this->classUnderTest->strip('\`Test\` code replacement')
        );

        self::assertSame(
            'Test `code` replacement',
            $this->classUnderTest->strip('Test \`code\` replacement')
        );

        self::assertSame(
            'Test code `replacement`',
            $this->classUnderTest->strip('Test code \`replacement\`')
        );

        self::assertSame(
            'Test `code` replacement',
            $this->classUnderTest->strip('Test \`code` replacement')
        );

        self::assertSame(
            'Test `code` replacement',
            $this->classUnderTest->strip('Test `code\` replacement')
        );
    }
}
