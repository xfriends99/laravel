<?php

namespace App\Services\AtomicIncFile;

use App\Contracts\Request\MakeRequest;
use App\Exceptions\RequestException;
use GuzzleHttp\Client;
use Exception;
use Psr\Http\Message\ResponseInterface;

class FakePostRequestService implements MakeRequest
{
    /** @var Client */
    private $guzzleClient;

    /**
     * FakePostRequestService constructor.
     */
    public function __construct()
    {
        $this->guzzleClient = new Client([
            'base_uri' => env('ATOMIC_INC_FILE_DOMAIN'),
            'timeout' => 5.0
        ]);
    }

    /**
     * @return array
     * @throws RequestException
     */
    public function send()
    {
        try{
            /** @var ResponseInterface $response */
            $response = $this->guzzleClient->post('/fakepost');

            return json_decode($response->getBody()->getContents(), true);
        } catch (Exception $exception){
            throw new RequestException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}