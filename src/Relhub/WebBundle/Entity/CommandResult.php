<?php

namespace Relhub\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommandResult
 */
class CommandResult
{

    const STATUS_PENDING = 'STATUS_PENDING';
    const STATUS_SUCCESSFUL = 'STATUS_SUCCESSFUL';    
    const STATUS_APPROVED = 'STATUS_APPROVED';    
    const STATUS_FAILED = 'STATUS_FAILED';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $action;

    /**
     * @var string
     */
    private $stage;

    /**
     * @var integer
     */
    private $releaseId;

    /**
     * @var string
     */
    private $output;

    /**
     * @var string
     */
    private $status = self::STATUS_PENDING;

    /**
     * @var integer
     */
    private $user;

    /**
     * @var \DateTime
     */
    private $created;


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
     * Set action
     *
     * @param string $action
     * @return CommandResult
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string 
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set stage
     *
     * @param string $stage
     * @return CommandResult
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
     * Set releaseId
     *
     * @param integer $releaseId
     * @return CommandResult
     */
    public function setReleaseId($releaseId)
    {
        $this->releaseId = $releaseId;

        return $this;
    }

    /**
     * Get releaseId
     *
     * @return integer 
     */
    public function getReleaseId()
    {
        return $this->releaseId;
    }

    /**
     * Set output
     *
     * @param string $output
     * @return CommandResult
     */
    public function setOutput($output)
    {
        $this->output = $output;

        return $this;
    }

    /**
     * Get output
     *
     * @return string 
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return CommandResult
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function setSuccessful() {
      $this->status = self::STATUS_SUCCESSFUL;
    }

    public function setFailed() {
      $this->status = self::STATUS_FAILED;
    }

    public function isSuccessful() {
      return $this->status == self::STATUS_SUCCESSFUL || $this->status == self::STATUS_APPROVED;
    }

    public function setApproved() {
      $this->status = self::STATUS_APPROVED;
    }

    public function isApproved() {
      return $this->status == self::STATUS_APPROVED;
    }

    public function isPending() {
      return $this->status == self::STATUS_PENDING;
    }



    public function isManual() {
      return $this->isApproved();
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
     * Set user
     *
     * @param integer $user
     * @return CommandResult
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return integer 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return CommandResult
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
}
