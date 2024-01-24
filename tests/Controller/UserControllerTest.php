<?php

namespace App\Tests\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{

    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testUserCreation()
    {

        $crawler = $this->client->request('GET', '/users/create');

        $this->assertResponseIsSuccessful();

        $form = $crawler->selectButton('Ajouter')->form();
        $form['user[username]'] = 'newuser';
        $form['user[password][first]'] = 'password123';
        $form['user[password][second]'] = 'password123';
        $form['user[email]'] = 'newuser@example.com';

        $this->client->submit($form);
        $this->assertResponseRedirects('/login');
        $this->client->followRedirect();
        $this->assertSelectorTextContains('div.alert.alert-success', 'L\'utilisateur a bien été ajouté.');
    }


    public function testPermissionUserForList()
    {
        $userWithAdminRole = $this->getUserName('Laurent');
        $userWithUserRole = $this->getUserName('Sandrine');

        $this->client->loginUser($userWithAdminRole);
        $this->client->request('GET', '/users');
        $this->assertResponseStatusCodeSame(200);

        $this->client->loginUser($userWithUserRole);
        $this->client->request('GET', '/users');
        $this->assertResponseStatusCodeSame(403);

    }

    private function getUserName(string $name): ?User
    {
        $entityManager = $this->client->getContainer()->get('doctrine.orm.entity_manager');
        /** @var UserRepository $userRepository */
        $userRepository = $entityManager->getRepository(User::class);
        return $userRepository->findOneBy(['username' => $name]);
    }



}