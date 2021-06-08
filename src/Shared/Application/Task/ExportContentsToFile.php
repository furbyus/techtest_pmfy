<?php

namespace Paymefy\Shared\Application\Task;

use Ramsey\Uuid\Uuid;
use Paymefy\Shared\Application\Service\ContainerHelper;

class ExportContentsToFile
{
    private ContainerHelper $helper;

    public function __construct(ContainerHelper $helper)
    {
        $this->helper = $helper;
    }

    public function run(string $contents, ?string $filename, ?string $extension = ""): string
    {
        $rootDir = $this->helper->getApplicationRootDir();
        $filename = $filename ? $rootDir . $filename : $rootDir . "/public/" . Uuid::uuid6()->toString();
        $filename .= ".$extension";

        try {
            $fileHandler = fopen($filename, 'w');
            fwrite($fileHandler, $contents);
        } catch (\Throwable $th) {
            throw $th;
        }

        return $filename;
    }
}
