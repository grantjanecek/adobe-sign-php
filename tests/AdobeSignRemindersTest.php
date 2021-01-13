<?php

declare(strict_types=1);

namespace Mettle\AdobeSign\Tests;

use GuzzleHttp\Psr7\Response;

class AdobeSignRemindersTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->provider->shouldReceive('getAuthenticatedRequest')->andReturn($this->request);
        $this->provider->shouldReceive('getResponse')->andReturn(new Response(200, [], json_encode(['mock_response' => 'mock_response'])));
    }

    public function testSendReminder()
    {
        $res = $this->adobeSign->sendReminder([]);

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }
}