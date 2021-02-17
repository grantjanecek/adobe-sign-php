<?php

declare(strict_types=1);

namespace Mettle\AdobeSign\Tests;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;

class AdobeSignRemindersTest extends BaseTestCase
{
    public function testSendReminder()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'result' => 'mock_result'
            ]))
        );

        $res = $this->adobeSign->sendReminder([]);

        $this->assertEquals(['result' => 'mock_result'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('/api/rest/v5/reminders', $request->getUri()->getPath());
    }
}