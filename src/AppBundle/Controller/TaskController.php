<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Task controller.
 *
 */
class TaskController extends Controller
{
    /**
     * Lists all task entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tasks = $em->getRepository('AppBundle:Task')->findBy(['isDeleted' => false]);
        return $this->render('task/index.html.twig', array(
            'tasks' => $tasks,
            'isSupervisor' => $this->isSupervisor(),
            'user' => $this->getUser(),
        ));
    }

    /**
     * Creates a new task entity.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function newAction(Request $request)
    {
        $task = new Task();
        $form = $this->createForm('AppBundle\Form\TaskType', $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist(
                $em->getRepository('AppBundle:Task')
                    ->completeNewTask($task, $this->getUser())
            );
            $em->flush();

            return $this->redirectToRoute('task_show', array('taskId' => $task->getTaskid()));
        }

        return $this->render('task/new.html.twig', array(
            'task' => $task,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a task entity.
     *
     * @param Task $task
     *
     * @return Response
     */
    public function showAction(Task $task)
    {
        $deleteForm = $this->createDeleteForm($task);

        return $this->render('task/show.html.twig', array(
            'isSupervisor' => $this->isSupervisor(),
            'user' => $this->getUser(),
            'task' => $task,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing task entity.
     *
     * @param Request $request
     * @param Task $task
     *
     * @return Response
     */
    public function editAction(Request $request, Task $task)
    {
        $deleteForm = $this->createDeleteForm($task);
        $editForm = $this->createForm('AppBundle\Form\TaskType', $task);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('task_edit', array('taskId' => $task->getTaskid()));
        }

        return $this->render('task/edit.html.twig', array(
            'isSupervisor' => $this->isSupervisor(),
            'user' => $this->getUser(),
            'task' => $task,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a task entity.
     *
     * @param Request $request
     * @param Task $task
     *
     * @return Response
     */
    public function deleteAction(Request $request, Task $task)
    {
        if ($this->getUser()->getRoleId()->getName() == 'ROLE_SUPERVISOR') {
            $form = $this->createDeleteForm($task);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $task->setIsDeleted(true);
                $em->persist($task);
                $em->flush();
            }
        }

        return $this->redirectToRoute('task_index');
    }

    /**
     * Creates a form to delete a task entity.
     *
     * @param Task $task The task entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Task $task)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('task_delete', array('taskId' => $task->getTaskid())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function takeAction(Task $task)
    {
        $em = $this->getDoctrine()->getManager()->getRepository('AppBundle:Task');
        $em->takeTask($task, $this->getUser());

        return $this->redirectToRoute('task_index');
    }

    public function closeAction(Task $task)
    {
        $em = $this->getDoctrine()->getManager()->getRepository('AppBundle:Task');
        $em->closeTask($task, $this->getUser());

        return $this->redirectToRoute('task_index');
    }

    private function isSupervisor()
    {
        return $this->getUser()->getRoleId()->getName() === 'ROLE_SUPERVISOR';
    }
}
