<?php

namespace Paymefy\Renewals\Application\Task;

use Exception;
use Paymefy\Renewals\Domain\Model\Client;
use Paymefy\Shared\Application\Service\HttpClient;

class GetExpiringRenewalsFromPaymefy
{
    private const URL = 'https://jsonplaceholder.typicode.com/users';
    
    private HttpClient $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }
    public function run(): array
    {
        $response = $this->httpClient->get($this::URL);

        if ($response->getStatusCode() !== 200) {
            throw new Exception("Something's wrong with the request to " . $this::URL);
        }

        $responseClients = json_decode($response->getBody());

        return array_map(
            function ($element) {
                $client = new Client();
                $client
                    ->setCompany($element->company?->name)
                    ->setName($element->name)
                    ->setEmail($element->email)
                    ->setPhone($element->phone);

                return $client;
            },
            $responseClients
        );
    }
}
