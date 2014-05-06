<?php

namespace Relhub\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReleaseBuild
 */
class ReleaseBuild
{

    const STATUS_PENDING = 'STATUS_PENDING';
    const STATUS_BUILDING = 'STATUS_BUILDING';
    const STATUS_BUILT = 'STATUS_BUILT';
    const STATUS_CANCELED = 'STATUS_CANCELED';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $output;

    /**
     * @var integer
     */
    private $releaseVersion;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $finished;

    /**
     * @var integer
     */
    private $user;


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
     * Set status
     *
     * @param string $status
     * @return ReleaseBuild
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
     * Set output
     *
     * @param string $output
     * @return ReleaseBuild
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
     * Set releaseVersion
     *
     * @param integer $releaseVersion
     * @return ReleaseBuild
     */
    public function setReleaseVersion($releaseVersion)
    {
        $this->releaseVersion = $releaseVersion;

        return $this;
    }

    /**
     * Get releaseVersion
     *
     * @return integer 
     */
    public function getReleaseVersion()
    {
        return $this->releaseVersion;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return ReleaseBuild
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
     * Set finished
     *
     * @param \DateTime $finished
     * @return ReleaseBuild
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;

        return $this;
    }

    /**
     * Get finished
     *
     * @return \DateTime 
     */
    public function getFinished()
    {
        return $this->finished;
    }

    /**
     * Set user
     *
     * @param integer $user
     * @return ReleaseBuild
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

    public function __toString() {
      return (string) $this->getReleaseVersion();
    }
}
