# Pandoc PHP

[![Maintainability](https://api.codeclimate.com/v1/badges/bb8bb91cf4f225ba296c/maintainability)](https://codeclimate.com/github/laudis-technologies/pandoc-php/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/bb8bb91cf4f225ba296c/test_coverage)](https://codeclimate.com/github/laudis-technologies/pandoc-php/test_coverage)
[![MIT License](https://img.shields.io/apm/l/atomic-design-ui.svg?)](https://github.com/laudis-technologies/neo4j-php-client/blob/main/LICENSE)

## Installation

Install [pandoc](https://github.com/jgm/pandoc) on your system.
 
Install pandoc-php with [composer](http://getcomposer.org)

```bash
composer require laudis/pandoc
```

## Quick usage

Pandoc converts text using the convert method.

```php
use Laudis\Pandoc\Pandoc;

$pandoc = new Pandoc();
echo $pandoc->convert('#Hello Pandoc', 'html'); //outputs <h1 id="hello-pandoc">Hello Pandoc</h1>
```

Pandoc converts files using the convertFile method.

```php 
$pandoc->convertFile(__DIR__.'/my-file.txt', 'html', 'text');
```

## Building commands

Pandoc php also handles more complex systems by accepting commands. A builder pattern creates these.

This example builds a command which controls pandoc to convert the markdown to a temporary JSON file.

```php
use Laudis\Pandoc\Commands\Command;
use Laudis\Pandoc\Enums\Option;

$command = Command::create()
    ->withContent('# H1')
    ->withOption(Option::OUTPUT_FILE(), sys_get_temp_dir() . '/tmp.json') // Use the option enumeration for easy ide integration and built in typo protection.
    ->withOption('-w', 'json'); // Strings can also describe an option

$pandoc->run($command);
```

## Streams and resources

Pandoc php supports resources!

```php
use Laudis\Pandoc\Commands\Command;
use Laudis\Pandoc\Enums\Option;

$command = Command::create()
    ->withResource(fopen('https://laudis.tech', 'rb'))
    ->withOption(Option::FROM_FORMAT(), 'html')
    ->withOption(Option::TO_FORMAT(), 'pdf');

echo $pandoc->run($command);
```

Pandoc also optionally streams the result for a seamless experience.

```php
foreach ($pandoc->stream($command) as $part) {
    echo $part;
}
```

## Configuration

The pandoc constructor accepts the location of the pandoc executable.

```php
$pandoc = new Pandoc(); // Defaults to "pandoc" as the executable,

$pandoc = new Pandoc('/usr/bin/pandoc-beta'); // /usr/bin/pandoc-beta is now the location of the executable,
```

## Version detection

Pandoc is also aware of the version of the executable. The version is accessible through the getVersion method.

```php
$pandoc = new Pandoc();

echo $pandoc->getVersion(); // Echos the version provided in with the --version flag.
```