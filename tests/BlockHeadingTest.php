<?php
namespace UnMarkdown\Tests;

use UnMarkdown\MarkdownRemover;
use PHPUnit\Framework\TestCase;

class BlockHeadingTest extends TestCase
{
    /**
     * @var MarkdownRemover
     */
    private $classUnderTest;

    public function setUp(): void
    {
        $this->classUnderTest = new MarkdownRemover();
    }

    public function testHeadingWithHashtag(): void
    {
        self::assertSame(
            "\nH1\n",
            $this->classUnderTest->strip('# H1')
        );

        self::assertSame(
            "\nH2\n",
            $this->classUnderTest->strip('## H2')
        );

        self::assertSame(
            "\nH3\n",
            $this->classUnderTest->strip('### H3')
        );

        self::assertSame(
            "\nH4\n",
            $this->classUnderTest->strip('#### H4')
        );

        self::assertSame(
            "\nH5\n",
            $this->classUnderTest->strip('##### H5')
        );

        self::assertSame(
            "\nH6\n",
            $this->classUnderTest->strip('###### H6')
        );
    }

    public function testLeadingSpacesHeadingWithHashtag(): void
    {
        self::assertSame(
            "\nH1\n",
            $this->classUnderTest->strip(' # H1')
        );

        self::assertSame(
            "\nH1\n",
            $this->classUnderTest->strip('  # H1')
        );

        self::assertSame(
            "\nH1\n",
            $this->classUnderTest->strip('   # H1')
        );

        self::assertSame(
            $noChange = '    # H1',
            $this->classUnderTest->strip($noChange)
        );
    }

    public function testNotAHeadingWithHashtag(): void
    {
        self::assertSame(
            $noChange = 'aaa # H1',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = 'aaa ## H2',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = 'aaa ### H3',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = 'aaa #### H4',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = 'aaa ##### H5',
            $this->classUnderTest->strip($noChange)
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

    public function testEscapedHeadingWithHashtag(): void
    {
        self::assertSame(
            '# H1',
            $this->classUnderTest->strip('\# H1')
        );

        self::assertSame(
            '## H2',
            $this->classUnderTest->strip('#\# H2')
        );

        self::assertSame(
            '## H2',
            $this->classUnderTest->strip('\#\# H2')
        );

        self::assertSame(
            $noChange = 'aaa ### H3',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = 'aaa #### H4',
            $this->classUnderTest->strip($noChange)
        );

        self::assertSame(
            $noChange = 'aaa ##### H5',
            $this->classUnderTest->strip($noChange)
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
