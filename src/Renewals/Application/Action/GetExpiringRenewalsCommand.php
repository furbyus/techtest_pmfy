<?php

namespace Paymefy\Renewals\Application\Action;

use Paymefy\Shared\Application\Action\BaseCommand;
use Symfony\Component\Validator\Constraints as Assert;

class GetExpiringRenewalsCommand extends BaseCommand
{
    private const ACCEPTED_FORMATS = ['xml', 'json', 'db'];

    #[Assert\Choice(self::ACCEPTED_FORMATS, message: "Please, choose a valid option for the format parameter")]
    private string $format;

    #[Assert\NotBlank(allowNull:true), Assert\Type("string")]
    private string|null $filename;

    public function __construct(string $format = 'xml', ?string $filename = null)
    {
        $this->format = $format;
        $this->filename = $filename;
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    public function getFilename(): string|null
    {
        return $this->filename;
    }
}
