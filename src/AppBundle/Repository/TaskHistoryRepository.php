<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 14.04.17 18:33
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Task;
use Doctrine\ORM\EntityRepository;

class TaskHistoryRepository extends EntityRepository
{
    public function getTaskHistory(Task $task)
    {
        return $this->findBy(
            ['taskId' => $task],
            ['ts' => 'desc']
        );
    }
}
