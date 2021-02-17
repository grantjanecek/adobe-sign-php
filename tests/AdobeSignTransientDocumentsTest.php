<?php

declare(strict_types=1);

namespace Mettle\AdobeSign\Tests;

use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;

class AdobeSignTransientDocumentsTest extends BaseTestCase
{
    public function testUploadTransientDocument()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'transientDocumentId' => 'mock_transient_document_id'
            ]))
        );

        $mutipartStream = new MultipartStream([
            [
                'name' => 'file',
                'contents' => 'foobar',
            ]
        ]);

        $res = $this->adobeSign->uploadTransientDocument($mutipartStream);

        $this->assertEquals(['transientDocumentId' => 'mock_transient_document_id'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('/api/rest/v5/transientDocuments', $request->getUri()->getPath());
        $this->assertStringContainsString('multipart/form-data', $request->getHeaderLine('Content-Type'));
    }
}