<?php
namespace UnMarkdown\Tests;

use UnMarkdown\MarkdownRemover;
use PHPUnit\Framework\TestCase;

/**
 * Class InlineStrikethroughTest
 * @package UnMarkdown\Tests
 * @author Guido Krömer <mail@cacodaemon.de>
 */
class InlineStrikethroughTest extends TestCase
{
    /**
     * @var MarkdownRemover
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new MarkdownRemover();
    }

    public function testStrikethrough(): void
    {
        $expected = 'Test strikethrough replacement';

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('~~Test~~ strikethrough replacement')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test ~~strikethrough~~ replacement')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test strikethrough ~~replacement~~')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('~~Test~~ ~~strikethrough~~ ~~replacement~~')
        );

        self::assertSame(
            $noChange = '~~ Test ~~ strikethrough replacement',
            $this->classUnderTest->strip($noChange)
        );
    }

    public function testEscapedStrikethrough(): void
    {
        self::assertSame(
            '~~Test~~ strikethrough replacement',
            $this->classUnderTest->strip('\~\~Test\~\~ strikethrough replacement')
        );

        self::assertSame(
            'Test ~~strikethrough~~ replacement',
            $this->classUnderTest->strip('Test \~\~strikethrough\~\~ replacement')
        );

        self::assertSame(
            'Test strikethrough ~~replacement~~',
            $this->classUnderTest->strip('Test strikethrough \~\~replacement\~\~')
        );

        self::assertSame(
            '~~Test~~ ~~strikethrough~~ ~~replacement~~',
            $this->classUnderTest->strip('\~\~Test\~\~ \~\~strikethrough\~\~ \~\~replacement\~\~')
        );

        self::assertSame(
            '~~Test~~ strikethrough replacement',
            $this->classUnderTest->strip('\~~Test~\~ strikethrough replacement')
        );

        self::assertSame(
            'Test ~~strikethrough~~ replacement',
            $this->classUnderTest->strip('Test ~\~strikethrough\~~ replacement')
        );

        self::assertSame(
            'Test strikethrough ~~replacement~~',
            $this->classUnderTest->strip('Test strikethrough \~\~replacement~~')
        );

        self::assertSame(
            '~~Test~~ strikethrough replacement',
            $this->classUnderTest->strip('~~Test\~\~ strikethrough replacement')
        );
    }
}
