<?php

namespace Paymefy\Shared\Trait;

trait Arrayable
{
    //TODO mejor usar un metodo custom usando reflection?
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
