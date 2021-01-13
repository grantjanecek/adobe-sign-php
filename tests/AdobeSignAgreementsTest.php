<?php

declare(strict_types=1);

namespace Mettle\AdobeSign\Tests;

class AdobeSignAgreementsTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->provider->shouldReceive('getAuthenticatedRequest')->andReturn($this->request);
        $this->provider->shouldReceive('getResponse')->andReturn(['mock_response' => 'mock_response']);
    }

    public function testCreateAgreement()
    {
        $res = $this->adobeSign->createAgreement([]);

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testCreateAlternateParticipant()
    {
        $res = $this->adobeSign->createAlternateParticipant('mock_agreement_id', 'mock_participant_set_id',
            'mock_participant_id', []);

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetAgreements()
    {
        $res = $this->adobeSign->getAgreements();

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetAgreement()
    {
        $res = $this->adobeSign->getAgreement('mock_agreement_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetAgreementAuditTrail()
    {
        $res = $this->adobeSign->getAgreementAuditTrail('mock_agreement_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetAgreementSigningUrls()
    {
        $res = $this->adobeSign->getAgreementSigningUrls('mock_agreement_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetAgreementFormData()
    {
        $res = $this->adobeSign->getAgreementFormData('mock_agreement_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetAgreementCombinedDocument()
    {
        $res = $this->adobeSign->getAgreementCombinedDocument('mock_agreement_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetAgreementCombinedDocumentUrls()
    {
        $res = $this->adobeSign->getAgreementCombinedDocumentUrls('mock_agreement_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetAgreementCombinedDocumentPagesInfo()
    {
        $res = $this->adobeSign->getAgreementCombinedDocumentPagesInfo('mock_agreement_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetAgreementDocuments()
    {
        $res = $this->adobeSign->getAgreementDocuments('mock_agreement_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetAgreementDocumentsImageUrls()
    {
        $res = $this->adobeSign->getAgreementDocumentsImageUrls('mock_agreement_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetAgreementDocument()
    {
        $res = $this->adobeSign->getAgreementDocument('mock_agreement_id', 'mock_document_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetAgreementDocumentUrl()
    {
        $res = $this->adobeSign->getAgreementDocumentUrl('mock_agreement_id', 'mock_document_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetAgreementDocumentImageUrls()
    {
        $res = $this->adobeSign->getAgreementDocumentImageUrls('mock_agreement_id', 'mock_document_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testUpdateAgreementStatus()
    {
        $res = $this->adobeSign->updateAgreementStatus('mock_agreement_id', []);

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testDeleteAgreement()
    {
        $res = $this->adobeSign->deleteAgreement('mock_agreement_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testDeleteAgreementDocuments()
    {
        $res = $this->adobeSign->deleteAgreementDocuments('mock_agreement_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }
}