<?php
namespace UnMarkdown\Tests;

use UnMarkdown\Stripper;
use PHPUnit\Framework\TestCase;

class InlineCodeTest extends TestCase
{
    /**
     * @var Stripper
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new Stripper();
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
