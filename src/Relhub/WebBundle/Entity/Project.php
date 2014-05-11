<?php

namespace Relhub\WebBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Yaml\Parser;

/**
 * Project
 */
class Project
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $options;
    private $optionsArray;

    /**
     * @var string
     */
    private $actions;

    /**
     * @var ArrayCollection
     */
    private $users;

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
     * Set options
     *
     * @param string $options
     * @return Project
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get options
     *
     * @return string 
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Get options array
     *
     * @return string 
     */
    public function getOptionsArray()
    {
      if (!$this->optionsArray) {          
        $yaml = new Parser();
        if (strpos($this->options, '.yml') === strlen($this->options) - 4 && 
          file_exists($this->options)) {
          $this->options = file_get_contents($this->options);
        }
        $this->optionsArray = $yaml->parse($this->options);         
        $this->optionsArray['project'] = $this->name;
      } 
      return $this->optionsArray;
    }

    /**
     * Set actions
     *
     * @param string $actions
     * @return Project
     */
    public function setActions($actions)
    {
        $this->actions = $actions;

        return $this;
    }

    /**
     * Get actions
     *
     * @return string 
     */
    public function getActions()
    {
        return $this->actions;
    }

    public function __toString() {

      return $this->getName();
        
    }
}
