<?php
namespace UnMarkdown\Tests;

use UnMarkdown\Stripper;
use PHPUnit\Framework\TestCase;

class BlockHeadingTest extends TestCase
{
    /**
     * @var Stripper
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new Stripper();
    }

    public function testHeadingWithHashtag(): void
    {
        self::assertSame(
            "\nH1\n",
            $this->classUnderTest->strip('# H1')
        );

        self::assertSame(
            $noChange = 'aaa # H1',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            "\nH2\n",
            $this->classUnderTest->strip('## H2')
        );

        self::assertSame(
            $noChange = 'aaa ## H2',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            "\nH3\n",
            $this->classUnderTest->strip('### H3')
        );

        self::assertSame(
            $noChange = 'aaa ### H3',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            "\nH4\n",
            $this->classUnderTest->strip('#### H4')
        );

        self::assertSame(
            $noChange = 'aaa #### H4',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            "\nH5\n",
            $this->classUnderTest->strip('##### H5')
        );

        self::assertSame(
            $noChange = 'aaa ##### H5',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            "\nH6\n",
            $this->classUnderTest->strip('###### H6')
        );

        self::assertSame(
            $noChange = 'aaa ###### H6',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = '####### H7',
            $this->classUnderTest->strip($noChange)
        );
    }
}
