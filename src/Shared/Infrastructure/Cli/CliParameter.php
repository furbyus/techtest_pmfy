<?php

namespace Paymefy\Shared\Infrastructure\Cli;

use phpDocumentor\Reflection\Types\Null_;

class CliParameter
{
    public const TYPE_ARGUMENT = "argument";
    public const TYPE_OPTION = "option";

    public function __construct(
        public string $name,
        private string $type = self::TYPE_ARGUMENT,
        private bool $required = true,
        private string $description = "",
        private string|null $value = null
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getValue(): string|null
    {
        return $this->value;
    }

    public function setValue(?string $value): void
    {
        $this->value = $value;
    }
}
