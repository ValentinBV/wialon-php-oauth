<?php

namespace valentinbv\WialonOAuth;

class OAuth {

    private const PARAM_CLIENT_ID = 'client_id';
    private const PARAM_ACCESS_TYPE = 'access_type';
    private const PARAM_ACTIVATION_TIME = 'activation_time';
    private const PARAM_DURATION = 'duration';
    private const PARAM_LANG = 'lang';
    private const PARAM_FLAGS = 'flags';
    private const PARAM_USER = 'user';
    private const PARAM_REDIRECT_URI = 'redirect_uri';
    private const PARAM_RESPONSE_TYPE = 'response_type';
    private const PARAM_CSS_URL = 'css_url';

    /**
     * @var array
     */
    private $params = [];
    /**
     * @var string
     */
    private $host = '';

    /**
     * OAuth constructor
     * @param string $host
     */
    public function __construct(string $host) {
        $this->host = $host;
    }

    /**
     * Get authorize url
     * @return string
     */
    public function getAuthorizeUrl(): string
    {
        return $this->host . '?' .  http_build_query($this->params);
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
     * Set client_id
     * @param string $clientId
     * @return $this
     */
    public function setClientId(string $clientId)
    {
        $this->params[static::PARAM_CLIENT_ID] = $clientId;
        
        return $this;
    }

    /**
     * Set access_type
     * @param string $accessType
     * @return $this
     */
    public function setAccessType(string $accessType)
    {
        $this->params[static::PARAM_ACCESS_TYPE] = $accessType;

        return $this;
    }

    /**
     * Set activation_time
     * @param int $activationTime
     * @return $this
     */
    public function setActivationTime(int $activationTime)
    {
        $this->params[static::PARAM_ACTIVATION_TIME] = $activationTime;
        
        return $this;
    }

    /**
     * Set duration
     * @param int $duration
     * @return $this
     */
    public function setDuration(int $duration)
    {
        $this->params[static::PARAM_DURATION] = $duration;
        
        return $this;
    }

    /**
     * Set lang
     * @param string $lang
     * @return $this
     */
    public function setLang(string $lang)
    {
        $this->params[static::PARAM_LANG] = $lang;
        
        return $this;
    }

    /**
     * Set flags
     * @param int $flags
     * @return $this
     */
    public function setFlags(int $flags)
    {
        $this->params[static::PARAM_FLAGS] = $flags;
        
        return $this;
    }

    /**
     * Set user
     * @param string $user
     * @return $this
     */
    public function setUser(string $user)
    {
        $this->params[static::PARAM_USER] = $user;
        
        return $this;
    }

    /**
     * Set redirect_uri
     * @param string $redirectUri
     * @return $this
     */
    public function setRedirectUri(string $redirectUri)
    {
        $this->params[static::PARAM_REDIRECT_URI] = $redirectUri;
        
        return $this;
    }

    /**
     * Set response_type
     * @param string $responseType
     * @return $this
     */
    public function setResponseType(string $responseType)
    {
        $this->params[static::PARAM_RESPONSE_TYPE] = $responseType;
        
        return $this;
    }

    /**
     * Set css_url
     * @param string $cssUrl
     * @return $this
     */
    public function setCssUrl(string $cssUrl)
    {
        $this->params[static::PARAM_CSS_URL] = $cssUrl;
        
        return $this;
    }
}