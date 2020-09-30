<?php
namespace UnMarkdown\Tests;

use UnMarkdown\Stripper;
use PHPUnit\Framework\TestCase;

class BlockUnorderedListTest extends TestCase
{
    /**
     * @var Stripper
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new Stripper();
    }

    public function testUnorderedListAsterisk(): void
    {
        self::assertSame(
            '⚫ A list item (lvl 1)',
            $this->classUnderTest->strip('* A list item (lvl 1)')
        );

        self::assertSame(
            '  ⚫ A list item (lvl 2)',
            $this->classUnderTest->strip('  * A list item (lvl 2)')
        );

        self::assertSame(
            '    ⚫ A list item (lvl 3)',
            $this->classUnderTest->strip('    * A list item (lvl 3)')
        );

        self::assertSame(
            $noChange = 'Not a * list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );
    }

    public function testUnorderedListMinus(): void
    {
        self::assertSame(
            '⚫ A list item (lvl 1)',
            $this->classUnderTest->strip('- A list item (lvl 1)')
        );

        self::assertSame(
            '  ⚫ A list item (lvl 2)',
            $this->classUnderTest->strip('  - A list item (lvl 2)')
        );

        self::assertSame(
            '    ⚫ A list item (lvl 3)',
            $this->classUnderTest->strip('    - A list item (lvl 3)')
        );

        self::assertSame(
            $noChange = 'Not a - list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );
    }

    public function testUnorderedListPlus(): void
    {
        self::assertSame(
            '⚫ A list item (lvl 1)',
            $this->classUnderTest->strip('+ A list item (lvl 1)')
        );

        self::assertSame(
            '  ⚫ A list item (lvl 2)',
            $this->classUnderTest->strip('  + A list item (lvl 2)')
        );

        self::assertSame(
            '    ⚫ A list item (lvl 3)',
            $this->classUnderTest->strip('    + A list item (lvl 3)')
        );

        self::assertSame(
            $noChange = 'Not a - list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );
    }
}