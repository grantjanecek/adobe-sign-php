<?php

declare(strict_types=1);

namespace Mettle\AdobeSign\Tests;

use Mettle\OAuth2\Client\AdobeSign as OAuthAdobeSignProvider;
use Mettle\AdobeSign\AdobeSign;
use Mockery as m;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

abstract class BaseTestCase extends TestCase
{
    /**
     * @var AdobeSign
     */
    protected $adobeSign;

    /**
     * @var m\MockInterface
     */
    protected $provider;

    /**
     * @var m\MockInterface
     */
    protected $request;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->request = m::mock(RequestInterface::class);
        $this->provider = m::mock(OAuthAdobeSignProvider::class);
        $this->adobeSign = new AdobeSign($this->provider);
    }
}