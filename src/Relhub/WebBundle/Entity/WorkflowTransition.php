<?php

namespace Relhub\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 */
class WorkflowTransition
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $fromState;

    private $toState;

    private $creator;

    private $created;
    
    private $branch;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Project
     */
    public function setFromState($state)
    {
        $this->fromState = $state;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getFromState()
    {
        return $this->fromState;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Project
     */
    public function setToState($state)
    {
        $this->toState = $state;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getToState()
    {
        return $this->toState;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Project
     */
    public function setCreator($creator)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getCreator()
    {
        return $this->creator;
    }


    /**
     * Set name
     *
     * @param string $name
     * @return Project
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getCreated()
    {
        return $this->created;
    }



    /**
     * Set name
     *
     * @param string $name
     * @return Project
     */
    public function setBranch($branch)
    {
        $this->branch = $branch;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getBranch()
    {
        return $this->branch;
    }



    public function __toString() {

      return $this->fromState->__toString() . ' - ' . $this->toState->__toString();
        
    }
}
