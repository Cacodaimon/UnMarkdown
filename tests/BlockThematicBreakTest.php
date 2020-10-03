<?php
namespace UnMarkdown\Tests;

use UnMarkdown\MarkdownRemover;
use PHPUnit\Framework\TestCase;

/**
 * Class BlockThematicBreakTest
 * @package UnMarkdown\Tests
 * @author Guido Krömer <mail@cacodaemon.de>
 */
class BlockThematicBreakTest extends TestCase
{
    /**
     * @var MarkdownRemover
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new MarkdownRemover();
    }

    public function testRulers(): void
    {
        self::assertEmpty($this->classUnderTest->strip('---'));
        self::assertEmpty($this->classUnderTest->strip('***'));
        self::assertEmpty($this->classUnderTest->strip('___'));
    }

    public function testNotARulers(): void
    {
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

    public function testLeadingSpacedRulers(): void
    {
        self::assertEmpty($this->classUnderTest->strip('___'));
        self::assertEmpty($this->classUnderTest->strip('---'));
        self::assertEmpty($this->classUnderTest->strip('***'));
        self::assertEmpty($this->classUnderTest->strip(' ___'));
        self::assertEmpty($this->classUnderTest->strip(' ---'));
        self::assertEmpty($this->classUnderTest->strip(' ***'));
        self::assertEmpty($this->classUnderTest->strip('  ___'));
        self::assertEmpty($this->classUnderTest->strip('  ---'));
        self::assertEmpty($this->classUnderTest->strip('  ***'));
        self::assertEmpty($this->classUnderTest->strip('   ___'));
        self::assertEmpty($this->classUnderTest->strip('   ___'));
        self::assertEmpty($this->classUnderTest->strip('   ***'));

        self::assertSame(
            $noChange = '    ___',
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
    }

    public function testSpacedBetweenRulers(): void
    {
        self::assertEmpty($this->classUnderTest->strip('- - -'));
        self::assertEmpty($this->classUnderTest->strip('_ _ _'));
        self::assertEmpty($this->classUnderTest->strip('* * *'));
        self::assertEmpty($this->classUnderTest->strip(' - - -'));
        self::assertEmpty($this->classUnderTest->strip(' _ _ _'));
        self::assertEmpty($this->classUnderTest->strip(' * * *'));
        self::assertEmpty($this->classUnderTest->strip('- - - '));
        self::assertEmpty($this->classUnderTest->strip('_ _ _ '));
        self::assertEmpty($this->classUnderTest->strip('* * * '));
        self::assertEmpty($this->classUnderTest->strip(' --  - -- - -- - --'));
        self::assertEmpty($this->classUnderTest->strip(' __  _ __ _ __ _ __'));
        self::assertEmpty($this->classUnderTest->strip(' **  * ** * ** * **'));
        self::assertEmpty($this->classUnderTest->strip('-     -      -      -'));
        self::assertEmpty($this->classUnderTest->strip('_     _      _      _'));
        self::assertEmpty($this->classUnderTest->strip('*     *      *      *'));
        self::assertEmpty($this->classUnderTest->strip('- - -    '));
        self::assertEmpty($this->classUnderTest->strip('_ _ _    '));
        self::assertEmpty($this->classUnderTest->strip('* * *    '));
    }

    public function testEscapedRulers(): void
    {
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
