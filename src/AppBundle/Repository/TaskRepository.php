<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 13.04.17 23:15
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Task;
use AppBundle\Entity\TaskStatus;
use AppBundle\Entity\TaskStatusHistory;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

class TaskRepository extends EntityRepository
{
    public function completeNewTask(Task $task, User $user)
    {
        return $task
            ->setCreator($user)
            ->setCreatedTs(new \DateTime())
            ->setStatusId(
                $this->getEntityManager()
                    ->getRepository('AppBundle:TaskStatus')
                    ->findOneBy(['name' => 'Создана'])
            );
    }

    public function takeTask(Task $task, User $user)
    {
        $now = new \DateTime();
        $status = $this->getEntityManager()
                    ->getRepository('AppBundle:TaskStatus')
                    ->findOneBy(['name' => 'В работе']);

        $this->changeTask($task, $user, $status, $now);
    }

    public function closeTask(Task $task, User $user)
    {
        $now = new \DateTime();
        $status = $this->getEntityManager()
            ->getRepository('AppBundle:TaskStatus')
            ->findOneBy(['name' => 'Закрыта']);

        $this->changeTask($task, $user, $status, $now);
    }

    private function changeTask(Task $task, User $user, TaskStatus $status, \DateTime $dt)
    {
        $em = $this->getEntityManager();

        $task
            ->setPerformer($user)
            ->setStatusId($status)
            ->setUpdatedTs($dt);
        $em->persist($task);
        $em->flush($task);

        $history = new TaskStatusHistory();
        $history
            ->setUserId($user)
            ->setTaskId($task)
            ->setStatusId($task->getStatusId())
            ->setTs($dt);
        $em->persist($history);
        $em->flush($history);
    }

    public function unfinishedUserTasks(User $user)
    {
        return $this->findBy([
            'performer' => $user,
            'isDeleted' => false
        ]);
    }
}
