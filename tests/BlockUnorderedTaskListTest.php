<?php
namespace UnMarkdown\Tests;

use UnMarkdown\MarkdownRemover;
use PHPUnit\Framework\TestCase;

/**
 * Class BlockUnorderedTaskListTest
 * @package UnMarkdown\Tests
 * @author Guido Krömer <mail@cacodaemon.de>
 */
class BlockUnorderedTaskListTest extends TestCase
{
    /**
     * @var MarkdownRemover
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new MarkdownRemover();
    }

    public function testUnorderedTaskListListAsterisk(): void
    {
        self::assertSame(
            '• ⭕ A task list item (lvl 1)',
            $this->classUnderTest->strip('* [ ] A task list item (lvl 1)')
        );

        self::assertSame(
            '• ❌ A task list item (lvl 1)',
            $this->classUnderTest->strip('* [x] A task list item (lvl 1)')
        );

        self::assertSame(
            '• ❌ A task list item (lvl 1)',
            $this->classUnderTest->strip('* [X] A task list item (lvl 1)')
        );

        self::assertSame(
            '  • ⭕ A task list item (lvl 2)',
            $this->classUnderTest->strip('  * [ ] A task list item (lvl 2)')
        );

        self::assertSame(
            '  • ❌ A task list item (lvl 2)',
            $this->classUnderTest->strip('  * [x] A task list item (lvl 2)')
        );

        self::assertSame(
            '  • ❌ A task list item (lvl 2)',
            $this->classUnderTest->strip('  * [X] A task list item (lvl 2)')
        );

        self::assertSame(
            '    • ⭕ A task list item (lvl 3)',
            $this->classUnderTest->strip('    * [ ] A task list item (lvl 3)')
        );

        self::assertSame(
            '    • ❌ A task list item (lvl 3)',
            $this->classUnderTest->strip('    * [x] A task list item (lvl 3)')
        );

        self::assertSame(
            '    • ❌ A task list item (lvl 3)',
            $this->classUnderTest->strip('    * [X] A task list item (lvl 3)')
        );

        self::assertSame(
            $noChange = 'Not a * [ ] list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = 'Not a * [x] list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = 'Not a * [X] list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );
    }

    public function testUnorderedListMinus(): void
    {
        self::assertSame(
            '• ⭕ A task list item (lvl 1)',
            $this->classUnderTest->strip('- [ ] A task list item (lvl 1)')
        );

        self::assertSame(
            '• ❌ A task list item (lvl 1)',
            $this->classUnderTest->strip('- [x] A task list item (lvl 1)')
        );

        self::assertSame(
            '• ❌ A task list item (lvl 1)',
            $this->classUnderTest->strip('- [X] A task list item (lvl 1)')
        );

        self::assertSame(
            '  • ⭕ A task list item (lvl 2)',
            $this->classUnderTest->strip('  - [ ] A task list item (lvl 2)')
        );

        self::assertSame(
            '  • ❌ A task list item (lvl 2)',
            $this->classUnderTest->strip('  - [x] A task list item (lvl 2)')
        );

        self::assertSame(
            '  • ❌ A task list item (lvl 2)',
            $this->classUnderTest->strip('  - [X] A task list item (lvl 2)')
        );

        self::assertSame(
            '    • ⭕ A task list item (lvl 3)',
            $this->classUnderTest->strip('    - [ ] A task list item (lvl 3)')
        );

        self::assertSame(
            '    • ❌ A task list item (lvl 3)',
            $this->classUnderTest->strip('    - [x] A task list item (lvl 3)')
        );

        self::assertSame(
            '    • ❌ A task list item (lvl 3)',
            $this->classUnderTest->strip('    - [X] A task list item (lvl 3)')
        );

        self::assertSame(
            $noChange = 'Not a - [ ] list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = 'Not a - [x] list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = 'Not a - [X] list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );
    }

    public function testUnorderedListPlus(): void
    {
        self::assertSame(
            '• ⭕ A task list item (lvl 1)',
            $this->classUnderTest->strip('+ [ ] A task list item (lvl 1)')
        );

        self::assertSame(
            '• ❌ A task list item (lvl 1)',
            $this->classUnderTest->strip('+ [x] A task list item (lvl 1)')
        );

        self::assertSame(
            '• ❌ A task list item (lvl 1)',
            $this->classUnderTest->strip('+ [X] A task list item (lvl 1)')
        );

        self::assertSame(
            '  • ⭕ A task list item (lvl 2)',
            $this->classUnderTest->strip('  + [ ] A task list item (lvl 2)')
        );

        self::assertSame(
            '  • ❌ A task list item (lvl 2)',
            $this->classUnderTest->strip('  + [x] A task list item (lvl 2)')
        );

        self::assertSame(
            '  • ❌ A task list item (lvl 2)',
            $this->classUnderTest->strip('  + [X] A task list item (lvl 2)')
        );

        self::assertSame(
            '    • ⭕ A task list item (lvl 3)',
            $this->classUnderTest->strip('    + [ ] A task list item (lvl 3)')
        );

        self::assertSame(
            '    • ❌ A task list item (lvl 3)',
            $this->classUnderTest->strip('    + [x] A task list item (lvl 3)')
        );

        self::assertSame(
            '    • ❌ A task list item (lvl 3)',
            $this->classUnderTest->strip('    + [X] A task list item (lvl 3)')
        );

        self::assertSame(
            $noChange = 'Not a + [ ] list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = 'Not a + [x] list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = 'Not a + [X] list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );
    }

    public function testUnorderedListUpToThreeSpacesBetweenBulletAndCheckbox(): void
    {
        self::assertSame(
            '• ❌ A task list item (lvl 1)',
            $this->classUnderTest->strip('*  [x] A task list item (lvl 1)')
        );

        self::assertSame(
            '• ⭕ A task list item (lvl 1)',
            $this->classUnderTest->strip('+  [ ] A task list item (lvl 1)')
        );

        self::assertSame(
            '• ❌ A task list item (lvl 1)',
            $this->classUnderTest->strip('-  [x] A task list item (lvl 1)')
        );

        self::assertSame(
            '• ⭕ A task list item (lvl 1)',
            $this->classUnderTest->strip('*   [ ] A task list item (lvl 1)')
        );

        self::assertSame(
            '• ❌ A task list item (lvl 1)',
            $this->classUnderTest->strip('+   [x] A task list item (lvl 1)')
        );

        self::assertSame(
            '• ⭕ A task list item (lvl 1)',
            $this->classUnderTest->strip('-   [ ] A task list item (lvl 1)')
        );

        self::assertSame(
            $noChange = '•    [ ] A task list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = '•    [x] A task list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = '•    [ ] A task list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );
    }

    public function testEscapedUnorderedTasks(): void
    {
        self::assertSame(
            '* [ ] Not a task list item (lvl 1)',
            $this->classUnderTest->strip('\* [ ] Not a task list item (lvl 1)')
        );

        self::assertSame(
            '+ [ ] Not a task list item (lvl 1)',
            $this->classUnderTest->strip('\+ [ ] Not a task list item (lvl 1)')
        );

        self::assertSame(
            '- [ ] Not a task list item (lvl 1)',
            $this->classUnderTest->strip('\- [ ] Not a task list item (lvl 1)')
        );

        self::assertSame(
            '* [x] Not a task list item (lvl 1)',
            $this->classUnderTest->strip('\* [x] Not a task list item (lvl 1)')
        );

        self::assertSame(
            '+ [x] Not a task list item (lvl 1)',
            $this->classUnderTest->strip('\+ [x] Not a task list item (lvl 1)')
        );

        self::assertSame(
            '- [x] Not a task list item (lvl 1)',
            $this->classUnderTest->strip('\- [x] Not a task list item (lvl 1)')
        );
    }

    public function testMultipleUnorderedTasks(): void
    {
        self::assertSame(
            "• ⭕ list item 1\n• ❌ list item 2\n• ❌ list item 1",
            $this->classUnderTest->strip("+ [ ] list item 1\n+ [x] list item 2\n+ [x] list item 1")
        );

        self::assertSame(
            "• ⭕ list item 1\n• ❌ list item 2\n• ❌ list item 1",
            $this->classUnderTest->strip("- [ ] list item 1\n- [x] list item 2\n- [x] list item 1")
        );

        self::assertSame(
            "• ⭕ list item 1\n• ❌ list item 2\n• ❌ list item 1",
            $this->classUnderTest->strip("* [ ] list item 1\n* [x] list item 2\n* [x] list item 1")
        );
    }
}
