<?php

declare(strict_types=1);

namespace Mettle\AdobeSign\Tests;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;

class AdobeSignLibraryDocumentsTest extends BaseTestCase
{
    public function testCreateLibraryDocument()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'libraryDocumentId' => 'mock_library_document_id'
            ]))
        );

        $res = $this->adobeSign->createLibraryDocument([]);

        $this->assertEquals([ 'libraryDocumentId' => 'mock_library_document_id'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('/api/rest/v5/libraryDocuments', $request->getUri()->getPath());
    }

    public function testGetLibraryDocuments()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([]))
        );

        $res = $this->adobeSign->getLibraryDocuments();

        $this->assertEquals([], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/libraryDocuments', $request->getUri()->getPath());
    }

    public function testGetLibraryDocument()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'libraryDocumentId' => 'mock_library_document_id'
            ]))
        );

        $res = $this->adobeSign->getLibraryDocument('mock_library_document_id');

        $this->assertEquals([ 'libraryDocumentId' => 'mock_library_document_id'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/libraryDocuments/mock_library_document_id', $request->getUri()->getPath());
    }

    public function testGetLibraryDocumentAuditTrail()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/pdf'], "")
        );

        $res = $this->adobeSign->getLibraryDocumentAuditTrail('mock_library_document_id');

        $this->assertEquals("", $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/libraryDocuments/mock_library_document_id/auditTrail', $request->getUri()->getPath());
    }

    public function testGetLibraryDocumentCombinedDocument()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/pdf'], "")
        );

        $res = $this->adobeSign->getLibraryDocumentCombinedDocument('mock_library_document_id');

        $this->assertEquals("", $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/libraryDocuments/mock_library_document_id/combinedDocument', $request->getUri()->getPath());
    }

    public function testGetLibraryDocumentDocuments()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([]))
        );

        $res = $this->adobeSign->getLibraryDocumentDocuments('mock_library_document_id');

        $this->assertEquals([], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/libraryDocuments/mock_library_document_id/documents', $request->getUri()->getPath());
    }

    public function testGetLibraryDocumentDocument()
    {
        $this->mockResponse(
            new Response(200, [], "")
        );

        $res = $this->adobeSign->getLibraryDocumentDocument('mock_library_document_id', 'mock_document_id');

        $this->assertEquals("", $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/libraryDocuments/mock_library_document_id/documents/mock_document_id', $request->getUri()->getPath());
    }

    public function testDeleteLibraryDocument()
    {
        $this->mockResponse(
            new Response(200, [], "")
        );

        $this->adobeSign->deleteLibraryDocument('mock_library_document_id');

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('DELETE', $request->getMethod());
        $this->assertEquals('/api/rest/v5/libraryDocuments/mock_library_document_id', $request->getUri()->getPath());
    }
}