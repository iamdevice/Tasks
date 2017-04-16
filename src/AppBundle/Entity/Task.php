<?php

namespace AppBundle\Entity;

/**
 * Task
 */
class Task
{
    /**
     * @var integer
     */
    private $taskId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var boolean
     */
    private $isDeleted = false;

    /**
     * @var string
     */
    private $workResult;

    /**
     * @var \DateTime
     */
    private $createdTs;

    /**
     * @var \DateTime
     */
    private $updatedTs;

    /**
     * @var \AppBundle\Entity\User
     */
    private $creator;

    /**
     * @var \AppBundle\Entity\User
     */
    private $performer;

    /**
     * @var \AppBundle\Entity\TaskStatus
     */
    private $statusId;


    /**
     * Get taskId
     *
     * @return integer
     */
    public function getTaskId()
    {
        return $this->taskId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Task
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Task
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set isDeleted
     *
     * @param boolean $isDeleted
     *
     * @return Task
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    /**
     * Get isDeleted
     *
     * @return boolean
     */
    public function getIsDeleted()
    {
        return $this->isDeleted;
    }

    /**
     * Set workResult
     *
     * @param string $workResult
     *
     * @return Task
     */
    public function setWorkResult($workResult)
    {
        $this->workResult = $workResult;

        return $this;
    }

    /**
     * Get workResult
     *
     * @return string
     */
    public function getWorkResult()
    {
        return $this->workResult;
    }

    /**
     * Set createdTs
     *
     * @param \DateTime $createdTs
     *
     * @return Task
     */
    public function setCreatedTs($createdTs)
    {
        $this->createdTs = $createdTs;

        return $this;
    }

    /**
     * Get createdTs
     *
     * @return \DateTime
     */
    public function getCreatedTs()
    {
        return $this->createdTs;
    }

    /**
     * Set updatedTs
     *
     * @param \DateTime $updatedTs
     *
     * @return Task
     */
    public function setUpdatedTs($updatedTs)
    {
        $this->updatedTs = $updatedTs;

        return $this;
    }

    /**
     * Get updatedTs
     *
     * @return \DateTime
     */
    public function getUpdatedTs()
    {
        return $this->updatedTs;
    }

    /**
     * Set creator
     *
     * @param User $creator
     *
     * @return Task
     */
    public function setCreator(User $creator = null)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get creator
     *
     * @return User
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set performer
     *
     * @param User $performer
     *
     * @return Task
     */
    public function setPerformer(User $performer = null)
    {
        $this->performer = $performer;

        return $this;
    }

    /**
     * Get performer
     *
     * @return User
     */
    public function getPerformer()
    {
        return $this->performer;
    }

    /**
     * Set statusId
     *
     * @param TaskStatus $statusId
     *
     * @return Task
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

    public function isStatusInProcess()
    {
        return $this->statusId->getName() == 'В работе';
    }

    public function isStatusOnCheck()
    {
        return $this->statusId->getName() == 'На проверке';
    }

    public function isStatusClosed()
    {
        return $this->statusId->getName() == 'Закрыта';
    }

    public function isSupervisorEditStatus()
    {
        return $this->isStatusOnCheck() || $this->isStatusClosed();
    }
}

