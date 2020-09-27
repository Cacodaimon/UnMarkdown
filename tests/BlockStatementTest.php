<?php
namespace UnMarkdown\Tests;

use UnMarkdown\Stripper;
use PHPUnit\Framework\TestCase;

class BlockStatementTest extends TestCase
{
    /**
     * @var Stripper
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new Stripper();
    }

    public function testHeadingWithHashtag(): void
    {
        self::assertSame(
            "\nH1\n",
            $this->classUnderTest->strip('# H1')
        );

        self::assertSame(
            $noChange = 'aaa # H1',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            "\nH2\n",
            $this->classUnderTest->strip('## H2')
        );

        self::assertSame(
            $noChange = 'aaa ## H2',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            "\nH3\n",
            $this->classUnderTest->strip('### H3')
        );

        self::assertSame(
            $noChange = 'aaa ### H3',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            "\nH4\n",
            $this->classUnderTest->strip('#### H4')
        );

        self::assertSame(
            $noChange = 'aaa #### H4',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            "\nH5\n",
            $this->classUnderTest->strip('##### H5')
        );

        self::assertSame(
            $noChange = 'aaa ##### H5',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            "\nH6\n",
            $this->classUnderTest->strip('###### H6')
        );

        self::assertSame(
            $noChange = 'aaa ###### H6',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = '####### H7',
            $this->classUnderTest->strip($noChange)
        );
    }

    public function testHeadingAndRulers(): void
    {
        self::assertNotEmpty($this->classUnderTest->strip('aaa ======'));
        self::assertNotEmpty($this->classUnderTest->strip('aaa ------'));
        self::assertNotEmpty($this->classUnderTest->strip('aaa ---'));
        self::assertNotEmpty($this->classUnderTest->strip('aaa ***'));
        self::assertNotEmpty($this->classUnderTest->strip('aaa ___'));

        self::assertEmpty($this->classUnderTest->strip('======'));
        self::assertEmpty($this->classUnderTest->strip('------'));
        self::assertEmpty($this->classUnderTest->strip('---'));
        self::assertEmpty($this->classUnderTest->strip('***'));
        self::assertEmpty($this->classUnderTest->strip('___'));

        self::assertNotEmpty($this->classUnderTest->strip('====== aaa'));
        self::assertNotEmpty($this->classUnderTest->strip('------ aaa'));
        self::assertNotEmpty($this->classUnderTest->strip('--- aaa'));
        self::assertNotEmpty($this->classUnderTest->strip('*** aaa'));
        self::assertNotEmpty($this->classUnderTest->strip('___ aaa'));
    }

    public function testBlockQuote(): void
    {
        $expected = "\n💬 block quote";

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('> block quote')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('>> block quote')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('>>> block quote')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip(' > block quote')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip(' >> block quote')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip(' >>> block quote')
        );

        self::assertSame(
            $noChange = 'not a > block quote',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = 'not a >> block quote',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = 'not a >>> block quote',
            $this->classUnderTest->strip($noChange)
        );
    }

    public function testBlockQuoteWithInline(): void
    {
        $expected = "\n💬 block quote";

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('> *block* quote')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('> block *quote*')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('> **block** quote')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('> block **quote**')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('> _block_ quote')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('> block _quote_')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('> __block__ quote')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('> block __quote__')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('> `block` quote')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('> block `quote`')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('> ~~block~~ quote')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('> block ~~quote~~')
        );

        self::assertSame(
            "\n💬 block quote 🔗 https://www.google.com",
            $this->classUnderTest->strip('> block quote [link](https://www.google.com)')
        );

        self::assertSame(
            "\n💬 block quote 🖼️ inline image alt text",
            $this->classUnderTest->strip('> block quote ![inline image alt text](https://example-com/image.jpg)')
        );
    }

    public function testCodeBlock(): void
    {
        self::assertSame(
            $noChange = 'not a ``` code block',
            $this->classUnderTest->strip($noChange)
        );

        self::assertEquals(
            $noChange = '```',
            $this->classUnderTest->strip($noChange)
        );

        self::assertEquals(
            $noChange = '```css',
            $this->classUnderTest->strip($noChange)
        );

        self::assertEquals(
            $noChange = '``` a code block',
            $this->classUnderTest->strip($noChange)
        );

        self::assertEquals(
            $noChange = ' ```',
            $this->classUnderTest->strip($noChange)
        );

        // TODO extend to real block tests
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

    public function testTable(): void
    {
        self::assertSame(
            $noChange = "Most | minimalistic\n--- | ---\nmarkdown | table",
            $this->classUnderTest->strip("Most | minimalistic\n--- | ---\n*markdown* | table")
        );

        self::assertSame(
            $noChange = "| Tables        | Are           | Cool |\n| ------------- | ------------- | ----- |\n| col 3 is      | right-aligned | $1600 |",
            $this->classUnderTest->strip("| __Tables__        | Are           | Cool |\n| ------------- |:-------------:| -----:|\n| col 3 is      | right-aligned | $1600 |")
        );

        self::assertSame(
            $noChange = "Some | nasty\n --- | ---\nmarkdown | table",
            $this->classUnderTest->strip("Most | nasty\n:---:| ---\n**markdown** | *table*")
        );
    }
}
