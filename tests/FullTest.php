<?php
namespace UnMarkdown\Tests;

use Parsedown;
use Ubench;
use UnMarkdown\MarkdownRemover;
use PHPUnit\Framework\TestCase;

/**
 * Class FullTest
 *
 * This is not a real test, just a debug tool.
 *
 * @package UnMarkdown\Tests
 */
class FullTest extends TestCase
{
    /**
     * @var MarkdownRemover
     */
    private $classUnderTest;

    /**
     * @var String
     */
    private $markdownCheatsheet;

    public function setUp(): void
    {
        $this->classUnderTest = new MarkdownRemover();
        $this->markdownCheatsheet = file_get_contents(__DIR__ . '/Markdown-Cheatsheet.md');
    }

    public function testCheatSheet(): void
    {
        echo $this->classUnderTest->strip($this->markdownCheatsheet);
        self::assertTrue(true);
    }

    public function testCheatSheetWithParsedown(): void
    {
        echo strip_tags(Parsedown::instance()->text($this->markdownCheatsheet));
        self::assertTrue(true);
    }

    public function testPerformance(): void
    {
        $resultParsedown = $this->bench('Parsedown', function ($that){
            strip_tags(Parsedown::instance()->text($that->markdownCheatsheet));
        })['timeRaw'];

        $resultStripper = $this->bench('UnMarkdown', function ($that) {
            (new \UnMarkdown\MarkdownRemover())->strip($that->markdownCheatsheet);
        })['timeRaw'];

        echo "Parsedown $resultParsedown vs Stripper $resultStripper" . PHP_EOL;

        self::assertLessThanOrEqual($resultParsedown, $resultStripper);
    }

    /**
     * @param string $name
     * @param callable $callable
     * @param int $times
     * @return array
     * @throws \Exception
     */
    private function bench(string $name, callable $callable, int $times = 1000)
    {
        $bench = new Ubench;
        $bench->start();
        for($i = 0; $i < $times; $i++) {
            $callable($this);
        }
        $bench->end();

        return [
            'name'    => $name,
            'time'    => $bench->getTime(),
            'timeRaw' => $bench->getTime(true),
            'times'   => $times,
        ];
    }
}
