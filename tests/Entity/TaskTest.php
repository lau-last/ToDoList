<?php

namespace App\Tests\Entity;

use App\Entity\Task;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    private Task $task;

    protected function setUp(): void
    {
        $this->task = new Task();
    }

    public function testGetId(): void
    {
        $this->assertNull($this->task->getId());
    }

    public function testCreatedAt(): void
    {
        $createdAt = new \DateTime();
        $this->task->setCreatedAt($createdAt);
        $this->assertEquals($createdAt, $this->task->getCreatedAt());
    }

    public function testTitle(): void
    {
        $title = 'Test Task';
        $this->task->setTitle($title);
        $this->assertEquals($title, $this->task->getTitle());
    }

    public function testContent(): void
    {
        $content = 'Task content';
        $this->task->setContent($content);
        $this->assertEquals($content, $this->task->getContent());
    }

    public function testIsDone(): void
    {
        $this->assertFalse($this->task->isDone());
        $this->task->toggle(true);
        $this->assertTrue($this->task->isDone());
    }

    public function testUser(): void
    {
        $user = new User();
        $this->task->setUser($user);
        $this->assertSame($user, $this->task->getUser());
    }
}
