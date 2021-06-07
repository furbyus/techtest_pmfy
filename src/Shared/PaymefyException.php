<?php

namespace Paymefy\Shared;

use Exception;

class PaymefyException extends Exception
{
    protected $message = "Unespecified Exception";

    public function __construct(string $message = null, $code = 0, Exception $previous = null)
    {
        $this->message = $message ?: $this->message;
        $this->message .= $previous ? "\nPREVIOUS: " . $previous?->getMessage() : "";
        parent::__construct($this->message, $code, $previous);
    }
}
