<?php
namespace UnMarkdown\Tests;

use UnMarkdown\MarkdownRemover;
use PHPUnit\Framework\TestCase;

class BlockUnorderedListTest extends TestCase
{
    /**
     * @var MarkdownRemover
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new MarkdownRemover();
    }

    public function testUnorderedListAsterisk(): void
    {
        self::assertSame(
            '• A list item (lvl 1)',
            $this->classUnderTest->strip('* A list item (lvl 1)')
        );

        self::assertSame(
            '  • A list item (lvl 2)',
            $this->classUnderTest->strip('  * A list item (lvl 2)')
        );

        self::assertSame(
            '    • A list item (lvl 3)',
            $this->classUnderTest->strip('    * A list item (lvl 3)')
        );

        self::assertSame(
            $noChange = 'Not a * list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            '• A list item (lvl 1)',
            $this->classUnderTest->strip('* A list item (lvl 1)')
        );
    }

    public function testUnorderedListMinus(): void
    {
        self::assertSame(
            '• A list item (lvl 1)',
            $this->classUnderTest->strip('- A list item (lvl 1)')
        );

        self::assertSame(
            '  • A list item (lvl 2)',
            $this->classUnderTest->strip('  - A list item (lvl 2)')
        );

        self::assertSame(
            '    • A list item (lvl 3)',
            $this->classUnderTest->strip('    - A list item (lvl 3)')
        );

        self::assertSame(
            $noChange = 'Not a - list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            '• A list item (lvl 1)',
            $this->classUnderTest->strip('- A list item (lvl 1)')
        );
    }

    public function testUnorderedListPlus(): void
    {
        self::assertSame(
            '• A list item (lvl 1)',
            $this->classUnderTest->strip('+ A list item (lvl 1)')
        );

        self::assertSame(
            '  • A list item (lvl 2)',
            $this->classUnderTest->strip('  + A list item (lvl 2)')
        );

        self::assertSame(
            '    • A list item (lvl 3)',
            $this->classUnderTest->strip('    + A list item (lvl 3)')
        );

        self::assertSame(
            $noChange = 'Not a - list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            '• A list item (lvl 1)',
            $this->classUnderTest->strip('+ A list item (lvl 1)')
        );
    }

    public function testNotAListItem(): void
    {
        self::assertSame(
            $noChange = '*Not a list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = '  *Not a list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = '+Not a list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = '  +Not a list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = '-Not a list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = '  -Not a list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );
    }

    public function testEscapedListItem(): void
    {
        self::assertSame(
            $noChange = '*Not a list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = '  *Not a list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = '+Not a list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = '  +Not a list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = '-Not a list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = ' -Not a list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );
    }

    public function testMultipleListItems(): void
    {
        self::assertSame(
            "• list item 1\n• list item 2\n• list item 1",
            $this->classUnderTest->strip("+ list item 1\n+ list item 2\n+ list item 1")
        );

        self::assertSame(
            "• list item 1\n• list item 2\n• list item 1",
            $this->classUnderTest->strip("- list item 1\n- list item 2\n- list item 1")
        );

        self::assertSame(
            "• list item 1\n• list item 2\n• list item 1",
            $this->classUnderTest->strip("* list item 1\n* list item 2\n* list item 1")
        );
    }
}
