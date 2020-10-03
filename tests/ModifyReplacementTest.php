<?php
namespace UnMarkdown\Tests;

use UnMarkdown\MarkdownRemover;
use PHPUnit\Framework\TestCase;
use UnMarkdown\ReEmphasis;
use UnMarkdown\UnMarkdownReplacement;

/**
 * Class ModifyReplacementTest
 * @package UnMarkdown\Tests
 * @author Guido Krömer <mail@cacodaemon.de>
 */
class ModifyReplacementTest extends TestCase
{
    public function testReplaceWholeRule(): void
    {
        $classUnderTest = new MarkdownRemover();
        $classUnderTest->getReplacements()[8] = new UnMarkdownReplacement(
            '/(?<=[^\\\\]|^)(_|\*)\1((?!(\1|\s)).+?)(?<=[^\\\\])\1{2}/',
            function ($matches) {
                return ReEmphasis::toBold($matches[2]);
            },
            'strong with _|*',
            UnMarkdownReplacement::TYPE_INLINE
        );
        self::assertSame(
            'Test 𝘀𝘁𝗿𝗼𝗻𝗴 replacement',
            $classUnderTest->strip('Test **strong** replacement')
        );
    }

    public function testReplaceReplacement(): void
    {
        $classUnderTest = new MarkdownRemover();
        $classUnderTest
            ->getReplacements()[8]
            ->setReplace(function ($matches) {
                return ReEmphasis::toBold($matches[2]);
            });
        $classUnderTest
            ->getReplacements()[9]
            ->setReplace(function ($matches) {
            return ReEmphasis::toItalic($matches[2]);
        });
        $classUnderTest
            ->getReplacements()[16]
            ->setReplace(function ($matches) {
                return ReEmphasis::toMonospaced($matches[1]);
            });

        self::assertSame(
            '𝗧𝗲𝘀𝘁 𝘪𝘵𝘢𝘭𝘪𝘤 𝚛𝚎𝚙𝚕𝚊𝚌𝚎𝚖𝚎𝚗𝚝',
            $classUnderTest->strip('**Test** *italic* `replacement`')
        );
    }
}
