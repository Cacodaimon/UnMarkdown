<?php
namespace UnMarkdown\Tests;

use UnMarkdown\Stripper;
use PHPUnit\Framework\TestCase;

class InlineStrikethroughTest extends TestCase
{
    /**
     * @var Stripper
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new Stripper();
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
}
