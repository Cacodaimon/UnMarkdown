<?php
namespace UnMarkdown\Tests;

use UnMarkdown\Stripper;
use PHPUnit\Framework\TestCase;

class BlockOrderedListTest extends TestCase
{
    /**
     * @var Stripper
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new Stripper();
    }

    public function testOrderedList(): void
    {
        self::assertSame(
            $noChange = '1. A list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = '  2. A list item (lvl 2)',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = '    3. A list item (lvl 3)',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = 'Not a 1. list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );
    }
}
