<?php
namespace UnMarkdown\Tests;

use UnMarkdown\Stripper;
use PHPUnit\Framework\TestCase;

class InlineCodeTest extends TestCase
{
    /**
     * @var Stripper
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new Stripper();
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
}
