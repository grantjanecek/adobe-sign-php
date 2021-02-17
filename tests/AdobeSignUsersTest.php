<?php

declare(strict_types=1);

namespace Mettle\AdobeSign\Tests;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;

class AdobeSignUsersTest extends BaseTestCase
{
    public function testCreateUser()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'userId' => 'mock_user_id'
            ]))
        );

        $res = $this->adobeSign->createUser([]);

        $this->assertEquals(['userId' => 'mock_user_id'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('/api/rest/v5/users', $request->getUri()->getPath());
    }

    public function testGetUsers()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([]))
        );

        $res = $this->adobeSign->getUsers();

        $this->assertEquals([], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/users', $request->getUri()->getPath());
    }

    public function testGetUser()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'email' => 'mock_email'
            ]))
        );

        $res = $this->adobeSign->getUser('mock_user_id');

        $this->assertEquals(['email' => 'mock_email'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/rest/v5/users/mock_user_id', $request->getUri()->getPath());
    }

    public function testUpdateUser()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'email' => 'mock_email'
            ]))
        );

        $res = $this->adobeSign->updateUser('mock_user_id', []);

        $this->assertEquals(['email' => 'mock_email'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('PUT', $request->getMethod());
        $this->assertEquals('/api/rest/v5/users/mock_user_id', $request->getUri()->getPath());
    }

    public function testUpdateUserStatus()
    {
        $this->mockResponse(
            new Response(200, ['content-type' => 'application/json'], json_encode([
                'userStatus' => 'mock_user_status'
            ]))
        );

        $res = $this->adobeSign->updateUserStatus('mock_user_id', []);

        $this->assertEquals(['userStatus' => 'mock_user_status'], $res);

        /** @var RequestInterface $request */
        $request = $this->history[0]['request'];

        $this->assertEquals('PUT', $request->getMethod());
        $this->assertEquals('/api/rest/v5/users/mock_user_id/status', $request->getUri()->getPath());
    }
}