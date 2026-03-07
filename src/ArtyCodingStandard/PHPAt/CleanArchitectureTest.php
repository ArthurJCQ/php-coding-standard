<?php

declare(strict_types=1);

namespace ArtyCodingStandard\PHPAt;

use PHPat\Selector\Selector;
use PHPat\Test\Builder\Rule;
use PHPat\Test\PHPat;

final class CleanArchitectureTest
{
    public function test_domain_does_not_depend_on_application(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('App\Domain'))
            ->shouldNotDependOn()
            ->classes(Selector::inNamespace('App\Application'))
            ->because('Domain is the core layer and must remain independent of outer layers');
    }

    public function test_domain_does_not_depend_on_infrastructure(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('App\Domain'))
            ->shouldNotDependOn()
            ->classes(Selector::inNamespace('App\Infrastructure'))
            ->because('Domain must not know about infrastructure concerns (DB, HTTP, etc.)');
    }

    public function test_domain_does_not_depend_on_symfony(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('App\Domain'))
            ->shouldNotDependOn()
            ->classes(Selector::inNamespace('Symfony'))
            ->because('Domain must be framework-agnostic');
    }

    public function test_domain_does_not_depend_on_doctrine(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('App\Domain'))
            ->shouldNotDependOn()
            ->classes(Selector::inNamespace('Doctrine'))
            ->because('Domain must not depend on persistence concerns');
    }

    public function test_application_does_not_depend_on_infrastructure(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('App\Application'))
            ->shouldNotDependOn()
            ->classes(Selector::inNamespace('App\Infrastructure'))
            ->because('Application layer must depend on Domain abstractions, not Infrastructure implementations');
    }

    public function test_application_does_not_depend_on_symfony(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('App\Application'))
            ->shouldNotDependOn()
            ->classes(Selector::inNamespace('Symfony'))
            ->because('Application use-cases must be framework-agnostic');
    }

    public function test_application_does_not_depend_on_doctrine(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('App\Application'))
            ->shouldNotDependOn()
            ->classes(Selector::inNamespace('Doctrine'))
            ->because('Application layer must not depend on persistence concerns — use Domain repository interfaces instead');
    }
}
