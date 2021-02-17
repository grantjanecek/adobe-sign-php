<?php

declare(strict_types=1);

namespace Mettle\AdobeSign\Tests;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use Mettle\AdobeSign\AdobeSign;
use Prophecy\Argument\Token\TokenInterface;
use Psr\Http\Message\RequestInterface;
use UnexpectedValueException;

class AdobeSignTest extends BaseTestCase
{
    public function testGetProviderNotNull()
    {
        $this->assertNotNull($this->adobeSign->getProvider());
    }

    public function testSetBaseUri()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'api_access_point' => 'mock_access_point',
                'web_access_point' => 'mock_web_access_point'
            ]))
        );

        $this->adobeSign->setAccessToken('mock_access_token')->setBaseUri('mock_uri');

        $this->adobeSign->getBaseUris();

        $this->assertCount(1, $this->history);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('mock_uri/v5/base_uris', $request->getUri()->getPath());
        $this->assertEquals('Bearer mock_access_token', $request->getHeaderLine('Authorization'));
    }

    public function testSetVersion()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'api_access_point' => 'mock_access_point',
                'web_access_point' => 'mock_web_access_point'
            ]))
        );

        $this->adobeSign->setAccessToken('mock_access_token')->setVersion('mock_version');

        $this->adobeSign->getBaseUris();

        $this->assertCount(1, $this->history);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/mock_version/base_uris', $request->getUri()->getPath());
        $this->assertEquals('Bearer mock_access_token', $request->getHeaderLine('Authorization'));
    }

    public function testAdobeSignInvalidAccessTokenException()
    {
        $this->expectException(ClientException::class);

        $this->mockResponse(
            new Response(401, ['content-type' => 'application/json'], json_encode([
                'code' => 'INVALID_ACCESS_TOKEN',
                'message' => 'Access token provided is invalid or has expired'
            ]))
        );

        $this->adobeSign->getBaseUris();
    }

    public function testAdobeSignNoAccessTokenHeaderException()
    {
        $this->expectException(ClientException::class);

        $this->mockResponse(
            new Response(401, ['content-type' => 'application/json'], json_encode([
                'code' => 'NO_ACCESS_TOKEN_HEADER',
                'message' => 'Access token header not provided'
            ]))
        );

        $this->adobeSign->getBaseUris();
    }

    public function testUnexpectedValueException()
    {
        $this->expectException(UnexpectedValueException::class);

        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], '{"code": "MALFORMED_JSON", "message":')
        );

        $this->adobeSign->getBaseUris();
    }

    public function testGetBaseUris()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'api_access_point' => 'mock_access_point',
                'web_access_point' => 'mock_web_access_point'
            ]))
        );

        $response = $this->adobeSign->getBaseUris();

        $this->assertEquals([
            'api_access_point' => 'mock_access_point',
            'web_access_point' => 'mock_web_access_point'
        ], $response);
    }

    public function testRefreshAccessToken()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'access_token' => 'mock_access_token',
            ]))
        );

        /** @var TokenInterface $token */
        $token = $this->adobeSign->refreshAccessToken('mock_refresh_token');

        $this->assertEquals('mock_access_token', $token->getToken());
    }

    public function testSetAccessToken()
    {
        $self = $this->adobeSign->setAccessToken('mock_access_token');

        $this->assertInstanceOf(AdobeSign::class, $self);
    }
}