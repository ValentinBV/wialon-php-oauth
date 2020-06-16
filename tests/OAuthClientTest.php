<?php
/*
 * This file is part of wialon-oauth.
 *
 * (c) Valentin Bondarenko <bvv1988@gmail.com>
 */
use PHPUnit\Framework\TestCase;
use valentinbv\WialonOAuth\OAuthClient;
use valentinbv\WialonOAuth\Exception\TokenLoginException;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Client;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

class OAuthClientTest extends TestCase
{
    private $source;
    private $testAuthUrl;
    private $testSvc;
    private $params = [];
    private $loginDataSuccess = '';

    protected function setUp(): void
    {
        $this->testAuthUrl = 'example.com';
        $this->testSvc = 'testOperation';
        $this->params = [
            'token' => 'testToken',
            'operate_as' => 'TestUser',
            'fl' => 4,
        ];
        $this->loginDataSuccess = json_encode(['result' => 'success']);

        //stubs
        $stubClient = $this->createMock(Client::class);
        $stubResultQueryBody = $this->createMock(MessageInterface::class);
        $stubResultQueryContents = $this->createMock(StreamInterface::class);

        $stubClient->method('request')
            ->willReturn($stubResultQueryBody);
        $stubResultQueryBody->method('getBody')
            ->willReturn($stubResultQueryContents);
        $stubResultQueryContents->method('getContents')
            ->willReturn($this->loginDataSuccess);
        
        $this->source = new OAuthClient($stubClient, $this->testAuthUrl);
        $this->source->setToken('testToken');
        $this->source->setOperateAs('TestUser');
        $this->source->setfl(4);
        $this->source->setSvc('testOperation');
    }

    public function testAuthUrl()
    {
        $this->assertEquals($this->source->getAuthUrl(), $this->testAuthUrl);
    }

    public function testParams()
    {
        $this->assertEquals($this->source->getParams(), $this->params);
    }

    public function testSvc()
    {
        $this->assertEquals($this->source->getSvc(), $this->testSvc);
    }

    public function testLoginSuccess()
    {
        $this->assertEquals($this->source->login(), \json_decode($this->loginDataSuccess, true));
    }

    public function testLoginException()
    {
        $stubClient = $this->createMock(Client::class);
        $stubClient->method('request')
            ->will($this->throwException(new TransferException));
        $this->source = new OAuthClient($stubClient, $this->testAuthUrl);

        try {
            $this->source->login();
        } catch (TokenLoginException $e) {
            $this->assertInstanceOf(TokenLoginException::class, $e);
        }
    }

    public function testDecodeBodySuccess()
    {
        $this->assertEquals($this->source->decodeBody($this->loginDataSuccess), \json_decode($this->loginDataSuccess, true));
    }

    public function testDecodeBodyError()
    {
        $this->assertEquals($this->source->decodeBody('error string'), []);
    }
}
