<?php

namespace Paymefy\Shared\Application\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ContainerHelper
{
    private ParameterBagInterface $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function getApplicationRootDir(): string
    {
        return $this->params->get('kernel.project_dir');
    }
}
