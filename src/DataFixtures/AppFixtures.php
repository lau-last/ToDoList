<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i < 3; $i++) {

            $task = new Task();
            $task
                ->setTitle('Anonymous-' . $i)
                ->setContent('Anonymous-' . $i);
            $manager->persist($task);
        }


        $users = [
            [
                'name' => 'Laurent',
                'email' => 'laurent@example.com',
                'roles' => ['ROLE_ADMIN']
            ],
            [
                'name' => 'Aurélie',
                'email' => 'aurelie@example.com',
                'roles' => ['ROLE_USER']
            ],
            [
                'name' => 'Sandrine',
                'email' => 'sandrine@example.com',
                'roles' => ['ROLE_USER']
            ]
        ];


        foreach ($users as $userData) {

            $user = new User();
            $user
                ->setUsername($userData['name'])
                ->setEmail($userData['email'])
                ->setRoles($userData['roles'])
                ->setPassword('$2y$10$26QjlDmGjLG2KMPpxOwmbuEc1eJXtdOk37Ybv.Y2Ny58FNutCQRPu');
            $manager->persist($user);

//            for ($i = 0; $i < 3; $i++) {
//
//                $task = new Task();
//                $task
//                    ->setTitle('Titre-' . $i)
//                    ->setContent('Content-' . $i)
//                    ->setUser($user);
//                $manager->persist($task);
//            }
        }

        $manager->flush();
    }


}
