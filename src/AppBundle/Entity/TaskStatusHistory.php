<?php

namespace AppBundle\Entity;

/**
 * TaskStatusHistory
 */
class TaskStatusHistory
{
    /**
     * @var integer
     */
    private $historyId;

    /**
     * @var \DateTime
     */
    private $ts;

    /**
     * @var \AppBundle\Entity\Task
     */
    private $taskId;

    /**
     * @var \AppBundle\Entity\TaskStatus
     */
    private $statusId;

    /**
     * @var \AppBundle\Entity\User
     */
    private $userId;


    /**
     * Get historyId
     *
     * @return integer
     */
    public function getHistoryId()
    {
        return $this->historyId;
    }

    /**
     * Set ts
     *
     * @param \DateTime $ts
     *
     * @return TaskStatusHistory
     */
    public function setTs($ts)
    {
        $this->ts = $ts;

        return $this;
    }

    /**
     * Get ts
     *
     * @return \DateTime
     */
    public function getTs()
    {
        return $this->ts;
    }

    /**
     * Set taskId
     *
     * @param Task $taskId
     *
     * @return TaskStatusHistory
     */
    public function setTaskId(Task $taskId = null)
    {
        $this->taskId = $taskId;

        return $this;
    }

    /**
     * Get taskId
     *
     * @return Task
     */
    public function getTaskId()
    {
        return $this->taskId;
    }

    /**
     * Set statusId
     *
     * @param TaskStatus $statusId
     *
     * @return TaskStatusHistory
     */
    public function setStatusId(TaskStatus $statusId = null)
    {
        $this->statusId = $statusId;

        return $this;
    }

    /**
     * Get statusId
     *
     * @return TaskStatus
     */
    public function getStatusId()
    {
        return $this->statusId;
    }

    /**
     * Set userId
     *
     * @param User $userId
     *
     * @return TaskStatusHistory
     */
    public function setUserId(User $userId = null)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return User
     */
    public function getUserId()
    {
        return $this->userId;
    }
}

