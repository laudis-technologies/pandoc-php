# Pandoc PHP

## Installation

Install [pandoc](https://github.com/jgm/pandoc) on your system.
 
Install pandoc-php with [composer](http://getcomposer.org)

```bash
composer require laudis/pandoc-php
```

## Simple usage

You can convert text using the convert method.

```php
use Laudis\Pandoc\Pandoc;

$pandoc = new Pandoc();
echo $pandoc->convert('#Hello Pandoc', 'html'); //outputs <h1 id="hello-pandoc">Hello Pandoc</h1>
```

Files can be converted like this:

```php 
$pandoc->convertFile(__DIR__.'/my-file.txt', 'html', 'text');
```

## Building commands

Pandoc php also handles more complex systems by using a command builder. This example builds a command which controls pandoc to convert the markdown to a temporary json file.

```php
use Laudis\Pandoc\Commands\Command;
use Laudis\Pandoc\Enums\Option;

$command = Command::create()
    ->withContent('# H1')
    ->withOption(Option::OUTPUT_FILE(), sys_get_temp_dir() . '/tmp.json') // You can use the option enumeration for easy ide integration and built in typo protection.
    ->withOption('-w', 'json'); // You can also just you string options as well

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

They can also be streamed for a seamless experience.

```php 
foreach ($pandoc->stream($command) as $part) {
    echo $part;
}
```
