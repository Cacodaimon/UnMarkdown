<?php
namespace UnMarkdown\Tests;

use UnMarkdown\Stripper;
use PHPUnit\Framework\TestCase;

class BlockQuoteTest extends TestCase
{
    /**
     * @var Stripper
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new Stripper();
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
}
