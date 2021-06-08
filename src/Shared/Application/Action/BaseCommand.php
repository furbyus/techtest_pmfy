<?php

namespace Paymefy\Shared\Application\Action;

use DeepCopy\Reflection\ReflectionHelper;
use ReflectionClass;

class BaseCommand implements CommandInterface
{

    public function getReflectedProperties(): array
    {
        $reflectedCommand = new ReflectionClass(self::class);
        return ReflectionHelper::getProperties($reflectedCommand);
    }
}
