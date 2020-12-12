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

namespace Laudis\Pandoc;

use Generator;
use Laudis\Pandoc\Commands\Command;
use Laudis\Pandoc\Commands\OptionArgument;
use Laudis\Pandoc\Enums\Option;
use Laudis\Pandoc\Exceptions\PandocException;
use Symfony\Component\Process\Process;
use UnexpectedValueException;

final class Pandoc
{
    private string $binary;

    public function __construct(string $binary = 'pandoc')
    {
        $this->binary = $binary;
    }

    /**
     * @param iterable<OptionArgument> $options
     *
     * @throws PandocException
     */
    public function convert(string $content, string $to = null, string $from = null, iterable $options = []): string
    {
        $command = Command::create()->withContent($content);
        if ($from) {
            $command->withOption(Option::FROM_FORMAT(), $from);
        }
        if ($to) {
            $command->withOption(Option::TO_FORMAT(), $to);
        }
        foreach ($options as $option) {
            $command->withOptionArgument($option);
        }

        return $this->run($command);
    }

    /**
     * @throws PandocException
     *
     * @return Generator<int, string>
     */
    public function stream(Command $command): Generator
    {
        $toExecute = $this->binary;

        foreach ($command->getOptions() as $option) {
            $flag = $option->getOption();
            $toExecute .= ' '.$flag;
            $argument = $option->getValue();
            if ($argument !== null) {
                if (str_starts_with($flag, '--')) {
                    $toExecute .= '=';
                } else {
                    $toExecute .= ' ';
                }
                $toExecute .= $argument;
            }
        }

        $content = $command->getContentOrResource();
        if ($content) {
            if (is_resource($content)) {
                return $this->executeCommand($toExecute, $content);
            }

            return $this->executeCommand('echo "'.$content.'" | '.$toExecute);
        }

        foreach ($command->getFiles() as $file) {
            $toExecute .= ' '.$file;
        }

        return $this->executeCommand($toExecute);
    }

    /**
     * @param iterable<OptionArgument> $options
     *
     * @throws PandocException
     */
    public function convertFile(string $file, string $to = null, string $from = null, iterable $options = []): string
    {
        $command = Command::create()->withFile($file);
        $command = $this->decorateCommand($from, $command, $to, $options);

        return $this->run($command);
    }

    /**
     * @throws PandocException
     */
    public function run(Command $command): string
    {
        $tbr = '';
        try {
            foreach ($this->stream($command) as $trim) {
                $tbr .= $trim;
            }
        } catch (PandocException $e) {
            throw new PandocException($tbr, 0, $e);
        }

        return trim($tbr);
    }

    /**
     * @throws PandocException
     */
    public function getVersion(): string
    {
        $tbr = '';
        try {
            foreach ($this->executeCommand($this->binary.' --version') as $trim) {
                $tbr .= $trim;
            }
        } catch (PandocException $e) {
            throw new PandocException($tbr, 0, $e);
        }

        return trim(str_replace('pandoc', '', trim(explode("\n", $tbr, 2)[0])));
    }

    /**
     * @param iterable<OptionArgument> $options
     */
    private function decorateCommand(?string $from, Command $command, ?string $to, iterable $options): Command
    {
        if ($from) {
            $command->withOption(Option::FROM_FORMAT(), $from);
        }
        if ($to) {
            $command->withOption(Option::TO_FORMAT(), $to);
        }
        foreach ($options as $option) {
            $command->withOptionArgument($option);
        }

        return $command;
    }

    /**
     * @param resource|null $resource
     *
     * @throws PandocException
     *
     * @return Generator<int, string>
     */
    private function executeCommand(string $toExecute, $resource = null): Generator
    {
        $process = Process::fromShellCommandline($toExecute);
        if ($resource !== null) {
            $process->setInput($resource);
        }

        $process->start();
        foreach ($process->getIterator() as $iteration) {
            if (!is_string($iteration)) {
                $message = 'Expected string values from the process iterator. Received: '.gettype($iteration);
                throw new UnexpectedValueException($message);
            }
            yield $iteration;
        }

        if ($process->getExitCode() !== 0) {
            throw new PandocException('Process failed');
        }
    }
}
