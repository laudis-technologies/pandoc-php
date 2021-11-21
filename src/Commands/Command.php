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

namespace Laudis\Pandoc\Commands;

use Laudis\Pandoc\Enums\Option;

final class Command
{
    /** @var list<OptionArgument> */
    private array $options;
    /** @var list<string> */
    private array $files;
    /**
     * @var string|resource|null
     */
    private $contentOrResource;

    /**
     * @param list<OptionArgument> $options
     * @param list<string>         $files
     */
    public function __construct(array $options, array $files)
    {
        $this->options = $options;
        $this->files = $files;
    }

    public static function create(): self
    {
        return new self([], []);
    }

    public function withOptionArgument(OptionArgument $option): self
    {
        $this->options[] = $option;

        return $this;
    }

    /**
     * @param Option|string $option
     */
    public function withOption($option, ?string $argument = null): self
    {
        $this->options[] = new OptionArgument($option, $argument);

        return $this;
    }

    public function withFile(string $file): self
    {
        $this->files[] = $file;

        return $this;
    }

    public function withContent(string $content): self
    {
        $this->contentOrResource = $content;

        return $this;
    }

    /**
     * @param resource $resource
     */
    public function withResource($resource): self
    {
        $this->contentOrResource = $resource;

        return $this;
    }

    /**
     * @return list<OptionArgument>
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @return list<string>
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * @return resource|string|null
     */
    public function getContentOrResource()
    {
        return $this->contentOrResource;
    }
}
