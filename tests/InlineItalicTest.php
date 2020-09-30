<?php
namespace UnMarkdown\Tests;

use UnMarkdown\Stripper;
use PHPUnit\Framework\TestCase;

class InlineItalicTest extends TestCase
{
    /**
     * @var Stripper
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new Stripper();
    }

    public function testItalicWithAsterisk(): void
    {
        $expected = 'Test italic replacement';

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('*Test* italic replacement')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test *italic* replacement')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test italic *replacement*')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('*Test* *italic* *replacement*')
        );

        self::assertSame(
            $noChange = '⚫ Test * italic replacement',
            $this->classUnderTest->strip($noChange)
        );
    }

    public function testItalicWithUnderline(): void
    {
        $exptect = 'Test italic replacement';

        self::assertSame(
            $exptect,
            $this->classUnderTest->strip('_Test_ italic replacement')
        );

        self::assertSame(
            $exptect,
            $this->classUnderTest->strip('Test _italic_ replacement')
        );

        self::assertSame(
            $exptect,
            $this->classUnderTest->strip('Test italic _replacement_')
        );

        self::assertSame(
            $exptect,
            $this->classUnderTest->strip('_Test_ _italic_ _replacement_')
        );
    }

    public function testNotItalic(): void
    {
        self::assertSame(
            $noChange = '_ Test _ italic replacement',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            '⚫ Test * italic replacement',
            $this->classUnderTest->strip('* Test * italic replacement')
        );
    }
}
