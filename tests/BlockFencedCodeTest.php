<?php
namespace UnMarkdown\Tests;

use UnMarkdown\Stripper;
use PHPUnit\Framework\TestCase;

class BlockFencedCodeTest extends TestCase
{
    /**
     * @var Stripper
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new Stripper();
    }

    public function testCodeBlockBackticks(): void
    {
        self::assertSame(
            $noChange = "Some markdown and a\ncode = **block**;\n",
            $this->classUnderTest->strip("Some **markdown** and a\n```\ncode = **block**;\n```")
        );

        self::assertSame(
            $noChange = "SQL example!\nvar sql = \"SELECT `bar` FROM foo;\";\nvar results = db.execute(sql);\n",
            $this->classUnderTest->strip("**`SQL`** example!\n```java\nvar sql = \"SELECT `bar` FROM foo;\";\nvar results = db.execute(sql);\n```")
        );
    }

    public function testCodeBlockTildes(): void
    {
        self::assertSame(
            $noChange = "Some markdown and a\ncode = **block**;\n",
            $this->classUnderTest->strip("Some **markdown** and a\n~~~\ncode = **block**;\n~~~")
        );

        self::assertSame(
            $noChange = "SQL example!\nvar sql = \"SELECT `bar` FROM foo;\";\nvar results = db.execute(sql);\n",
            $this->classUnderTest->strip("**`SQL`** example!\n~~~java\nvar sql = \"SELECT `bar` FROM foo;\";\nvar results = db.execute(sql);\n~~~")
        );
    }

    public function testNoCodeBlockBackticks(): void
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
    }

    public function testNoCodeBlockTildes(): void
    {
        self::assertSame(
            $noChange = 'not a ~~~ code block',
            $this->classUnderTest->strip($noChange)
        );

        self::assertEquals(
            $noChange = '~~~',
            $this->classUnderTest->strip($noChange)
        );

        self::assertEquals(
            $noChange = '~~~css',
            $this->classUnderTest->strip($noChange)
        );

        self::assertEquals(
            $noChange = '~~~ a code block',
            $this->classUnderTest->strip($noChange)
        );

        self::assertEquals(
            $noChange = ' ~~~',
            $this->classUnderTest->strip($noChange)
        );
    }
}
