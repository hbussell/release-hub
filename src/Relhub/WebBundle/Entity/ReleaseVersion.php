<?php

namespace Relhub\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Yaml\Parser;

/**
 * ReleaseVersion
 */
class ReleaseVersion
{

  const STATUS_PENDING = 'STATUS_PENDING';
  const STATUS_TESTING = 'STATUS_TESTING';
  const STATUS_PASSED_TESTS = 'STATUS_PASSED_TESTS';
  const STATUS_FAILED_TESTS = 'STATUS_FAILED_TESTS';
  const STATUS_PUBLISHING = 'STATUS_PUBLISING';
  const STATUS_PUBLISHED = 'STATUS_PUBLISHED';

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
    private $stage = '';

    /**
     * @var string
     */
    private $actions;

    private $actionsArray;

    /**
     * @var string
     */
    private $options;
    private $optionsArray;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $published;

    /**
     * @var string
     */
    private $status;

    private $branchNames;

    private $dueDate;

    /**
     * Approving user.
     * @var Relhub\WebBundle\Entity\User
     */ 
    private $approver;

    /**
     * Project.
     * @var Relhub\WebBundle\Entity\Project
     */ 
    private $project;
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
     * @return ReleaseVersion
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
     * Set actions
     *
     * @param string $actions
     * @return ReleaseVersion
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


    /**
     * Get actions array
     *
     * @return array
     */
    public function getActionsArray()
    {
      if (!$this->actionsArray) {          
        $yaml = new Parser();

        if (strpos($this->actions, '.yml') === strlen($this->actions) - 4 && 
          file_exists($this->actions)) {
          $this->actions = file_get_contents($this->actions);
        }

        $actions = $yaml->parse($this->actions);         
        $this->actionsArray = array();
        foreach ($actions as $stage=>$stageActions) {
          if (empty($stageActions)) {
            continue;
          }
          foreach ($stageActions as $action) {
            if (is_string($action)) {
              $this->actionsArray[$stage][] = array('name'=>$action, 'options'=>array());
            }
            elseif (is_array($action)) {
              foreach ($action as $name=>$options) {
                $this->actionsArray[$stage][] = array('name'=>$name, 'options'=>$options);
              }
            }
          }
        }
      }
      return $this->actionsArray;
    }



    /**
     * Set created
     *
     * @param \DateTime $created
     * @return ReleaseVersion
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set published
     *
     * @param \DateTime $published
     * @return ReleaseVersion
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return \DateTime 
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return ReleaseVersion
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set stage
     *
     * @param string $stage
     * @return ReleaseVersion
     */
    public function setStage($stage)
    {
        $this->stage = $stage;

        return $this;
    }

    /**
     * Get stage
     *
     * @return string 
     */
    public function getStage()
    {
        return $this->stage;
    }



    /**
     * Set status
     *
     * @param string $status
     * @return ReleaseVersion
     */
    public function setApprover($approver)
    {
        $this->approver = $approver;

        return $this;
    }

    /**
     * Get status
     *
     * @return Relhub\WebBundle\Entity\Project
     */
    public function getApprover()
    {
        return $this->approver;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return ReleaseVersion
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * Set branch names
     *
     * @param string $names
     * @return ReleaseVersion
     */
    public function setBranchNames($names)
    {
        $this->branchNames = $names;

        return $this;
    }

    /**
     * Get branch names
     * 
     * @return string 
     */
    public function getBranchNames()
    {
        return $this->branchNames;
    }
 
    /**
     * Get branchs
     * 
     * @return array
     */
    public function getBranches()
    {
        return explode(PHP_EOL, $this->branchNames);
    }
 
   /**
     * Set status
     *
     * @param string $status
     * @return ReleaseVersion
     */
    public function setProject($project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get status
     *
     * @return Relhub\WebBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
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
        $base = $this->project->getOptionsArray();
        $yaml = new Parser();

        if (strpos($this->options, '.yml') === strlen($this->options) - 4 && 
          file_exists($this->options)) {
          $this->options = file_get_contents($this->options);
        }

        $optionsArray = $yaml->parse($this->options);         
        $optionsArray['release'] = $this->getName();
        $this->optionsArray = array_merge($base, $optionsArray);
      } 
      return $this->optionsArray;
    }



    public function isBuildable() {
      return $this->status == self::STATUS_PENDING;
    }
    
    public function isPublishable() {
      return $this->status == self::STATUS_PENDING;
    }

    public function getFriendlyStatus() {
      if ($this->status == self::STATUS_PENDING) {
        return 'Pending';
      }
      if ($this->status == self::STATUS_TESTING) {
        return 'Testing in progress';
      }
      if ($this->status == self::STATUS_FAILED_TESTS) {
        return 'Failed Testing';
      }
      if ($this->status == self::STATUS_PASSED_TESTS) {
        return 'Passed Testing';
      }
      if ($this->status == self::STATUS_PUBLISHING) {
        return 'Publishing in progress';
      }

      if ($this->status == self::STATUS_PUBLISHED) {
        return 'Published';
      }
    }
 
    public function __toString() {
      return $this->name;
    }


    public function getNextManualCommands() {
          
    }

    public function getNextCommands() {
      $actions = $this->getActions();
      $currentStage = $this->getCurrentStage();

    }

    public function getCurrentStage() {
      $useStage = FALSE;
      foreach ($this->getActions() as $actionStage => $actionSteps) {
        if (!$this->stage) {
          // No current stage so lets use the first stage found.
          return $actionStage;
        }
        else if ($this->stage == $actionStage) {
          // check if we have any pending commands.
          return $actionStage;
        }
      }
      return FALSE;        
    }

}
