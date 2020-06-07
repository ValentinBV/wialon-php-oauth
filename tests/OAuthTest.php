<?php
/*
 * This file is part of wialon-oauth.
 *
 * (c) Valentin Bondarenko <bvv1988@gmail.com>
 */
use PHPUnit\Framework\TestCase;
use valentinbv\WialonOAuth\OAuth;

class OAuthTest extends TestCase
{

    private $source;
    private $testHost;
    private $testAuthorizeUrl;
    private $params = [];

    protected function setUp(): void
    {
        $this->testHost = 'example.com';
        $this->params = [
            'client_id' => 'testClient',
            'access_type' => 256,
            'activation_time' => 0,
            'duration' => 2592000,
            'lang' => 'ru',
            'flags' => 0,
            'user' => 'testUser',
            'redirect_uri' => 'example.com/redirect',
            'response_type' => 'token',
            'css_url' => 'example.com/css',
        ];
        $this->testAuthorizeUrl = $this->testHost . '?' .  http_build_query($this->params);

        $this->source = new OAuth($this->testHost);
        $this->source->setClientId('testClient');
        $this->source->setAccessType(256);
        $this->source->setActivationTime(0);
        $this->source->setDuration(2592000);
        $this->source->setLang('ru');
        $this->source->setFlags(0);
        $this->source->setUser('testUser');
        $this->source->setRedirectUri('example.com/redirect');
        $this->source->setResponseType('token');
        $this->source->setCssUrl('example.com/css');
    }

    public function testHost()
    {
        $this->assertEquals($this->source->getHost(), $this->testHost);
    }

    public function testParams()
    {
        $this->assertEquals($this->source->getParams(), $this->params);
    }

    public function testAuthorizeUrl()
    {
        $this->assertEquals($this->source->getAuthorizeUrl(), $this->testAuthorizeUrl);
    }
}
