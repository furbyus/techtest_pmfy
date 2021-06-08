<?php

namespace Paymefy\Renewals\Domain\Model;

use JsonSerializable;
use ReflectionObject;
use stdClass;

class BaseModel implements JsonSerializable
{
    public function jsonSerialize(): mixed
    {
        $reflectedObject = new ReflectionObject($this);
        $properties = $reflectedObject->getProperties();
        $toSerialize = new stdClass;
        foreach ($properties as $property) {
            $property->setAccessible(true);
            $toSerialize->{$property->getName()} = $property->getValue($this);
        }
        return $toSerialize;
    }
}
