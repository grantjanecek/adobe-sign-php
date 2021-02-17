<?php

declare(strict_types=1);

namespace Mettle\AdobeSign\Tests;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;

class AdobeSignAgreementsTest extends BaseTestCase
{
    public function testCreateAgreement()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'agreementId' => 'mock_agreement_id'
            ]))
        );

        $res = $this->adobeSign->createAgreement([]);

        $this->assertEquals(['agreementId' => 'mock_agreement_id'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('/api/rest/v5/agreements', $request->getUri()->getPath());
    }

    public function testCreateAlternateParticipant()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'participantId ' => 'mock_participant_id'
            ]))
        );

        $res = $this->adobeSign->createAlternateParticipant('mock_agreement_id', 'mock_participant_set_id', 'mock_participant_id', []);

        $this->assertEquals(['participantId ' => 'mock_participant_id'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('/api/rest/v5/agreements/mock_agreement_id/participantSets/mock_participant_set_id/participants/mock_participant_id/alternateParticipants', $request->getUri()->getPath());
    }

    public function testGetAgreements()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([]))
        );

        $res = $this->adobeSign->getAgreements();

        $this->assertEquals([], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/agreements', $request->getUri()->getPath());
    }

    public function testGetAgreement()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'agreementId' => 'mock_agreement_id'
            ]))
        );

        $res = $this->adobeSign->getAgreement('mock_agreement_id');

        $this->assertEquals(['agreementId' => 'mock_agreement_id'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/agreements/mock_agreement_id', $request->getUri()->getPath());
    }

    public function testGetAgreementAuditTrail()
    {
        $this->mockResponse(
            new Response(200, [], "")
        );

        $res = $this->adobeSign->getAgreementAuditTrail('mock_agreement_id');

        $this->assertEquals("", $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/agreements/mock_agreement_id/auditTrail', $request->getUri()->getPath());
    }

    public function testGetAgreementSigningUrls()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([]))
        );

        $res = $this->adobeSign->getAgreementSigningUrls('mock_agreement_id');

        $this->assertEquals([], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/agreements/mock_agreement_id/signingUrls', $request->getUri()->getPath());
    }

    public function testGetAgreementFormData()
    {
        $csv = <<<EOD
header_1,header_2
row_1_field_1,row_1_field_2
row_2_field_1,row_2_field_2
EOD;

        $this->mockResponse(
            new Response(200, ['content-type' => 'text/csv'], $csv)
        );

        $res = $this->adobeSign->getAgreementFormData('mock_agreement_id');

        $this->assertEquals($csv, $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/agreements/mock_agreement_id/formData', $request->getUri()->getPath());
    }

    public function testGetAgreementCombinedDocument()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'text/csv'], "")
        );

        $res = $this->adobeSign->getAgreementCombinedDocument('mock_agreement_id');

        $this->assertEquals("", $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/agreements/mock_agreement_id/combinedDocument', $request->getUri()->getPath());
    }

    public function testGetAgreementCombinedDocumentUrls()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([]))
        );

        $res = $this->adobeSign->getAgreementCombinedDocumentUrls('mock_agreement_id');

        $this->assertEquals([], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/agreements/mock_agreement_id/combinedDocument/url', $request->getUri()->getPath());
    }

    public function testGetAgreementCombinedDocumentPagesInfo()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([]))
        );

        $res = $this->adobeSign->getAgreementCombinedDocumentPagesInfo('mock_agreement_id');

        $this->assertEquals([], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/agreements/mock_agreement_id/combinedDocument/pagesInfo', $request->getUri()->getPath());
    }

    public function testGetAgreementDocuments()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([]))
        );

        $res = $this->adobeSign->getAgreementDocuments('mock_agreement_id');

        $this->assertEquals([], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/agreements/mock_agreement_id/documents', $request->getUri()->getPath());
    }

    public function testGetAgreementDocumentsImageUrls()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([]))
        );

        $res = $this->adobeSign->getAgreementDocumentsImageUrls('mock_agreement_id');

        $this->assertEquals([], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/agreements/mock_agreement_id/documents/imageUrls', $request->getUri()->getPath());
    }

    public function testGetAgreementDocument()
    {
        $this->mockResponse(
            new Response(200, [], "")
        );

        $res = $this->adobeSign->getAgreementDocument('mock_agreement_id', 'mock_document_id');

        $this->assertEquals("", $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/agreements/mock_agreement_id/documents/mock_document_id', $request->getUri()->getPath());
    }

    public function testGetAgreementDocumentUrl()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'url' => 'mock_document_url'
            ]))
        );

        $res = $this->adobeSign->getAgreementDocumentUrl('mock_agreement_id', 'mock_document_id');

        $this->assertEquals([ 'url' => 'mock_document_url'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/agreements/mock_agreement_id/documents/mock_document_id/url', $request->getUri()->getPath());
    }

    public function testGetAgreementDocumentImageUrls()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([]))
        );

        $res = $this->adobeSign->getAgreementDocumentImageUrls('mock_agreement_id', 'mock_document_id');

        $this->assertEquals([], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/agreements/mock_agreement_id/documents/mock_document_id/imageUrls', $request->getUri()->getPath());
    }

    public function testUpdateAgreementStatus()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'result' => 'mock_result'
            ]))
        );

        $res = $this->adobeSign->updateAgreementStatus('mock_agreement_id', []);

        $this->assertEquals(['result' => 'mock_result'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('PUT', $request->getMethod());
        $this->assertEquals('/api/rest/v5/agreements/mock_agreement_id/status', $request->getUri()->getPath());
    }

    public function testDeleteAgreement()
    {
        $this->mockResponse(
            new Response(200, [], "")
        );

        $this->adobeSign->deleteAgreement('mock_agreement_id');

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('DELETE', $request->getMethod());
        $this->assertEquals('/api/rest/v5/agreements/mock_agreement_id', $request->getUri()->getPath());
    }

    public function testDeleteAgreementDocuments()
    {
        $this->mockResponse(
            new Response(200, [], "")
        );

        $this->adobeSign->deleteAgreementDocuments('mock_agreement_id');

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('DELETE', $request->getMethod());
        $this->assertEquals('/api/rest/v5/agreements/mock_agreement_id/documents', $request->getUri()->getPath());
    }
}