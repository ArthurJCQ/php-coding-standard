<?php

declare(strict_types=1);

namespace ArtyCodingStandard\Sniffs\Attributes;

use SlevomatCodingStandard\Sniffs\TestCase;

class RedundantParenthesesSniffTest extends TestCase
{
    public function testNoErrors(): void
    {
        $report = self::checkFile(__DIR__ . '/data/attributesWithoutParentheses.php');

        self::assertNoSniffErrorInFile($report);
    }

    public function testErrors(): void
    {
        $report = self::checkFile(__DIR__ . '/data/attributesWithParentheses.php');

        $this->assertSame(4, $report->getErrorCount());

        self::assertSniffError($report, 6, RedundantParenthesesSniff::ATTRIBUTE_REDUNDANT_PARENTHESES_CODE);
        self::assertSniffError($report, 9, RedundantParenthesesSniff::ATTRIBUTE_REDUNDANT_PARENTHESES_CODE);
        self::assertSniffError($report, 12, RedundantParenthesesSniff::ATTRIBUTE_REDUNDANT_PARENTHESES_CODE);
        self::assertSniffError($report, 16, RedundantParenthesesSniff::ATTRIBUTE_REDUNDANT_PARENTHESES_CODE);
    }
}
