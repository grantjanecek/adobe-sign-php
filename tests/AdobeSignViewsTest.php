<?php

declare(strict_types=1);

namespace Mettle\AdobeSign\Tests;

class AdobeSignViewsTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->provider->shouldReceive('getAuthenticatedRequest')->andReturn($this->request);
        $this->provider->shouldReceive('getResponse')->andReturn(['mock_response' => 'mock_response']);
    }

    public function testGetAgreementAssetsViewUrl()
    {
        $res = $this->adobeSign->getAgreementAssetsViewUrl([]);

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetAgreementAssetListViewUrl()
    {
        $res = $this->adobeSign->getAgreementAssetListViewUrl([]);

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetSettingsViewUrl()
    {
        $res = $this->adobeSign->getSettingsViewUrl([]);

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }
}