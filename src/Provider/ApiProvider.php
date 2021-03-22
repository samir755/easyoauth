<?php
/**
 * Created by Samir_H
 */

namespace EasyOauth\src\Provider;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use \Symfony\Contracts\HttpClient\ResponseInterface;

class ApiProvider
{

    protected $client;
    protected $em;
    protected $limit;
    protected $clientId;
    protected $clientSecret;
    protected $clientUri;
    protected $clientScope;

    /**
     * ApiProvider constructor
     *
     * @param HttpClientInterface $client
     * @param EntityManagerInterface $em
     * @param $clientId
     * @param $clientSecret
     * @param $clientUri
     * @param $clientScope
     */
    public function __construct(HttpClientInterface $client, EntityManagerInterface $em, $clientId, $clientSecret, $clientUri, $clientScope)
    {
        $this->client = $client;
        $this->em = $em;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->clientUri = $clientUri;
        $this->clientScope = $clientScope;
    }

    /**
     * @param $method
     * @param $body
     *
     * @return ResponseInterface
     * @throws
     */
    public function callAPI($method, array $body){
        try{
            $response = $this->client->request($method, $this->clientUri, [
                'body' => $body
            ]);

            $this->limit = $response->toArray()['expires_in'];

        }catch (\Exception $e){
            dd("fatal error: ".$e->getMessage());
        }

        return $response;
    }


}