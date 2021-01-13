<?php

declare(strict_types=1);

namespace Mettle\AdobeSign\Tests;

class AdobeSignGroupsTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->provider->shouldReceive('getAuthenticatedRequest')->andReturn($this->request);
        $this->provider->shouldReceive('getResponse')->andReturn(['mock_response' => 'mock_response']);
    }

    public function testCreateGroup()
    {
        $res = $this->adobeSign->createGroup([]);

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetGroups()
    {
        $res = $this->adobeSign->getGroups();

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetGroup()
    {
        $res = $this->adobeSign->getGroup('mock_group_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testGetGroupUsers()
    {
        $res = $this->adobeSign->getGroupUsers('mock_group_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testUpdateGroup()
    {
        $res = $this->adobeSign->updateGroup('mock_group_id', []);

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }

    public function testDeleteGroup()
    {
        $res = $this->adobeSign->deleteGroup('mock_group_id');

        $this->assertEquals(['mock_response' => 'mock_response'], $res);
    }
}