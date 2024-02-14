<?php

namespace App\Tests\DataFixtures;

use App\DataFixtures\AppFixtures;
use App\Entity\Task;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\NotSupported;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppFixturesTest extends WebTestCase
{
    private ?EntityManager $entityManager;

    protected function setUp(): void
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $this->entityManager = $container->get(EntityManagerInterface::class);
    }

    public static function setUpBeforeClass(): void
    {
        exec('php bin/console d:d:d --env=test --force');
        exec('php bin/console d:d:c --env=test');
        exec('php bin/console d:s:u --env=test --force --complete');
    }

    /**
     * @throws NotSupported
     */
    public function testUserFixtures()
    {
        (new AppFixtures())->load($this->entityManager);
        $users = $this->entityManager->getRepository(User::class)->findAll();
        $this->assertCount(3, $users);
        foreach ($users as $user) {
            $this->assertContains($user->getEmail(),
                [
                'laurent@example.com',
                'aurelie@example.com',
                'sandrine@example.com',
            ]);
        }
    }

    /**
     * @throws NotSupported
     */
    public function testTaskFixtures()
    {
        $tasks = $this->entityManager->getRepository(Task::class)->findAll();
        $this->assertCount(30, $tasks);

        foreach ($tasks as $task) {
            $this->assertStringStartsWith('Titre-', $task->getTitle());
            $this->assertStringStartsWith('Content-', $task->getContent());
        }
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }
}
