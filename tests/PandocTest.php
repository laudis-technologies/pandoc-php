<?php

declare(strict_types=1);

/*
 * This file is part of the Laudis Pandoc package.
 *
 * (c) Laudis technologies <https://laudis.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Laudis\Pandoc\Tests;

use Laudis\Pandoc\Commands\Command;
use Laudis\Pandoc\Commands\OptionArgument;
use Laudis\Pandoc\Enums\Option;
use Laudis\Pandoc\Exceptions\PandocException;
use Laudis\Pandoc\Pandoc;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\SkippedTestError;
use PHPUnit\Framework\SyntheticSkippedError;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\RecursionContext\InvalidArgumentException;

final class PandocTest extends TestCase
{
    private Pandoc $pandoc;

    protected function setUp(): void
    {
        parent::setUp();
        $this->pandoc = new Pandoc();
    }

    public function testInvalidPandocCommandThrowsException(): void
    {
        $pandoc = new Pandoc('not-any-executable');
        $this->expectException(PandocException::class);
        $pandoc->run(Command::create());
    }

    public function testInvalidFromTypeTriggersException(): void
    {
        $this->expectException(PandocException::class);
        $this->pandoc->convert('#Test Content', 'plain', 'not_value');
    }

    public function testInvalidToTypeTriggersException(): void
    {
        $this->expectException(PandocException::class);
        $this->pandoc->convert('#Test Content', 'not_valid', 'html');
    }

    /**
     * @throws PandocException
     * @throws ExpectationFailedException
     * @throws SkippedTestError
     * @throws SyntheticSkippedError
     * @throws InvalidArgumentException
     */
    public function testBasicMarkdownToHTML(): void
    {
        self::assertSame(
            '<h1 id="test-heading">Test Heading</h1>',
            $this->pandoc->convert('# Test Heading', 'html')
        );
    }

    /**
     * @throws PandocException
     */
    public function testRunWithConvertsBasicMarkdownToJSON(): void
    {
        $command = Command::create()->withContent('# Heading')
            ->withOption(Option::FROM_FORMAT(), 'markdown')
            ->withOption(Option::TO_FORMAT(), 'json');
        self::assertSame(
            '{"blocks":[{"t":"Header","c":[1,["heading",[],[]],[{"t":"Str","c":"Heading"}]]}],"pandoc-api-version":[1,20],"meta":{}}',
            $this->pandoc->run($command)
        );
    }

    /**
     * @throws PandocException
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
    public function testCanConvertMultipleSuccessfully(): void
    {
        $this->pandoc->convert(
            "#Heading 1\n##Heading 2",
            'html'
        );

        self::assertSame(
            "<h3 id=\"heading-3\">Heading 3</h3>\n<h4 id=\"heading-4\">Heading 4</h4>",
            $this->pandoc->convert(
                "### Heading 3\n#### Heading 4",
                'html'
            )
        );
    }

    public function testConvertFile(): void
    {
        $file = sys_get_temp_dir().'/a.md';
        file_put_contents($file, '# TEST A');

        self::assertSame('<h1 id="test-a">TEST A</h1>', $this->pandoc->convertFile($file));
    }

    /**
     * @throws PandocException
     */
    public function testConvertMultiple(): void
    {
        $command = Command::create();
        $file = sys_get_temp_dir().'/a.md';
        file_put_contents($file, '# TEST A');
        $command->withFile($file);
        $file = sys_get_temp_dir().'/b.md';
        file_put_contents($file, '# TEST B');
        $command->withFile($file);

        self::assertSame("<h1 id=\"test-a\">TEST A</h1>\n<h1 id=\"test-b\">TEST B</h1>", $this->pandoc->run($command));
    }

    public function testOutputObject(): void
    {
        $file = sys_get_temp_dir().'/abc.html';
        $this->pandoc->convert('# TEST A', null, null, [OptionArgument::create(Option::OUTPUT_FILE(), $file)]);
        self::assertFileExists($file);
        $contents = file_get_contents($file);
        self::assertEquals('<h1 id="test-a">TEST A</h1>', trim($contents));
    }

    /**
     * @throws PandocException
     */
    public function testStream(): void
    {
        $temp = fopen('php://temp', 'rwb+');
        fwrite($temp, '# HALLO');
        rewind($temp);

        $result = $this->pandoc->stream(Command::create()->withResource($temp));
        $toCheck = '';
        foreach ($result as $toAdd) {
            $toCheck .= $toAdd;
        }
        self::assertEquals('<h1 id="hallo">HALLO</h1>', trim($toCheck));
    }

    /**
     * @throws PandocException
     */
    public function testStreamPractinet(): void
    {
        $temp = fopen('https://laudis.tech', 'rb');

        $command = Command::create()
            ->withResource($temp)
            ->withOption(Option::FROM_FORMAT(), 'html')
            ->withOption(Option::TO_FORMAT(), 'markdown')
        ;

        self::assertEquals('::: {#vue-mount}
:::

::: {.privacy-wrap}
Copyright Practinet - All Rights Reserved \| [Uw privacy](/privacy)
:::

::: {.cookiewarning role="alert"}
:::', $this->pandoc->run($command));
    }

    /**
     * @throws PandocException
     */
    public function testVersion(): void
    {
        self::assertMatchesRegularExpression('/^(\d+\.)+\d$/u', $this->pandoc->getVersion());
    }
}
