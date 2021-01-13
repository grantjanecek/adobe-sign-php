<?php

declare(strict_types=1);

namespace Mettle\AdobeSign\Tests;

use Mettle\AdobeSign\AdobeSign;
use Mettle\AdobeSign\Exceptions\AdobeSignException;
use Mettle\AdobeSign\Exceptions\AdobeSignInvalidAccessTokenException;
use Mettle\AdobeSign\Exceptions\AdobeSignMissingRequiredParamException;
use Mettle\AdobeSign\Exceptions\AdobeSignUnsupportedMediaTypeException;

class AdobeSignTest extends BaseTestCase
{
    public function testGetProviderNotNull()
    {
        $this->assertNotNull($this->adobeSign->getProvider());
    }

    public function testSetBaseUri()
    {
        $this->adobeSign->setAccessToken('mock_access_token')->setBaseUri('mock_uri');
        $this->provider->shouldReceive('getAuthenticatedRequest')->with(
            'GET',
            "mock_uri/v5/base_uris",
            'mock_access_token'
        )->andReturn($this->request);
        $this->provider->shouldReceive('getResponse')->with($this->request);

        $this->adobeSign->getBaseUris();
    }

    public function testSetVersion()
    {
        $this->adobeSign->setAccessToken('mock_access_token')->setVersion('mock_version');
        $this->provider->shouldReceive('getAuthenticatedRequest')->with(
            'GET',
            "https://api.na1.echosign.com/api/rest/mock_version/base_uris",
            'mock_access_token'
        )->andReturn($this->request);
        $this->provider->shouldReceive('getResponse')->with($this->request);

        $this->adobeSign->getBaseUris();
    }

    public function testGetAuthorizationUrl()
    {
        $this->provider->shouldReceive('getAuthorizationUrl')->andReturn('mock_authorization_url');
        $url = $this->adobeSign->getAuthorizationUrl();

        $this->assertEquals('mock_authorization_url', $url);
    }

    public function testGetAccessToken()
    {
        $this->provider->shouldReceive('getAccessToken')->andReturn('mock_access_token');
        $accessToken = $this->adobeSign->getAccessToken('mock_code');

        $this->assertEquals('mock_access_token', $accessToken);
    }

    public function testAdobeSignInvalidAccessTokenException()
    {
        $this->expectException(AdobeSignInvalidAccessTokenException::class);

        $this->provider->shouldReceive('getAuthenticatedRequest')->andReturn($this->request);
        $this->provider->shouldReceive('getResponse')->andReturn([
            'code'    => 'INVALID_ACCESS_TOKEN',
            'message' => 'mock_message'
        ]);
        $this->adobeSign->getBaseUris();
    }

    public function testAdobeSignUnsupportedMediaTypeException()
    {
        $this->expectException(AdobeSignUnsupportedMediaTypeException::class);

        $this->provider->shouldReceive('getAuthenticatedRequest')->andReturn($this->request);
        $this->provider->shouldReceive('getResponse')->andReturn([
            'code'    => 'UNSUPPORTED_MEDIA_TYPE',
            'message' => 'mock_message'
        ]);
        $this->adobeSign->getBaseUris();
    }

    public function testAdobeSignMissingRequiredParamException()
    {
        $this->expectException(AdobeSignMissingRequiredParamException::class);

        $this->provider->shouldReceive('getAuthenticatedRequest')->andReturn($this->request);
        $this->provider->shouldReceive('getResponse')->andReturn([
            'code'    => 'MISSING_REQUIRED_PARAM',
            'message' => 'mock_message'
        ]);
        $this->adobeSign->getBaseUris();
    }

    public function testAdobeSignException()
    {
        $this->expectException(AdobeSignException::class);

        $this->provider->shouldReceive('getAuthenticatedRequest')->andReturn($this->request);
        $this->provider->shouldReceive('getResponse')->andReturn([
            'code'    => 'mock_code',
            'message' => 'mock_message'
        ]);
        $this->adobeSign->getBaseUris();
    }

    public function testGetBaseUris()
    {
        $this->provider->shouldReceive('getAuthenticatedRequest')->andReturn($this->request);
        $this->provider->shouldReceive('getResponse')->andReturn(['base_uri' => 'response']);

        $res = $this->adobeSign->getBaseUris();
        $this->assertEquals(['base_uri' => 'response'], $res);
    }

    public function testRefreshAccessToken()
    {
        $accessToken = [
            'access_token' => 'mock_access_token'
        ];

        $this->provider->shouldReceive('getAccessToken')->andReturn($accessToken);
        $token = $this->adobeSign->refreshAccessToken('mock_refresh_token');

        $this->assertEquals($accessToken, $token);
    }

    public function testSetAccessToken()
    {
        $self = $this->adobeSign->setAccessToken('mock_access_token');

        $this->assertInstanceOf(AdobeSign::class, $self);
    }
}