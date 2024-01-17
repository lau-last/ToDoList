<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    #[Route('/users', name: 'user_list')]
    public function listAction(UserRepository $userRepository): Response
    {
        $user = $userRepository->findAll();
        return $this->render('user/list.html.twig', [
            'users' => $user,
        ]);
    }


    #[Route('/users/create', name: 'user_create')]
    public function createAction(
        Request                      $request,
        UserPasswordHasherInterface $encoder,
        EntityManagerInterface       $manager
    ): RedirectResponse|Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $password = $encoder->hashPassword($user, $user->getPassword());
            $user->setPassword($password);

            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', "L'utilisateur a bien été ajouté.");
            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/create.html.twig', ['form' => $form->createView()]);
    }


    #[Route('/users/{id}/edit', name: 'user_edit')]
    public function editAction(
        User                         $user,
        Request                      $request,
        UserPasswordHasherInterface $encoder,
        EntityManagerInterface       $manager
    ): RedirectResponse|Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $password = $encoder->hashPassword($user, $user->getPassword());
            $user->setPassword($password);

            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', "L'utilisateur a bien été modifié");
            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/edit.html.twig', ['form' => $form->createView(), 'user' => $user]);
    }


}
