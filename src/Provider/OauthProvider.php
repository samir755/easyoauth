<?php
/**
 * Created by Samir_H
 */

namespace EasyOauth\src\Provider;

use EasyOauth\src\Entity\Token;
use Symfony\Contracts\HttpClient\ResponseInterface;

class OauthProvider extends ApiProvider
{

    /**
     * Connexion Oauth method
     *
     * @param boolean $scope //Optional
     */
    public function oauthConnect($scope = false)
    {
        $method = 'POST';

        $body = [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'grant_type' => 'client_credentials'
        ];

        if($scope){
            $body['scope'] = $this->clientScope;
        }

        if(!$this->hasValidToken()){
            $response = $this->callAPI($method, $body);
            $this->saveToken($response);
        }
    }

    /**
     * Get last Token
     *
     * @return object|null
     */
    public function getToken(){
        $token = $this->em->getRepository(Token::class)->findOneBy([
            "isActive" => true
        ]);

        return $token ? $token->getToken() : null;
    }

    /**
     * Check validity of token
     *
     * @param bool $isValid
     * @return bool
     */
    private function hasValidToken($isValid = false){

        $token = $this->em->getRepository(Token::class)->findOneBy([
            "clientId" => $this->clientId,
            "isActive" => true
        ]);

        if($token){
            $createdAt = $token->getCreatedAt();
            $interval = $createdAt->diff(new \DateTime('now'));
            $interval = $this->intervalToSeconds($interval);
            $isValid = ($interval < $token->getLimitDue());

            if(!$isValid){
                $token->setIsActive(false);
                $this->em->persist($token);
                $this->em->flush();
            }
        }

        return $isValid;
    }

    /**
     * Register token in database
     *
     * @param $response
     * @throws
     */
    private function saveToken(ResponseInterface $response){
        if($response->getStatusCode() == 200){
            $token = new Token($this->clientId);

            $token->setIsActive(true);
            $token->setLimitDue($response->toArray()["expires_in"]);
            $token->setTokenId($response->toArray()["access_token"]);

            $this->em->persist($token);
            $this->em->flush();
        }
    }

    /**
     * Method for intervalToSeconds
     *
     * @param $interval
     * @return int
     */
    function intervalToSeconds(\DateInterval $interval) {
        return $interval->days * 86400 + $interval->h * 3600 + $interval->i * 60 + $interval->s;
    }



}