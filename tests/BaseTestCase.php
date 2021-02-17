<?php

declare(strict_types=1);

namespace Mettle\AdobeSign\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Mettle\AdobeSign\AdobeSign;
use Mettle\OAuth2\Client\AdobeSign as OAuthAdobeSignProvider;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

abstract class BaseTestCase extends TestCase
{
    /**
     * @var AdobeSign
     */
    protected $adobeSign;

    /**
     * @var OAuthAdobeSignProvider
     */
    protected $provider;

    /**
     * @var array
     */
    protected $history = [];

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->provider = new OAuthAdobeSignProvider([
            'clientId'          => 'your_client_id',
            'clientSecret'      => 'your_client_secret',
            'redirectUri'       => 'your_callback',
            'scope'             => [
                'scope1:type',
                'scope2:type'
            ]
        ]);

        $this->adobeSign = new AdobeSign($this->provider);
    }

    protected function mockResponse(ResponseInterface $response)
    {
        $mock = new MockHandler([$response]);

        $history = Middleware::history($this->history);

        $handlerStack = HandlerStack::create($mock);
        $handlerStack->push($history);

        $this->provider->setHttpClient(
            new Client(['handler' => $handlerStack])
        );
    }

    protected function tearDown(): void
    {
        $this->history = [];
    }
}