<?php

namespace App\Tests\Entity;

use App\Entity\Task;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        $this->user = new User();
    }

    public function testGetId(): void
    {
        $this->assertNull($this->user->getId());
    }

    public function testEmail(): void
    {
        $email = 'test@example.com';
        $this->user->setEmail($email);
        $this->assertEquals($email, $this->user->getEmail());
    }

    public function testUsername(): void
    {
        $username = 'testUser';
        $this->user->setUsername($username);
        $this->assertEquals($username, $this->user->getUsername());
    }

    public function testRoles(): void
    {
        $roles = ['ROLE_ADMIN'];
        $this->user->setRoles($roles);
        $this->assertContains('ROLE_USER', $this->user->getRoles());
        $this->assertContains('ROLE_ADMIN', $this->user->getRoles());
    }

    public function testPassword(): void
    {
        $password = 'password';
        $this->user->setPassword($password);
        $this->assertEquals($password, $this->user->getPassword());
    }

    public function testTasks(): void
    {
        $task = new Task();
        $this->user->addTask($task);
        $this->assertCount(1, $this->user->getTasks());

        $this->user->removeTask($task);
        $this->assertCount(0, $this->user->getTasks());
    }
}
