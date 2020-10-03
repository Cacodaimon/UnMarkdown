<?php
namespace UnMarkdown\Tests;

use UnMarkdown\MarkdownRemover;
use PHPUnit\Framework\TestCase;

class InlineLinkTest extends TestCase
{
    /**
     * @var MarkdownRemover
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new MarkdownRemover();
    }

    public function testInlineStyleLink(): void
    {
        self::assertSame(
            'I\'m an inline-style link 🔗 https://www.google.com Test replacement',
            $this->classUnderTest->strip('[I\'m an inline-style link](https://www.google.com) Test replacement')
        );

        self::assertSame(
            'Test I\'m an inline-style link 🔗 https://www.google.com replacement',
            $this->classUnderTest->strip('Test [I\'m an inline-style link](https://www.google.com) replacement')
        );

        self::assertSame(
            'Test replacement I\'m an inline-style link 🔗 https://www.google.com',
            $this->classUnderTest->strip('Test replacement [I\'m an inline-style link](https://www.google.com)')
        );
    }

    public function testInlineStyleLinkWithTitle(): void
    {
        self::assertSame(
            'I\'m an inline-style link with title 🔗 https://www.google.com "Google\'s Homepage" Test replacement',
            $this->classUnderTest->strip('[I\'m an inline-style link with title](https://www.google.com "Google\'s Homepage") Test replacement')
        );

        self::assertSame(
            'Test I\'m an inline-style link with title 🔗 https://www.google.com "Google\'s Homepage" replacement',
            $this->classUnderTest->strip('Test [I\'m an inline-style link with title](https://www.google.com "Google\'s Homepage") replacement')
        );

        self::assertSame(
            'Test replacement I\'m an inline-style link with title 🔗 https://www.google.com "Google\'s Homepage"',
            $this->classUnderTest->strip('Test replacement [I\'m an inline-style link with title](https://www.google.com "Google\'s Homepage")')
        );
    }

    public function testInlineStyleLinkWithFragment(): void
    {
        self::assertSame(
            'link 🔗 #fragment',
            $this->classUnderTest->strip('[link](#fragment)')
        );
    }

    public function testInlineStyleLinkImageAsName(): void
    {
        self::assertSame(
            '🖼️ moon 🔗 moon.jpg',
            $this->classUnderTest->strip('[![moon](moon.jpg)](/uri)')
        );
    }

    public function testReferenceStyleLink(): void
    {
        $mdLinkText =  '[I\'m a reference-style link][Arbitrary case-insensitive reference text]';
        $mdLinkRefText =  '[arbitrary case-insensitive reference text]: https://example.com/foo.php';

        $mdLinkNumber =  '[You can use numbers for reference-style link definitions][1]';
        $mdLinkRefNumber =  '[1]: /examples/foo.php';

        self::assertSame(
            "I'm a reference-style link 🔗 https://example.com/foo.php Test replacement\nSome text",
            $this->classUnderTest->strip("$mdLinkText Test replacement\nSome text\n$mdLinkRefText\n[1]: foo")
        );

        self::assertSame(
            "Test I'm a reference-style link 🔗 https://example.com/foo.php replacement\nSome text",
            $this->classUnderTest->strip("Test $mdLinkText replacement\nSome text\n$mdLinkRefText")
        );

        self::assertSame(
            "Test replacement I'm a reference-style link 🔗 https://example.com/foo.php\nSome text",
            $this->classUnderTest->strip("Test replacement $mdLinkText\nSome text\n$mdLinkRefText")
        );

        self::assertSame(
            "You can use numbers for reference-style link definitions 🔗 /examples/foo.php Test replacement\nSome text",
            $this->classUnderTest->strip("$mdLinkNumber Test replacement\nSome text\n$mdLinkRefNumber")
        );

        self::assertSame(
            "Test You can use numbers for reference-style link definitions 🔗 /examples/foo.php replacement\nSome text",
            $this->classUnderTest->strip("Test $mdLinkNumber replacement\nSome text\n$mdLinkRefNumber")
        );

        self::assertSame(
            "Test replacement You can use numbers for reference-style link definitions 🔗 /examples/foo.php\nSome text",
            $this->classUnderTest->strip("Test replacement $mdLinkNumber\nSome text\n$mdLinkRefNumber")
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
