<?php
namespace UnMarkdown\Tests;

use UnMarkdown\MarkdownRemover;
use PHPUnit\Framework\TestCase;

/**
 * Class BlockFencedCodeTest
 * @package UnMarkdown\Tests
 * @author Guido Krömer <mail@cacodaemon.de>
 */
class BlockFencedCodeTest extends TestCase
{
    /**
     * @var MarkdownRemover
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new MarkdownRemover();
    }

    public function testCodeBlockBackticks(): void
    {
        self::assertSame(
            "Some markdown and a\ncode = **block**;\n",
            $this->classUnderTest->strip("Some **markdown** and a\n```\ncode = **block**;\n```")
        );

        self::assertSame(
            "SQL example!\nvar sql = \"SELECT `bar` FROM foo;\";\nvar results = db.execute(sql);\n",
            $this->classUnderTest->strip("**SQL** example!\n```java\nvar sql = \"SELECT `bar` FROM foo;\";\nvar results = db.execute(sql);\n```")
        );
    }

    public function testCodeBlockTildes(): void
    {
        self::assertSame(
            "Some markdown and a\ncode = **block**;\n",
            $this->classUnderTest->strip("Some **markdown** and a\n~~~\ncode = **block**;\n~~~")
        );

        self::assertSame(
            "SQL example!\nvar sql = \"SELECT `bar` FROM foo;\";\nvar results = db.execute(sql);\n",
            $this->classUnderTest->strip("**SQL** example!\n~~~java\nvar sql = \"SELECT `bar` FROM foo;\";\nvar results = db.execute(sql);\n~~~")
        );
    }

    public function testEscapedCodeBlock(): void
    {
        self::assertSame(
            $noChange = "\n~~~\ncode = block;\n~~~\n",
            $this->classUnderTest->strip("\n\~~~\ncode = **block**;\n~~~\n")
        );

        self::assertSame(
            "\n```\ncode = block;\n```\n",
            $this->classUnderTest->strip("\n\```\ncode = **block**;\n```\n")
        );

        self::assertSame(
            $noChange = "\n~~~\ncode = block;\n~~~\n",
            $this->classUnderTest->strip("\n~\~~\ncode = **block**;\n~~~\n")
        );

        self::assertSame(
            "\n```\ncode = block;\n```\n",
            $this->classUnderTest->strip("\n`\``\ncode = block;\n```\n")
        );

        self::assertSame(
            $noChange = "\n~~~\ncode = block;\n~~~\n",
            $this->classUnderTest->strip("\n~~\~\ncode = **block**;\n~~~\n")
        );

        self::assertSame(
            "\n```\ncode = block;\n```\n",
            $this->classUnderTest->strip("\n``\`\ncode = **block**;\n```\n")
        );

        self::assertSame(
            $noChange = "\n~~~\ncode = block;\n~~~\n",
            $this->classUnderTest->strip("\n~~~\ncode = **block**;\n\~~~\n")
        );

        self::assertSame(
            "\n```\ncode = block;\n```\n",
            $this->classUnderTest->strip("\n```\ncode = **block**;\n\```\n")
        );

        self::assertSame(
            $noChange = "\n~~~\ncode = block;\n~~~\n",
            $this->classUnderTest->strip("\n~~~\ncode = **block**;\n~\~~\n")
        );

        self::assertSame(
            "\n```\ncode = block;\n```\n",
            $this->classUnderTest->strip("\n```\ncode = **block**;\n`\``\n")
        );

        self::assertSame(
            $noChange = "\n~~~\ncode = block;\n~~~\n",
            $this->classUnderTest->strip("\n~~~\ncode = **block**;\n~~\~\n")
        );

        self::assertSame(
            "\n```\ncode = block;\n```\n",
            $this->classUnderTest->strip("\n```\ncode = **block**;\n``\`\n")
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
