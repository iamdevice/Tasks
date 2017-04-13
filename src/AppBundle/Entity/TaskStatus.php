<?php

namespace AppBundle\Entity;

/**
 * TaskStatus
 */
class TaskStatus
{
    /**
     * @var integer
     */
    private $statusId;

    /**
     * @var string
     */
    private $name;


    /**
     * Get statusId
     *
     * @return integer
     */
    public function getStatusId()
    {
        return $this->statusId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return TaskStatus
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
}

