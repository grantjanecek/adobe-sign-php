<?php

declare(strict_types=1);

namespace Mettle\AdobeSign\Tests;

use GuzzleHttp\Psr7\Response;

class AdobeSignUsersTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->provider->shouldReceive('getAuthenticatedRequest')->andReturn($this->request);
        $this->provider->shouldReceive('getResponse')->andReturn(new Response(200, [], json_encode(['mock_response' => 'mock_response'])));
    }

    public function testCreateUser()
    {
        $res = $this->adobeSign->createUser([]);

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetUsers()
    {
        $res = $this->adobeSign->getUsers();

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetUser()
    {
        $res = $this->adobeSign->getUser('mock_user_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testUpdateUser()
    {
        $res = $this->adobeSign->updateUser('mock_user_id', []);

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testUpdateUserStatus()
    {
        $res = $this->adobeSign->updateUserStatus('mock_user_id', []);

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }
}