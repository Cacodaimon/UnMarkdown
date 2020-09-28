<?php
namespace UnMarkdown\Tests;

use UnMarkdown\Stripper;
use PHPUnit\Framework\TestCase;

class InlineMixedStrongAndItalicTest extends TestCase
{
    /**
     * @var Stripper
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new Stripper();
    }

    public function testStrongAndItalicWithAsterisk(): void
    {
        $expected = 'Test strong and italic replacement';

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('***Test*** strong and italic replacement')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test ***strong*** and italic replacement')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test strong and italic ***replacement***')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('***Test*** ***strong*** and italic ***replacement***')
        );

        self::assertSame(
            $noChange = 'Test strong *** replacement ***',
            $this->classUnderTest->strip($noChange)
        );
    }

    public function testStrongAndItalicWithUnderline(): void
    {
        $expected = 'Test strong and italic replacement';

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('___Test___ strong and italic replacement')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test ___strong___ and italic replacement')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test strong and italic ___replacement___')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('___Test___ ___strong___ and italic ___replacement___')
        );

        self::assertSame(
            $noChange = 'Test strong and italic ___ replacement ___',
            $this->classUnderTest->strip($noChange)
        );
    }

    public function testStrongAndItalicMixedWithAsterisk(): void
    {
        $expected = 'Test strong and italic replacement';

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('*__Test__* strong and italic replacement')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test _**strong**_ and italic replacement')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('Test strong and italic *__replacement__*')
        );

        self::assertSame(
            $expected,
            $this->classUnderTest->strip('*__Test__* _**strong**_ and italic _**replacement**_')
        );

        self::assertSame(
            $noChange = 'Test * strong * and italic ** replacement **',
            $this->classUnderTest->strip('Test __* strong *__ and italic _** replacement **_')
        );
    }
}
