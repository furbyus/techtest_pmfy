<?php

namespace Paymefy\Shared\Application;

interface TaskInterface
{
    public function run(): int;
}