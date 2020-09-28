<?php
namespace UnMarkdown\Tests;

use UnMarkdown\Stripper;
use PHPUnit\Framework\TestCase;

class BlockHeadingAndRulerTest extends TestCase
{
    /**
     * @var Stripper
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new Stripper();
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
}
