<?php

declare(strict_types=1);

namespace Mettle\AdobeSign\Tests;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;

class AdobeSignGroupsTest extends BaseTestCase
{
    public function testCreateGroup()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'groupId' => 'mock_group_id'
            ]))
        );

        $res = $this->adobeSign->createGroup([]);

        $this->assertEquals([ 'groupId' => 'mock_group_id'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('/api/rest/v5/groups', $request->getUri()->getPath());
    }

    public function testGetGroups()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([]))
        );

        $res = $this->adobeSign->getGroups();

        $this->assertEquals([], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/groups', $request->getUri()->getPath());
    }

    public function testGetGroup()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'groupId' => 'mock_group_id',
                'groupName' => 'mock_group_name'
            ]))
        );

        $res = $this->adobeSign->getGroup('mock_group_id');

        $this->assertEquals([
            'groupId' => 'mock_group_id',
            'groupName' => 'mock_group_name'
        ], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/groups/mock_group_id', $request->getUri()->getPath());
    }

    public function testGetGroupUsers()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([]))
        );

        $res = $this->adobeSign->getGroupUsers('mock_group_id');

        $this->assertEquals([], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/groups/mock_group_id/users', $request->getUri()->getPath());
    }

    public function testUpdateGroup()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'groupName' => 'mock_group_name'
            ]))
        );

        $res = $this->adobeSign->updateGroup('mock_group_id', []);

        $this->assertEquals(['groupName' => 'mock_group_name'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('PUT', $request->getMethod());
        $this->assertEquals('/api/rest/v5/groups/mock_group_id', $request->getUri()->getPath());
    }

    public function testDeleteGroup()
    {
        $this->mockResponse(
            new Response(200, [], "")
        );

        $this->adobeSign->deleteGroup('mock_group_id');

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('DELETE', $request->getMethod());
        $this->assertEquals('/api/rest/v5/groups/mock_group_id', $request->getUri()->getPath());
    }
}