<?php

declare(strict_types=1);

namespace Mettle\AdobeSign\Tests;

use GuzzleHttp\Psr7\Response;

class AdobeSignWidgetsTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->provider->shouldReceive('getAuthenticatedRequest')->andReturn($this->request);
        $this->provider->shouldReceive('getResponse')->andReturn(new Response(200, [], json_encode(['mock_response' => 'mock_response'])));
    }

    public function testCreateWidget()
    {
        $res = $this->adobeSign->createWidget([]);

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetWidgets()
    {
        $res = $this->adobeSign->getWidgets();

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetWidget()
    {
        $res = $this->adobeSign->getWidget('mock_widget_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetWidgetAuditTrail()
    {
        $res = $this->adobeSign->getWidgetAuditTrail('mock_widget_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetWidgetCombinedDocument()
    {
        $res = $this->adobeSign->getWidgetCombinedDocument('mock_widget_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetWidgetFormData()
    {
        $res = $this->adobeSign->getWidgetFormData('mock_widget_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetWidgetAgreements()
    {
        $res = $this->adobeSign->getWidgetAgreements('mock_widget_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetWidgetDocuments()
    {
        $res = $this->adobeSign->getWidgetDocuments('mock_widget_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetWidgetDocument()
    {
        $res = $this->adobeSign->getWidgetDocument('mock_widget_id', 'mock_document_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testPersonalizeWidget()
    {
        $res = $this->adobeSign->personalizeWidget('mock_widget_id', []);

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testUpdateWidgetStatus()
    {
        $res = $this->adobeSign->updateWidgetStatus('mock_widget_id', []);

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }
}