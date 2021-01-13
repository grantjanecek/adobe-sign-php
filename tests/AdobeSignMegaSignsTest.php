<?php

declare(strict_types=1);

namespace Mettle\AdobeSign\Tests;

use GuzzleHttp\Psr7\Response;

class AdobeSignMegaSignsTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->provider->shouldReceive('getAuthenticatedRequest')->andReturn($this->request);
        $this->provider->shouldReceive('getResponse')->andReturn(new Response(200, [], json_encode(['mock_response' => 'mock_response'])));
    }

    public function testSendMegaSignAgreement()
    {
        $res = $this->adobeSign->sendMegaSignAgreement([]);

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetMegaSigns()
    {
        $res = $this->adobeSign->getMegaSigns();

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetMegaSign()
    {
        $res = $this->adobeSign->getMegaSign('mock_mega_sign_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetMegaSignAgreements()
    {
        $res = $this->adobeSign->getMegaSignAgreements('mock_mega_sign_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetMegaSignFormData()
    {
        $res = $this->adobeSign->getMegaSignFormData('mock_mega_sign_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testUpdateMegaSignStatus()
    {
        $res = $this->adobeSign->updateMegaSignStatus('mock_mega_sign_id', []);

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }
}