<?php
namespace UnMarkdown\Tests;

use UnMarkdown\MarkdownRemover;
use PHPUnit\Framework\TestCase;

/**
 * Class InlineItalicTest
 * @package UnMarkdown\Tests
 * @author Guido Krömer <mail@cacodaemon.de>
 */
class InlineItalicTest extends TestCase
{
    /**
     * @var MarkdownRemover
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new MarkdownRemover();
    }

    public function testItalicWithAsterisk(): void
    {
        $expected = 'Test italic replacement';

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test italic *replacement*')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test *italic* replacement')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('*Test* italic replacement')
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
            $this->classUnderTest->strip('Test _italic_ replacement')
        );

        self::assertSame(
            $exptect,
            $this->classUnderTest->strip('Test italic _replacement_')
        );

        self::assertSame(
            $exptect,
            $this->classUnderTest->strip('_Test_ italic replacement')
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
            '• Test * italic replacement',
            $this->classUnderTest->strip('* Test * italic replacement')
        );
    }

    public function testEscapedItalic(): void
    {
        self::assertSame(
            'Test_ italic replacement',
            $this->classUnderTest->strip('_Test\_ italic_ replacement')
        );

        self::assertSame(
            '_Test_ italic replacement',
            $this->classUnderTest->strip('\_Test\_ italic replacement')
        );

        self::assertSame(
            '_Test_ italic replacement',
            $this->classUnderTest->strip('\_Test_ italic replacement')
        );

        self::assertSame(
            '_Test_ italic replacement',
            $this->classUnderTest->strip('_Test\_ italic replacement')
        );

        self::assertSame(
            '*Test* italic replacement',
            $this->classUnderTest->strip('\*Test\* italic replacement')
        );

        self::assertSame(
            '*Test* italic replacement',
            $this->classUnderTest->strip('\*Test* italic replacement')
        );

        self::assertSame(
            '*Test* italic replacement',
            $this->classUnderTest->strip('*Test\* italic replacement')
        );
    }
}
