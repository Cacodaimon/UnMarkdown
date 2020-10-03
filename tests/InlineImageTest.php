<?php
namespace UnMarkdown\Tests;

use UnMarkdown\MarkdownRemover;
use PHPUnit\Framework\TestCase;

class InlineImageTest extends TestCase
{
    /**
     * @var MarkdownRemover
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new MarkdownRemover();
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

    public function testEscapedInlineImage(): void
    {
        self::assertSame(
            '!🔗 https://example-com/image.jpg Test replacement',
            $this->classUnderTest->strip('\![inline image alt text](https://example-com/image.jpg) Test replacement')
        );

        self::assertSame(
            'Test !🔗 https://example-com/image.jpg replacement',
            $this->classUnderTest->strip('Test \![inline image alt text](https://example-com/image.jpg) replacement')
        );

        self::assertSame(
            'Test replacement !🔗 https://example-com/image.jpg',
            $this->classUnderTest->strip('Test replacement \![inline image alt text](https://example-com/image.jpg)')
        );

        self::assertSame(
            '![inline image alt text](https://example-com/image.jpg) Test replacement',
            $this->classUnderTest->strip('!\[inline image alt text](https://example-com/image.jpg) Test replacement')
        );

        self::assertSame(
            'Test replacement !🔗 https://example-com/image.jpg',
            $this->classUnderTest->strip('Test replacement \![inline image alt text](https://example-com/image.jpg)')
        );

        self::assertSame(
            'Test replacement ![inline image alt text](https://example-com/image.jpg)',
            $this->classUnderTest->strip('Test replacement !\[inline image alt text](https://example-com/image.jpg)')
        );

        self::assertSame(
            'Test replacement ![inline image alt text](https://example-com/image.jpg)',
            $this->classUnderTest->strip('Test replacement ![inline image alt text\](https://example-com/image.jpg)')
        );

        self::assertSame(
            'Test replacement ![inline image alt text](https://example-com/image.jpg)',
            $this->classUnderTest->strip('Test replacement ![inline image alt text]\(https://example-com/image.jpg)')
        );

        self::assertSame(
            'Test replacement ![inline image alt text](https://example-com/image.jpg)',
            $this->classUnderTest->strip('Test replacement ![inline image alt text](https://example-com/image.jpg\)')
        );
    }
}
