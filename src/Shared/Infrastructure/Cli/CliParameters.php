<?php

namespace Paymefy\Shared\Infrastructure\Cli;

use Paymefy\Shared\Trait\Arrayable;
use Paymefy\Shared\Trait\ArrayableInterface;
use ReflectionProperty;

class CliParameters implements ArrayableInterface
{
    use Arrayable;

    public function addParameter(CliParameter $attribute, ?string $propertyName = null): ReflectionProperty
    {
        $propertyName = $propertyName ?: $attribute->name;
        $this->{$propertyName} = $attribute;
        return new ReflectionProperty($this, $propertyName);
    }

    public function getParameter(string $name): CliParameter|null
    {
        return $this->{$name} ?: null;
    }

    public function toAssocArray(): array
    {
        $parameters = $this->toArray();
        $assocParameters = [];
        foreach ($parameters as $parameterName => $parameterValue) {
            $assocParameters[$parameterName] = $parameterValue->getValue();
        }
        return $assocParameters;
    }
}
