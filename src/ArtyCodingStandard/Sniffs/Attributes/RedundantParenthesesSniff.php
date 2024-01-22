<?php

declare(strict_types=1);

namespace ArtyCodingStandard\Sniffs\Attributes;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use SlevomatCodingStandard\Helpers\Attribute;
use SlevomatCodingStandard\Helpers\AttributeHelper;

class RedundantParenthesesSniff implements Sniff
{
    public const ATTRIBUTE_REDUNDANT_PARENTHESES_CODE = 'RedundantParentheses';
    private const REDUNDANT_PARENTHESES_PATTERN = '()';

    public function register(): array
    {
        return [T_ATTRIBUTE];
    }

    /** @inheritDoc */
    public function process(File $phpcsFile, $stackPtr): void
    {
        $tokens = $phpcsFile->getTokens();
        $attributes = AttributeHelper::getAttributes($phpcsFile, $stackPtr);

        /** @var Attribute $attribute */
        foreach ($attributes as $attribute) {
            if ($attribute->getContent() !== self::REDUNDANT_PARENTHESES_PATTERN) {
                continue;
            }

            $phpcsFile->addErrorOnLine(
                'Redundant parentheses in attribute',
                $tokens[$attribute->getStartPointer()]['line'],
                self::ATTRIBUTE_REDUNDANT_PARENTHESES_CODE,
            );
        }
    }
}
