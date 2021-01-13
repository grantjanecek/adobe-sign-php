<?php

declare(strict_types=1);

namespace Mettle\AdobeSign\Tests;

class AdobeSignLibraryDocumentsTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->provider->shouldReceive('getAuthenticatedRequest')->andReturn($this->request);
        $this->provider->shouldReceive('getResponse')->andReturn(['mock_response' => 'mock_response']);
    }

    public function testCreateLibraryDocument()
    {
        $res = $this->adobeSign->createLibraryDocument([]);

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetLibraryDocuments()
    {
        $res = $this->adobeSign->getLibraryDocuments();

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetLibraryDocument()
    {
        $res = $this->adobeSign->getLibraryDocument('mock_library_document_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetLibraryDocumentAuditTrail()
    {
        $res = $this->adobeSign->getLibraryDocumentAuditTrail('mock_library_document_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetLibraryDocumentCombinedDocument()
    {
        $res = $this->adobeSign->getLibraryDocumentCombinedDocument('mock_library_document_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetLibraryDocumentDocuments()
    {
        $res = $this->adobeSign->getLibraryDocumentDocuments('mock_library_document_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetLibraryDocumentDocument()
    {
        $res = $this->adobeSign->getLibraryDocumentDocument('mock_library_document_id', 'mock_document_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testDeleteLibraryDocument()
    {
        $res = $this->adobeSign->deleteLibraryDocument('mock_library_document_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }
}