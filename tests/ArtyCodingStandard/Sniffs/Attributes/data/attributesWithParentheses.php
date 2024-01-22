<?php

namespace ArtyCodingStandard\Sniffs\Attributes\data;
use Attribute;

#[Attribute()]
class Foo
{
    #[\Symfony\Contracts\Service\Attribute\Required()]
    private string $property;

    public function __construct(#[\SensitiveParameter()] string $password)
    {
    }

    #[\JetBrains\PhpStorm\Pure()]
    private function getProperty(): string
    {
        return $this->property;
    }
}
