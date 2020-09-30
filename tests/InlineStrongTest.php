<?php
namespace UnMarkdown\Tests;

use UnMarkdown\Stripper;
use PHPUnit\Framework\TestCase;

class InlineStrongTest extends TestCase
{
    /**
     * @var Stripper
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new Stripper();
    }

    public function testStrongWithAsterisk(): void
    {
        $expected = 'Test strong replacement';

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('**Test** strong replacement')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test **strong** replacement')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test strong **replacement**')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('**Test** **strong** **replacement**')
        );

        self::assertSame(
            '** Test ** strong replacement',
            $this->classUnderTest->strip('** Test ** strong replacement')
        );
    }

    public function testStrongWithUnderline(): void
    {
        $expected = 'Test strong replacement';

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('__Test__ strong replacement')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test __strong__ replacement')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test strong __replacement__')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('__Test__ __strong__ __replacement__')
        );

        self::assertSame(
            $noChange = '__ Test __ strong replacement',
            $this->classUnderTest->strip($noChange)
        );
    }

    public function testNoStrong() : void
    {
        self::assertSame(
            $noChange = '__ Test __ strong replacement',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            '** Test ** strong replacement',
            $this->classUnderTest->strip('** Test ** strong replacement')
        );
    }
}
