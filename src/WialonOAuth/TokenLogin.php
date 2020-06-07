<?php

namespace valentinbv\WialonOAuth;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\TransferException;
use valentinbv\WialonOAuth\Exception\TokenLoginException;

class TokenLogin {

    private const PARAM_TOKEN = 'token';
    private const PARAM_OPERATE_AS = 'operate_as';
    private const PARAM_FL = 'fl';

    /**
     * @var array
     */
    private $params = [];
    /**
     * @var string
     */
    private $host = '';
    /**
     * @var string
     */
    private $svc = 'token/login';
    /**
     * 
     * @var \GuzzleHttp\ClientInterface
     */
    private $httpClient;

    /**
     * TokenLogin constructor
     * @param string $host
     * @param \GuzzleHttp\ClientInterface $httpClient
     */
    public function __construct(string $host, ClientInterface $httpClient) {
        $this->host = $host;
        $this->httpClient = $httpClient;
    }

    /**
     * Get host
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * Get params
     * @return string
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * Get svc
     * @return string
     */
    public function getSvc(): string
    {
        return $this->svc;
    }

    /**
     * Set token
     * @param string $token
     * @return $this
     */
    public function setToken(string $token)
    {
        $this->params[static::PARAM_TOKEN] = $token;
        
        return $this;
    }

    /**
     * Set operate_as
     * @param string $operateAs
     * @return $this
     */
    public function setOperateAs(string $operateAs)
    {
        $this->params[static::PARAM_OPERATE_AS] = $operateAs;

        return $this;
    }

    /**
     * Set fl
     * @param int $fl
     * @return $this
     */
    public function setfl(int $fl)
    {
        $this->params[static::PARAM_FL] = $fl;
        
        return $this;
    }

    /**
     * Set svc
     * @param string $svc
     * @return $this
     */
    public function setSvc(string $svc)
    {
        $this->svc = $svc;
        
        return $this;
    }

    /**
     * Login by token
     * @return array
     * @throws \valentinbv\WialonOAuth\Exception\TokenLoginException
     */
    public function login(): array
    {
        try {
            $response = $this->httpClient->request('POST', $this->host, [
                'form_params' => [
                    'svc'=> $this->svc,
                    'params' => json_encode($this->params)]
            ]);
        } catch (TransferException $e) {
            throw new TokenLoginException($e);
        }
        $result = $response->getBody()->getContents();

        return $result ? \json_decode($result, true) : [];
    }
}