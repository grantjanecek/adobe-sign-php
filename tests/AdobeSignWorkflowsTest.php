<?php

declare(strict_types=1);

namespace Mettle\AdobeSign\Tests;

use GuzzleHttp\Psr7\Response;

class AdobeSignWorkflowsTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->provider->shouldReceive('getAuthenticatedRequest')->andReturn($this->request);
        $this->provider->shouldReceive('getResponse')->andReturn(new Response(200, [], json_encode(['mock_response' => 'mock_response'])));
    }

    public function testCreateWordflowAgreement()
    {
        $res = $this->adobeSign->createWorkflowAgreement('mock_workflow_id', []);

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetWorkflows()
    {
        $res = $this->adobeSign->getWorkflows();

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetWorkflow()
    {
        $res = $this->adobeSign->getWorkflow('mock_workflow_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }
}