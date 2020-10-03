<?php
namespace UnMarkdown\Tests;

use UnMarkdown\MarkdownRemover;
use PHPUnit\Framework\TestCase;

/**
 * Class InlineStrongTest
 * @package UnMarkdown\Tests
 * @author Guido Krömer <mail@cacodaemon.de>
 */
class InlineStrongTest extends TestCase
{
    /**
     * @var MarkdownRemover
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new MarkdownRemover();
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

    public function testEscapedStrong(): void
    {
        self::assertSame(
            'Test** strong replacement',
            $this->classUnderTest->strip('**Test\*\* strong** replacement')
        );

        self::assertSame(
            '**Test** strong replacement',
            $this->classUnderTest->strip('\*\*Test\*\* strong replacement')
        );

        self::assertSame(
            '*Test* strong replacement',
            $this->classUnderTest->strip('\**Test*\* strong replacement')
        );

        self::assertSame(
            '*Test* strong replacement',
            $this->classUnderTest->strip('*\*Test\** strong replacement')
        );

        self::assertSame(
            '*Test* strong replacement',
            $this->classUnderTest->strip('\**Test** strong replacement')
        );

        self::assertSame(
            '*Test* strong replacement',
            $this->classUnderTest->strip('*\*Test** strong replacement')
        );

        self::assertSame(
            '*Test* strong replacement',
            $this->classUnderTest->strip('**Test\** strong replacement')
        );

        self::assertSame(
            '*Test* strong replacement',
            $this->classUnderTest->strip('**Test*\* strong replacement')
        );
    }
}
