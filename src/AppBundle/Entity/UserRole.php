<?php

namespace AppBundle\Entity;

/**
 * UserRole
 */
class UserRole
{
    /**
     * @var integer
     */
    private $roleId;

    /**
     * @var string
     */
    private $humanityName;

    /**
     * @var string
     */
    private $name;


    /**
     * Get roleId
     *
     * @return integer
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * Set humanityName
     *
     * @param string $humanityName
     *
     * @return UserRole
     */
    public function setHumanityName($humanityName)
    {
        $this->humanityName = $humanityName;

        return $this;
    }

    /**
     * Get humanityName
     *
     * @return string
     */
    public function getHumanityName()
    {
        return $this->humanityName;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return UserRole
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

