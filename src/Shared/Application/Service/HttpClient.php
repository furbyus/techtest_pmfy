<?php

namespace Paymefy\Shared\Application\Service;

use GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Message\ResponseInterface;
class HttpClient
{
    private GuzzleClient $guzzleClient;

    public function __construct()
    {
        $this->guzzleClient = new GuzzleClient();
    }

    public function get(string $url): ResponseInterface
    {
        return $this->guzzleClient->get($url);
    }

}
