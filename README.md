# Arty Coding Style

This is the coding style tools config I use everyday on my projects.

it includes :
- PHPCS for code sniffing.
- PHPStan for static bug finding into code.
- PHPAt as phpstan extension for architecture validation

## Installation

Installation with composer :

```bash
composer require arty/php-coding-standard --dev
```

## Usage

### PHPCS

In your project, create a `phpcs.xml` file and fill it up with :

```xml
<?xml version="1.0"?>
<ruleset name="Arty Coding Standard" 
         xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
         xsi:noNamespaceSchemaLocation="../../vendor/squizlabs/php_codesniffer/phpcs.xsd">
    <rule ref="./vendor/arty/php-coding-standard/lib/phpcs/phpcs.xml" />
</ruleset>
```

Run it with :
```bash
$ ./vendor/bin/phpcs src
```

### PHPStan

In your project, create a `phpstan.neon` file and fill it up with :

```neon
includes:
    - vendor/arty/php-coding-standard/lib/phpstan/phpstan.neon
```

Run it with :
```bash
$ ./vendor/bin/phpstan analyse --level=max src
```

### PHPAT

Validate Architecture.

A minimal Clean Architecture validation is provided, activate it by adding this to your phpstan.neon:

```neon
services:
    -
        class: ArtyCodingStandard\PHPAt\CleanArchitectureTest
        tags:
            - phpat.test
```
