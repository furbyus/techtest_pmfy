<?php

namespace Paymefy\Shared\Trait;

interface ValidableInterface
{
    public function validate(?Object $object): void;
}