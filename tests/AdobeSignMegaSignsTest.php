<?php

declare(strict_types=1);

namespace Mettle\AdobeSign\Tests;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;

class AdobeSignMegaSignsTest extends BaseTestCase
{
    public function testSendMegaSignAgreement()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'megaSignId' => 'mock_mega_sign_id'
            ]))
        );

        $res = $this->adobeSign->sendMegaSignAgreement([]);

        $this->assertEquals(['megaSignId' => 'mock_mega_sign_id'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('/api/rest/v5/megaSigns', $request->getUri()->getPath());
    }

    public function testGetMegaSigns()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([]))
        );

        $res = $this->adobeSign->getMegaSigns();

        $this->assertEquals([], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/megaSigns', $request->getUri()->getPath());
    }

    public function testGetMegaSign()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'megaSignId' => 'mock_mega_sign_id'
            ]))
        );

        $res = $this->adobeSign->getMegaSign('mock_mega_sign_id');

        $this->assertEquals(['megaSignId' => 'mock_mega_sign_id'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/megaSigns/mock_mega_sign_id', $request->getUri()->getPath());
    }

    public function testGetMegaSignAgreements()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([]))
        );

        $res = $this->adobeSign->getMegaSignAgreements('mock_mega_sign_id');

        $this->assertEquals([], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/megaSigns/mock_mega_sign_id/agreements', $request->getUri()->getPath());
    }

    public function testGetMegaSignFormData()
    {
        $csv = <<<EOD
header_1,header_2
row_1_field_1,row_1_field_2
row_2_field_1,row_2_field_2
EOD;

        $this->mockResponse(
            new Response(200, ['content-type' => 'text/csv'], $csv)
        );

        $res = $this->adobeSign->getMegaSignFormData('mock_mega_sign_id');

        $this->assertEquals($csv, $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/megaSigns/mock_mega_sign_id/formData', $request->getUri()->getPath());
    }

    public function testUpdateMegaSignStatus()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'result' => 'mock_result'
            ]))
        );

        $res = $this->adobeSign->updateMegaSignStatus('mock_mega_sign_id', []);

        $this->assertEquals(['result' => 'mock_result'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('PUT', $request->getMethod());
        $this->assertEquals('/api/rest/v5/megaSigns/mock_mega_sign_id/status', $request->getUri()->getPath());
    }
}