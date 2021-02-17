<?php

declare(strict_types=1);

namespace Mettle\AdobeSign\Tests;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;

class AdobeSignSearchTest extends BaseTestCase
{
    public function testCreateSearchForAgreementAssetEvents()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'searchId' => 'mock_search_id'
            ]))
        );

        $res = $this->adobeSign->createSearchForAgreementAssetEvents([]);

        $this->assertEquals(['searchId' => 'mock_search_id'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('/api/rest/v5/search/agreementAssetEvents', $request->getUri()->getPath());
    }

    public function testGetSearchForAgreementAssetEvents()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([]))
        );

        $res = $this->adobeSign->getSearchForAgreementAssetEvents('mock_search_id');

        $this->assertEquals([], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/search/agreementAssetEvents/mock_search_id', $request->getUri()->getPath());
    }
}