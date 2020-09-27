<?php
namespace UnMarkdown\Tests;

use UnMarkdown\Stripper;
use PHPUnit\Framework\TestCase;

class InlineTest extends TestCase
{
    /**
     * @var Stripper
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new Stripper();
    }

    public function testStrongWithAsterisk(): void
    {
        $expected = 'Test strong replacement';

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('**Test** strong replacement')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test **strong** replacement')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test strong **replacement**')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('**Test** **strong** **replacement**')
        );
    }

    public function testStrongWithUnderline(): void
    {
        $expected = 'Test strong replacement';

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('__Test__ strong replacement')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test __strong__ replacement')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test strong __replacement__')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('__Test__ __strong__ __replacement__')
        );
    }

    public function testItalicWithAsterisk(): void
    {
        $expected = 'Test italic replacement';

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('*Test* italic replacement')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test *italic* replacement')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test italic *replacement*')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('*Test* *italic* *replacement*')
        );
    }

    public function testItalicWithUnderline(): void
    {
        $exptect = 'Test italic replacement';

        self::assertSame(
            $exptect,
            $this->classUnderTest->strip('_Test_ italic replacement')
        );

        self::assertSame(
            $exptect,
            $this->classUnderTest->strip('Test _italic_ replacement')
        );

        self::assertSame(
            $exptect,
            $this->classUnderTest->strip('Test italic _replacement_')
        );

        self::assertSame(
            $exptect,
            $this->classUnderTest->strip('_Test_ _italic_ _replacement_')
        );
    }

    public function testStrikethrough(): void
    {
        $expected = 'Test strikethrough replacement';

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('~~Test~~ strikethrough replacement')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test ~~strikethrough~~ replacement')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test strikethrough ~~replacement~~')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('~~Test~~ ~~strikethrough~~ ~~replacement~~')
        );
    }

    public function testStrongAndItalicWithAsterisk(): void
    {
        $expected = 'Test strong replacement';

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('***Test*** strong replacement')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test ***strong*** replacement')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test strong ***replacement***')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('***Test*** ***strong*** ***replacement***')
        );
    }

    public function testStrongAndItalicWithUnderline(): void
    {
        $expected = 'Test strong replacement';

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('___Test___ strong replacement')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test ___strong___ replacement')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test strong ___replacement___')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('___Test___ ___strong___ ___replacement___')
        );
    }

    public function testInlineCode(): void
    {
        self::assertSame(
            'Test code replacement',
            $this->classUnderTest->strip('`Test` code replacement')
        );

        self::assertSame(
            'Test code replacement',
            $this->classUnderTest->strip('Test `code` replacement')
        );

        self::assertSame(
            'Test code replacement',
            $this->classUnderTest->strip('Test code `replacement`')
        );

        self::assertSame(
            'Test code replacement',
            $this->classUnderTest->strip('`Test` `code` `replacement`')
        );
    }

    public function testInlineImage(): void
    {
        self::assertSame(
            '🖼️ inline image alt text Test replacement',
            $this->classUnderTest->strip('![inline image alt text](https://example-com/image.jpg) Test replacement')
        );

        self::assertSame(
            'Test 🖼️ inline image alt text replacement',
            $this->classUnderTest->strip('Test ![inline image alt text](https://example-com/image.jpg) replacement')
        );

        self::assertSame(
            'Test replacement 🖼️ inline image alt text',
            $this->classUnderTest->strip('Test replacement ![inline image alt text](https://example-com/image.jpg)')
        );
    }

    public function testInlineImageWithTitle(): void
    {
        self::assertSame(
            '🖼️ inline image alt text Test replacement',
            $this->classUnderTest->strip('![inline image alt text](https://example-com/image.jpg "Logo Title Text 1") Test replacement')
        );

        self::assertSame(
            'Test 🖼️ inline image alt text replacement',
            $this->classUnderTest->strip('Test ![inline image alt text](https://example-com/image.jpg "Logo Title Text 1") replacement')
        );

        self::assertSame(
            'Test replacement 🖼️ inline image alt text',
            $this->classUnderTest->strip('Test replacement ![inline image alt text](https://example-com/image.jpg "Logo Title Text 1")')
        );
    }

    public function testReferenceStyleImage(): void
    {
        self::assertSame(
            '🖼️ reference style image alt text Test replacement',
            $this->classUnderTest->strip('![reference style image alt text][logo] Test replacement')
        );

        self::assertSame(
            'Test 🖼️ reference style image alt text replacement',
            $this->classUnderTest->strip('Test ![reference style image alt text][logo] replacement')
        );

        self::assertSame(
            'Test replacement 🖼️ reference style image alt text',
            $this->classUnderTest->strip('Test replacement ![reference style image alt text][logo]')
        );
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
            'Test replacement 🔗 https://www.google.com ',
            $this->classUnderTest->strip('Test replacement [I\'m an inline-style link](https://www.google.com) ')
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
}
