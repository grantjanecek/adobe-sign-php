<?php

declare(strict_types=1);

namespace Mettle\AdobeSign\Tests;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;

class AdobeSignViewsTest extends BaseTestCase
{
    public function testGetAgreementAssetsViewUrl()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'viewURL' => 'mock_view_url'
            ]))
        );

        $res = $this->adobeSign->getAgreementAssetsViewUrl([]);

        $this->assertEquals(['viewURL' => 'mock_view_url'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('/api/rest/v5/views/agreementAssets', $request->getUri()->getPath());
    }

    public function testGetAgreementAssetListViewUrl()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'viewURL' => 'mock_view_url'
            ]))
        );

        $res = $this->adobeSign->getAgreementAssetListViewUrl([]);

        $this->assertEquals(['viewURL' => 'mock_view_url'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('/api/rest/v5/views/agreementAssetList', $request->getUri()->getPath());
    }

    public function testGetSettingsViewUrl()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'viewURL' => 'mock_view_url'
            ]))
        );

        $res = $this->adobeSign->getSettingsViewUrl([]);

        $this->assertEquals(['viewURL' => 'mock_view_url'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('/api/rest/v5/views/settings', $request->getUri()->getPath());
    }
}