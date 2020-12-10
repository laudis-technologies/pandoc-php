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

use Ds\Vector;
use Laudis\Pandoc\Enums\Option;

final class Command
{
    /** @var Vector<OptionArgument> */
    private Vector $options;
    /** @var Vector<string> */
    private Vector $files;
    /**
     * @var string|resource|null
     */
    private $contentOrResource;

    /**
     * @param Vector<OptionArgument> $options
     * @param Vector<string>         $files
     */
    public function __construct(Vector $options, Vector $files)
    {
        $this->options = $options;
        $this->files = $files;
    }

    public static function create(): self
    {
        return new self(new Vector(), new Vector());
    }

    public function withOptionArgument(OptionArgument $option): self
    {
        $this->options->push($option);

        return $this;
    }

    /**
     * @param Option|string $option
     */
    public function withOption($option, ?string $argument = null): self
    {
        $this->options->push(new OptionArgument($option, $argument));

        return $this;
    }

    public function withFile(string $file): self
    {
        $this->files->push($file);

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
     * @return Vector<OptionArgument>
     */
    public function getOptions(): Vector
    {
        return $this->options;
    }

    /**
     * @return Vector<string>
     */
    public function getFiles(): Vector
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
