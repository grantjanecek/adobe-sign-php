<?php

declare(strict_types=1);

namespace Mettle\AdobeSign\Tests;

use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Response;
use Mockery as m;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamFile;
use Psr\Http\Message\RequestInterface;

class AdobeSignTransientDocumentsTest extends BaseTestCase
{
    public function testUploadTransientDocument()
    {
        $mutipartStream = m::mock(MultipartStream::class);
        $request = m::mock(RequestInterface::class);

        $mockFs = vfsStream::setup();
        $mockFile = new vfsStreamFile('filename.png');
        $mockFs->addChild($mockFile);

        $this->provider->shouldReceive('getAuthenticatedRequest')->andReturn($request);
        $this->provider->shouldReceive('getResponse')->andReturn(new Response(200, [], json_encode(['id' => 'mock_id'])));

        $res = $this->adobeSign->uploadTransientDocument($mutipartStream);

        $this->assertEquals(['id' => 'mock_id'], $res);
    }
}