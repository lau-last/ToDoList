<?php

namespace App\Controller;

use App\Entity\Task;
use App\Entity\User;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class TaskController extends AbstractController
{

    #[IsGranted('ROLE_USER')]
    #[Route('/tasks/all', name: 'task_list_all')]
    public function listAction(TaskRepository $taskRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $tasks = $taskRepository->findByUser($user->getId());
        return $this->render('task/list.html.twig', ['tasks' => $tasks]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/tasks/done', name: 'task_list_done')]
    public function listActionDone(TaskRepository $taskRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $tasks = $taskRepository->findByUserDoneOrNot($user->getId(), true);
        return $this->render('task/list.html.twig', ['tasks' => $tasks]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/tasks/not-done', name: 'task_list_not_done')]
    public function listActionNotDone(TaskRepository $taskRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $tasks = $taskRepository->findByUserDoneOrNot($user->getId(), false);
        return $this->render('task/list.html.twig', ['tasks' => $tasks]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/tasks/create', name: 'task_create')]
    public function createAction(Request $request, EntityManagerInterface $manager): RedirectResponse|Response
    {
        $task = new Task();
        $user = $this->getUser();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        $task->setUser($user);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($task);
            $manager->flush();
            $this->addFlash('success', 'La tâche a été bien été ajoutée.');
            return $this->redirectToRoute('task_list_all');
        }

        return $this->render('task/create.html.twig', ['form' => $form->createView()]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/tasks/{id}/edit', name: 'task_edit')]
    public function editAction(Task $task, Request $request, EntityManagerInterface $manager): RedirectResponse|Response
    {

        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        /** @var User $user */
        $user = $this->getUser();
        $task->setUser($user);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($task);
            $manager->flush();

            $this->addFlash('success', 'La tâche a bien été modifiée.');
            return $this->redirectToRoute('task_list_all');
        }

        return $this->render('task/edit.html.twig', [
            'form' => $form->createView(),
            'task' => $task,
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/tasks/{id}/toggle', name: 'task_toggle')]
    public function toggleTaskAction(Task $task, EntityManagerInterface $manager): RedirectResponse
    {
        $task->toggle(!$task->isDone());
        $manager->persist($task);
        $manager->flush();
        $this->addFlash('success', sprintf('La tâche %s a bien été marquée comme faite.', $task->getTitle()));
        return $this->redirectToRoute('task_list_all');
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/tasks/{id}/delete', name: 'task_delete')]
    public function deleteTaskAction(Task $task, EntityManagerInterface $manager): RedirectResponse
    {
        $manager->remove($task);
        $manager->flush();
        $this->addFlash('success', 'La tâche a bien été supprimée.');
        return $this->redirectToRoute('task_list_all');
    }


}