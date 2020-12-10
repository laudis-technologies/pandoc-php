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

final class OptionArgument
{
    /**
     * @var Option|string
     */
    private $option;
    private ?string $value;

    /**
     * @param Option|string $option
     */
    public function __construct($option, ?string $value = null)
    {
        $this->option = $option;
        $this->value = $value;
    }

    /**
     * @param Option|string $option
     */
    public static function create($option, ?string $value = null): self
    {
        return new self($option, $value);
    }

    public function getOption(): string
    {
        if ($this->option instanceof Option) {
            return $this->option->getValue();
        }

        return $this->option;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }
}
