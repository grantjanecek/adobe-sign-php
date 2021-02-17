<?php

declare(strict_types=1);

namespace Mettle\AdobeSign\Tests;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;

class AdobeSignWorkflowsTest extends BaseTestCase
{
    public function testCreateWorkflowAgreement()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'agreementId' => 'mock_agreement_id'
            ]))
        );

        $res = $this->adobeSign->createWorkflowAgreement('mock_workflow_id', []);

        $this->assertEquals(['agreementId' => 'mock_agreement_id'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('/api/rest/v5/workflows/mock_workflow_id/agreements', $request->getUri()->getPath());
    }

    public function testGetWorkflows()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([]))
        );

        $res = $this->adobeSign->getWorkflows();

        $this->assertEquals([], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/workflows', $request->getUri()->getPath());
    }

    public function testGetWorkflow()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'name' => 'name_mock'
            ]))
        );

        $res = $this->adobeSign->getWorkflow('mock_workflow_id');

        $this->assertEquals(['name' => 'name_mock'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/workflows/mock_workflow_id', $request->getUri()->getPath());
    }
}