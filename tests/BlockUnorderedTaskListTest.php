<?php
namespace UnMarkdown\Tests;

use UnMarkdown\Stripper;
use PHPUnit\Framework\TestCase;

class BlockUnorderedTaskListTest extends TestCase
{
    /**
     * @var Stripper
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new Stripper();
    }

    public function testUnorderedTaskListListAsterisk(): void
    {
        self::assertSame(
            '⚫ ⭕ A task list item (lvl 1)',
            $this->classUnderTest->strip('* [ ] A task list item (lvl 1)')
        );

        self::assertSame(
            '⚫ ❌ A task list item (lvl 1)',
            $this->classUnderTest->strip('* [x] A task list item (lvl 1)')
        );

        self::assertSame(
            '⚫ ❌ A task list item (lvl 1)',
            $this->classUnderTest->strip('* [X] A task list item (lvl 1)')
        );

        self::assertSame(
            '  ⚫ ⭕ A task list item (lvl 2)',
            $this->classUnderTest->strip('  * [ ] A task list item (lvl 2)')
        );

        self::assertSame(
            '  ⚫ ❌ A task list item (lvl 2)',
            $this->classUnderTest->strip('  * [x] A task list item (lvl 2)')
        );

        self::assertSame(
            '  ⚫ ❌ A task list item (lvl 2)',
            $this->classUnderTest->strip('  * [X] A task list item (lvl 2)')
        );

        self::assertSame(
            '    ⚫ ⭕ A task list item (lvl 3)',
            $this->classUnderTest->strip('    * [ ] A task list item (lvl 3)')
        );

        self::assertSame(
            '    ⚫ ❌ A task list item (lvl 3)',
            $this->classUnderTest->strip('    * [x] A task list item (lvl 3)')
        );

        self::assertSame(
            '    ⚫ ❌ A task list item (lvl 3)',
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
            '⚫ ⭕ A task list item (lvl 1)',
            $this->classUnderTest->strip('- [ ] A task list item (lvl 1)')
        );

        self::assertSame(
            '⚫ ❌ A task list item (lvl 1)',
            $this->classUnderTest->strip('- [x] A task list item (lvl 1)')
        );

        self::assertSame(
            '⚫ ❌ A task list item (lvl 1)',
            $this->classUnderTest->strip('- [X] A task list item (lvl 1)')
        );

        self::assertSame(
            '  ⚫ ⭕ A task list item (lvl 2)',
            $this->classUnderTest->strip('  - [ ] A task list item (lvl 2)')
        );

        self::assertSame(
            '  ⚫ ❌ A task list item (lvl 2)',
            $this->classUnderTest->strip('  - [x] A task list item (lvl 2)')
        );

        self::assertSame(
            '  ⚫ ❌ A task list item (lvl 2)',
            $this->classUnderTest->strip('  - [X] A task list item (lvl 2)')
        );

        self::assertSame(
            '    ⚫ ⭕ A task list item (lvl 3)',
            $this->classUnderTest->strip('    - [ ] A task list item (lvl 3)')
        );

        self::assertSame(
            '    ⚫ ❌ A task list item (lvl 3)',
            $this->classUnderTest->strip('    - [x] A task list item (lvl 3)')
        );

        self::assertSame(
            '    ⚫ ❌ A task list item (lvl 3)',
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
            '⚫ ⭕ A task list item (lvl 1)',
            $this->classUnderTest->strip('+ [ ] A task list item (lvl 1)')
        );

        self::assertSame(
            '⚫ ❌ A task list item (lvl 1)',
            $this->classUnderTest->strip('+ [x] A task list item (lvl 1)')
        );

        self::assertSame(
            '⚫ ❌ A task list item (lvl 1)',
            $this->classUnderTest->strip('+ [X] A task list item (lvl 1)')
        );

        self::assertSame(
            '  ⚫ ⭕ A task list item (lvl 2)',
            $this->classUnderTest->strip('  + [ ] A task list item (lvl 2)')
        );

        self::assertSame(
            '  ⚫ ❌ A task list item (lvl 2)',
            $this->classUnderTest->strip('  + [x] A task list item (lvl 2)')
        );

        self::assertSame(
            '  ⚫ ❌ A task list item (lvl 2)',
            $this->classUnderTest->strip('  + [X] A task list item (lvl 2)')
        );

        self::assertSame(
            '    ⚫ ⭕ A task list item (lvl 3)',
            $this->classUnderTest->strip('    + [ ] A task list item (lvl 3)')
        );

        self::assertSame(
            '    ⚫ ❌ A task list item (lvl 3)',
            $this->classUnderTest->strip('    + [x] A task list item (lvl 3)')
        );

        self::assertSame(
            '    ⚫ ❌ A task list item (lvl 3)',
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
            '⚫ ❌ A task list item (lvl 1)',
            $this->classUnderTest->strip('*  [x] A task list item (lvl 1)')
        );

        self::assertSame(
            '⚫ ⭕ A task list item (lvl 1)',
            $this->classUnderTest->strip('+  [ ] A task list item (lvl 1)')
        );

        self::assertSame(
            '⚫ ❌ A task list item (lvl 1)',
            $this->classUnderTest->strip('-  [x] A task list item (lvl 1)')
        );

        self::assertSame(
            '⚫ ⭕ A task list item (lvl 1)',
            $this->classUnderTest->strip('*   [ ] A task list item (lvl 1)')
        );

        self::assertSame(
            '⚫ ❌ A task list item (lvl 1)',
            $this->classUnderTest->strip('+   [x] A task list item (lvl 1)')
        );

        self::assertSame(
            '⚫ ⭕ A task list item (lvl 1)',
            $this->classUnderTest->strip('-   [ ] A task list item (lvl 1)')
        );

        self::assertSame(
            $noChange = '⚫    [ ] A task list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = '⚫    [x] A task list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = '⚫    [ ] A task list item (lvl 1)',
            $this->classUnderTest->strip($noChange)
        );
    }
}
