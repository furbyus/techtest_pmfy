<?php

namespace Paymefy\Shared\Application\Service;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class FileReader 
{
    private File $file;

    /*
    * @throws FileException
    */
    public function getContents(string $filename): string
    {
        $this->file = new File($filename);
        if(!$this->file->isFile() || !$this->file->isReadable()){
            throw new FileException("The file doesn't exists or is not readable!");
        }
        return $this->file->getContent();
    }
}