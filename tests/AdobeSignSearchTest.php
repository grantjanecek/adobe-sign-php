<?php

declare(strict_types=1);

namespace Mettle\AdobeSign\Tests;

class AdobeSignSearchTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->provider->shouldReceive('getAuthenticatedRequest')->andReturn($this->request);
        $this->provider->shouldReceive('getResponse')->andReturn(['mock_response' => 'mock_response']);
    }

    public function testCreateSearchForAgreementAssetEvents()
    {
        $res = $this->adobeSign->createSearchForAgreementAssetEvents([]);

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetSearchForAgreementAssetEvents()
    {
        $res = $this->adobeSign->getSearchForAgreementAssetEvents('mock_search_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }
}