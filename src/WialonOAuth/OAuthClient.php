<?php

namespace valentinbv\WialonOAuth;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\TransferException;
use valentinbv\WialonOAuth\Exception\TokenLoginException;

class OAuthClient {

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
    private $authUrl = 'https://hst-api.wialon.com/wialon/ajax.html';
    /**
     * @var string
     */
    private $svc = 'token/login';
    /**
     * 
     * @var ClientInterface
     */
    private $httpClient;

    /**
     * OAuthClient constructor
     * @param string $authUrl
     * @param ClientInterface $httpClient
     */
    public function __construct(ClientInterface $httpClient, string $authUrl = '') {
        if ($authUrl) {
            $this->authUrl = $authUrl;
        }
        $this->httpClient = $httpClient;
    }

    /**
     * Get authUrl
     * @return string
     */
    public function getAuthUrl(): string
    {
        return $this->authUrl;
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
     * Decode query result body.
     * @param string $body
     * @return array
     */
    public function decodeBody(string $body): array
    {
        $decodeBody = json_decode($body, true);

        if ($decodeBody === null || !is_array($decodeBody)) {
            $decodeBody = [];
        }

        return $decodeBody;
    }

    /**
     * Login by token
     * @return array
     * @throws TokenLoginException
     */
    public function login(): array
    {
        try {
            $response = $this->httpClient->request('POST', $this->authUrl, [
                'form_params' => [
                    'svc'=> $this->svc,
                    'params' => json_encode($this->params)
                ]
            ]);
        } catch (TransferException $e) {
            throw new TokenLoginException($e);
        }
        $result = $this->decodeBody($response->getBody()->getContents());

        return $result;
    }
}