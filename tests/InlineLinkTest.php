<?php
namespace UnMarkdown\Tests;

use UnMarkdown\Stripper;
use PHPUnit\Framework\TestCase;

class InlineLinkTest extends TestCase
{
    /**
     * @var Stripper
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new Stripper();
    }

    public function testInlineStyleLink(): void
    {
        self::assertSame(
            '🔗 https://www.google.com Test replacement',
            $this->classUnderTest->strip('[I\'m an inline-style link](https://www.google.com) Test replacement')
        );

        self::assertSame(
            'Test 🔗 https://www.google.com replacement',
            $this->classUnderTest->strip('Test [I\'m an inline-style link](https://www.google.com) replacement')
        );

        self::assertSame(
            'Test replacement 🔗 https://www.google.com',
            $this->classUnderTest->strip('Test replacement [I\'m an inline-style link](https://www.google.com)')
        );
    }

    public function testInlineStyleLinkWithTitle(): void
    {
        self::assertSame(
            '🔗 https://www.google.com "Google\'s Homepage" Test replacement',
            $this->classUnderTest->strip('[I\'m an inline-style link with title](https://www.google.com "Google\'s Homepage") Test replacement')
        );

        self::assertSame(
            'Test 🔗 https://www.google.com "Google\'s Homepage" replacement',
            $this->classUnderTest->strip('Test [I\'m an inline-style link with title](https://www.google.com "Google\'s Homepage") replacement')
        );

        self::assertSame(
            'Test replacement 🔗 https://www.google.com "Google\'s Homepage"',
            $this->classUnderTest->strip('Test replacement [I\'m an inline-style link with title](https://www.google.com "Google\'s Homepage")')
        );
    }

    public function testReferenceStyleLink(): void
    {
        self::assertSame(
            '🔗 I\'m a reference-style link Test replacement',
            $this->classUnderTest->strip('[I\'m a reference-style link][Arbitrary case-insensitive reference text] Test replacement')
        );

        self::assertSame(
            'Test 🔗 I\'m a reference-style link replacement',
            $this->classUnderTest->strip('Test [I\'m a reference-style link][Arbitrary case-insensitive reference text] replacement')
        );

        self::assertSame(
            'Test replacement 🔗 I\'m a reference-style link',
            $this->classUnderTest->strip('Test replacement [I\'m a reference-style link][Arbitrary case-insensitive reference text]')
        );

        self::assertSame(
            '🔗 You can use numbers for reference-style link definitions Test replacement',
            $this->classUnderTest->strip('[You can use numbers for reference-style link definitions][1] Test replacement')
        );

        self::assertSame(
            'Test 🔗 You can use numbers for reference-style link definitions replacement',
            $this->classUnderTest->strip('Test [You can use numbers for reference-style link definitions][1] replacement')
        );

        self::assertSame(
            'Test replacement 🔗 You can use numbers for reference-style link definitions',
            $this->classUnderTest->strip('Test replacement [You can use numbers for reference-style link definitions][1]')
        );
    }

    public function testKeepPlainLinks(): void
    {
        self::assertSame(
            'https://www.google.com Test replacement',
            $this->classUnderTest->strip('https://www.google.com Test replacement')
        );

        self::assertSame(
            'Test https://www.google.com replacement',
            $this->classUnderTest->strip('Test https://www.google.com replacement')
        );

        self::assertSame(
            'Test replacement https://www.google.com',
            $this->classUnderTest->strip('Test replacement https://www.google.com')
        );
    }

    public function testEscapedInlineImage(): void
    {
        self::assertSame(
            '[I\'m an inline-style link](https://www.google.com) Test replacement',
            $this->classUnderTest->strip('\[I\'m an inline-style link](https://www.google.com) Test replacement')
        );

        self::assertSame(
            'Test [I\'m an inline-style link](https://www.google.com) replacement',
            $this->classUnderTest->strip('Test \[I\'m an inline-style link](https://www.google.com) replacement')
        );

        self::assertSame(
            'Test replacement [I\'m an inline-style link](https://www.google.com)',
            $this->classUnderTest->strip('Test replacement \[I\'m an inline-style link](https://www.google.com)')
        );

        self::assertSame(
            '[I\'m an inline-style link](https://www.google.com)',
            $this->classUnderTest->strip('[I\'m an inline-style link\](https://www.google.com)')
        );

        self::assertSame(
            '[I\'m an inline-style link](https://www.google.com)',
            $this->classUnderTest->strip('[I\'m an inline-style link]\(https://www.google.com)')
        );

        self::assertSame(
            '[I\'m an inline-style link](https://www.google.com)',
            $this->classUnderTest->strip('[I\'m an inline-style link](https://www.google.com\)')
        );
    }
}
