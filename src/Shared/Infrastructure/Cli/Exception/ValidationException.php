<?php

namespace Paymefy\Shared\Infrastructure\Cli\Exception;

use Paymefy\Shared\PaymefyException;

class ValidationException extends PaymefyException
{
    protected $message = "Validation error";
    
}
