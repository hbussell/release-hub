<?php

namespace Relhub\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReleaseVersion
 */
class ReleaseVersion
{

  const STATUS_PENDING = 'STATUS_PENDING';
  const STATUS_TESTING = 'STATUS_TESTING';
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

    public function isBuildable() {
      return $this->status == self::STATUS_PENDING;
    }
    

    public function __toString() {
      return $this->name;
    }


}
