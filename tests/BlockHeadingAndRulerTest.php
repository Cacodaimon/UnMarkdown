<?php
namespace UnMarkdown\Tests;

use UnMarkdown\MarkdownRemover;
use PHPUnit\Framework\TestCase;

class BlockHeadingAndRulerTest extends TestCase
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
        self::assertEmpty($this->classUnderTest->strip('======'));
        self::assertEmpty($this->classUnderTest->strip('------'));
        self::assertEmpty($this->classUnderTest->strip('---'));
        self::assertEmpty($this->classUnderTest->strip('***'));
        self::assertEmpty($this->classUnderTest->strip('___'));
    }

    public function testNotAHeadingOrRulers(): void
    {
        self::assertSame(
            $noChange = 'aaa ======',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = 'aaa ------',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = 'aaa ===',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = 'aaa ---',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = 'aaa ***',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = 'aaa ___',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = '====== aaa',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = '------ aaa',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = '=== aaa',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = '--- aaa',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = '*** aaa',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = '___ aaa',
            $this->classUnderTest->strip($noChange)
        );
    }

    public function testLeadingSpacedAHeadingOrRulers(): void
    {
        self::assertEmpty($this->classUnderTest->strip('==='));
        self::assertEmpty($this->classUnderTest->strip('---'));
        self::assertEmpty($this->classUnderTest->strip('***'));
        self::assertEmpty($this->classUnderTest->strip(' ___'));
        self::assertEmpty($this->classUnderTest->strip(' ==='));
        self::assertEmpty($this->classUnderTest->strip(' ---'));
        self::assertEmpty($this->classUnderTest->strip(' ***'));
        self::assertEmpty($this->classUnderTest->strip('  ___'));
        self::assertEmpty($this->classUnderTest->strip('  ==='));
        self::assertEmpty($this->classUnderTest->strip('  ---'));
        self::assertEmpty($this->classUnderTest->strip('  ***'));
        self::assertEmpty($this->classUnderTest->strip('   ___'));
        self::assertEmpty($this->classUnderTest->strip('   ==='));
        self::assertEmpty($this->classUnderTest->strip('   ---'));
        self::assertEmpty($this->classUnderTest->strip('   ***'));
        self::assertEmpty($this->classUnderTest->strip('   ___'));

        self::assertSame(
            $noChange = '    ===',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = '    ---',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = '    ***',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = '    ___',
            $this->classUnderTest->strip($noChange)
        );
    }

    public function testEscapedHeadingOrRulers(): void
    {
        self::assertSame(
            '\====== aaa',
            $this->classUnderTest->strip('\====== aaa')
        );

        self::assertSame(
            '------ aaa',
            $this->classUnderTest->strip('\------ aaa')
        );

        self::assertSame(
            '\=== aaa',
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
