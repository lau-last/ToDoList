<?php

namespace App\Tests\Controller;

use App\Entity\Task;
use App\Entity\User;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{

    private KernelBrowser $client;


    protected function setUp(): void
    {
        $this->client = static::createClient();
    }


    public static function setUpBeforeClass(): void
    {
//        exec('php bin/console d:d:c --env=test');
//        exec('php bin/console d:s:u --env=test --force --complete');
        exec('php bin/console d:f:l --env=test --no-interaction --quiet');
    }


    public function testListAction()
    {
        $this->client->request('GET', '/tasks/all');
        $this->assertResponseRedirects('/login');

        $laurentAdminUser = $this->getUserName('Laurent');
        $this->client->loginUser($laurentAdminUser);
        $this->client->request('GET', '/tasks/all');
        $this->assertResponseIsSuccessful();
    }


    public function testToggleTaskAction()
    {
        $task = $this->getTask();
        $this->assertFalse($task->isDone());

        $task->toggle(true);
        $this->assertTrue($task->isDone());
    }


    public function testDeleteTaskAction()
    {
        $user = $this->getUserName('Sandrine');
        $this->client->loginUser($user);
        $this->client->request('GET', '/tasks/' . $this->getOneRealTask($user)->getId() . '/delete');
        $this->client->followRedirect();
        $this->assertSelectorTextContains('div.alert.alert-success', 'La tâche a bien été supprimée.');

    }

    public function testCreateTask()
    {
        $user = $this->getUserName('Laurent');
        $this->client->loginUser($user);
        $crawler = $this->client->request('GET', '/tasks/create');
        $this->assertResponseIsSuccessful();

        $form = $crawler->selectButton('Ajouter')->form();
        $form['task[title]'] = 'Test create title';
        $form['task[content]'] = 'Test create content';

        $this->client->submit($form);
        $this->assertResponseRedirects('/tasks/all');
        $this->client->followRedirect();
        $this->assertSelectorTextContains('div.alert.alert-success', "La tâche a été bien été ajoutée.");
    }


    public function testModifyTask()
    {
        $user = $this->getUserName('Laurent');
        $this->client->loginUser($user);
        $crawler = $this->client->request('GET', '/tasks/' . $this->getOneRealTask($user)->getId() . '/edit');
        $this->assertResponseIsSuccessful();

        $form = $crawler->selectButton('Modifier')->form();
        $form['task[title]'] = 'Test modify title';
        $form['task[content]'] = 'Test modify content';

        $this->client->submit($form);
        $this->assertResponseRedirects('/tasks/all');
        $this->client->followRedirect();
        $this->assertSelectorTextContains('div.alert.alert-success', "La tâche a bien été modifiée.");
    }


    private function getUserName(string $name): ?User
    {
        $entityManager = $this->client->getContainer()->get('doctrine.orm.entity_manager');
        /** @var UserRepository $userRepository */
        $userRepository = $entityManager->getRepository(User::class);
        return $userRepository->findOneBy(['username' => $name]);
    }


    private function getOneRealTask(User $user): ?Task
    {
        $entityManager = $this->client->getContainer()->get('doctrine.orm.entity_manager');
        /** @var TaskRepository $taskRepository */
        $taskRepository = $entityManager->getRepository(Task::class);
        return $taskRepository->findOneByUser($user->getId());
    }


    private function getTask(): Task
    {
        return (new Task())
            ->setTitle("Test")
            ->setContent("Test")
            ->setCreatedAt(new \DateTime())
            ->setUser(new User())
            ->toggle(false);
    }


}