<?php

declare(strict_types=1);

namespace Mettle\AdobeSign\Tests;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;

class AdobeSignWidgetsTest extends BaseTestCase
{
    public function testCreateWidget()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'widgetId' => 'mock_widget_id'
            ]))
        );

        $res = $this->adobeSign->createWidget([]);

        $this->assertEquals(['widgetId' => 'mock_widget_id'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('/api/rest/v5/widgets', $request->getUri()->getPath());
    }

    public function testGetWidgets()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([]))
        );

        $res = $this->adobeSign->getWidgets();

        $this->assertEquals([], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/widgets', $request->getUri()->getPath());
    }

    public function testGetWidget()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'widgetId' => 'mock_widget_id'
            ]))
        );

        $res = $this->adobeSign->getWidget('mock_widget_id');

        $this->assertEquals(['widgetId' => 'mock_widget_id'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/widgets/mock_widget_id', $request->getUri()->getPath());
    }

    public function testGetWidgetAuditTrail()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/pdf'], "")
        );

        $res = $this->adobeSign->getWidgetAuditTrail('mock_widget_id');

        $this->assertEquals("", $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/widgets/mock_widget_id/auditTrail', $request->getUri()->getPath());
    }

    public function testGetWidgetCombinedDocument()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/pdf'], "")
        );

        $res = $this->adobeSign->getWidgetCombinedDocument('mock_widget_id');

        $this->assertEquals("", $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/widgets/mock_widget_id/combinedDocument', $request->getUri()->getPath());
    }

    public function testGetWidgetFormData()
    {
        $csv = <<<EOD
header_1,header_2
row_1_field_1,row_1_field_2
row_2_field_1,row_2_field_2
EOD;

        $this->mockResponse(
            new Response(200, ['content-type' => 'text/csv'], $csv)
        );

        $res = $this->adobeSign->getWidgetFormData('mock_widget_id');

        $this->assertEquals($csv, $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/widgets/mock_widget_id/formData', $request->getUri()->getPath());
    }

    public function testGetWidgetAgreements()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([]))
        );

        $res = $this->adobeSign->getWidgetAgreements('mock_widget_id');

        $this->assertEquals([], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/widgets/mock_widget_id/agreements', $request->getUri()->getPath());
    }

    public function testGetWidgetDocuments()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([]))
        );

        $res = $this->adobeSign->getWidgetDocuments('mock_widget_id');

        $this->assertEquals([], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/widgets/mock_widget_id/documents', $request->getUri()->getPath());
    }

    public function testGetWidgetDocument()
    {
        $this->mockResponse(
            new Response(200, [], "")
        );

        $res = $this->adobeSign->getWidgetDocument('mock_widget_id', 'mock_document_id');

        $this->assertEquals("", $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/widgets/mock_widget_id/documents/mock_document_id', $request->getUri()->getPath());
    }

    public function testPersonalizeWidget()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'widgetId' => 'mock_widget_id'
            ]))
        );

        $res = $this->adobeSign->personalizeWidget('mock_widget_id', []);

        $this->assertEquals(['widgetId' => 'mock_widget_id'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('PUT', $request->getMethod());
        $this->assertEquals('/api/rest/v5/widgets/mock_widget_id/personalize', $request->getUri()->getPath());
    }

    public function testUpdateWidgetStatus()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'code' => 'mock_code'
            ]))
        );

        $res = $this->adobeSign->updateWidgetStatus('mock_widget_id', []);

        $this->assertEquals(['code' => 'mock_code'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('PUT', $request->getMethod());
        $this->assertEquals('/api/rest/v5/widgets/mock_widget_id/status', $request->getUri()->getPath());
    }
}