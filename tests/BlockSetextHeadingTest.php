<?php
namespace UnMarkdown\Tests;

use UnMarkdown\MarkdownRemover;
use PHPUnit\Framework\TestCase;

class BlockSetextHeadingTest extends TestCase
{
    /**
     * @var MarkdownRemover
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new MarkdownRemover();
    }

    public function testHeadingAndRulers(): void
    {
        self::assertSame(
            "Foo bar\n",
            $this->classUnderTest->strip("Foo bar\n======="));

        self::assertSame(
            "Foo bar\n",
            $this->classUnderTest->strip("Foo bar\n-------"));

        self::assertSame(
            "Foo\nbar\n",
            $this->classUnderTest->strip("Foo\nbar\n---"));

        self::assertSame(
            "Foo\nbar\n",
            $this->classUnderTest->strip("Foo\nbar\n==="));
    }

    public function testUnderliningCanBeAnyLength(): void
    {
        self::assertSame(
            "Foo bar\n",
            $this->classUnderTest->strip("Foo bar\n="));

        self::assertSame(
            "Foo bar\n",
            $this->classUnderTest->strip("Foo bar\n-"));

        self::assertSame(
            "Foo bar\n",
            $this->classUnderTest->strip("Foo bar\n=="));

        self::assertSame(
            "Foo bar\n",
            $this->classUnderTest->strip("Foo bar\n--"));

        self::assertSame(
            "Foo bar\n",
            $this->classUnderTest->strip("Foo bar\n===="));

        self::assertSame(
            "Foo bar\n",
            $this->classUnderTest->strip("Foo bar\n----"));

        self::assertSame(
            "Foo bar\n",
            $this->classUnderTest->strip("Foo bar\n========"));

        self::assertSame(
            "Foo bar\n",
            $this->classUnderTest->strip("Foo bar\n--------"));
    }

    public function testLeadingSpacedAHeadingOrRulers(): void
    {
        self::assertSame(
            "Foo\nbar\n",
            $this->classUnderTest->strip("Foo\nbar\n ---"));

        self::assertSame(
            "Foo\nbar\n",
            $this->classUnderTest->strip("Foo\nbar\n ==="));

        self::assertSame(
            "Foo\nbar\n",
            $this->classUnderTest->strip("Foo\nbar\n  ---"));

        self::assertSame(
            "Foo\nbar\n",
            $this->classUnderTest->strip("Foo\nbar\n  ==="));

        self::assertSame(
            "Foo\nbar\n",
            $this->classUnderTest->strip("Foo\nbar\n   ---"));

        self::assertSame(
            "Foo\nbar\n",
            $this->classUnderTest->strip("Foo\nbar\n   ==="));

        self::assertSame(
            "Foo\nbar\n    ---",
            $this->classUnderTest->strip("Foo\nbar\n    ---"));

        self::assertSame(
            "Foo\nbar\n    ===",
            $this->classUnderTest->strip("Foo\nbar\n    ==="));
    }

    public function testEscapedHeadingOrRulers(): void
    {
        self::assertSame(
            '====== aaa',
            $this->classUnderTest->strip('\====== aaa')
        );

        self::assertSame(
            '------ aaa',
            $this->classUnderTest->strip('\------ aaa')
        );

        self::assertSame(
            '=== aaa',
            $this->classUnderTest->strip('\=== aaa')
        );

        self::assertSame(
            '--- aaa',
            $this->classUnderTest->strip('\--- aaa')
        );

        self::assertSame(
            '*** aaa',
            $this->classUnderTest->strip('\*** aaa')
        );

        self::assertSame(
            '___ aaa',
            $this->classUnderTest->strip('\___ aaa')
        );
    }
}
