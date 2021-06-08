<?php

namespace Paymefy\Shared\Application\Action;

interface CommandInterface
{
    public function getReflectedProperties(): array;
}