<?php

namespace Paymefy\Shared\Application\Action;

interface CommandInterface
{
    public function getAttributes(): array;
}