<?php

namespace Relhub\WebBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Branch
 */
class Branch
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
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $published;
    

    private $transitions;

    /**
     * @var string
     */
    private $vcsUrl;
    
    private $revision;

    /**
     * @var string
     */
    private $ticketUrl;

    private $project;
    
    private $release;

    private $authors;

    public function __construct()
    {
      $this->author = new ArrayCollection();
      $this->transitions = new ArrayCollection();
    
    }
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
     * @return Branch
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
     * @return Branch
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
     * @return Branch
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
     * Set isTested
     *
     * @param boolean $isTested
     * @return Branch
     */
    public function setIsTested($isTested)
    {
        $this->isTested = $isTested;

        return $this;
    }

    /**
     * Get isTested
     *
     * @return boolean 
     */
    public function getIsTested()
    {
        return $this->isTested;
    }

    /**
     * Set isApproved
     *
     * @param boolean $isApproved
     * @return Branch
     */
    public function setIsApproved($isApproved)
    {
        $this->isApproved = $isApproved;

        return $this;
    }

    /**
     * Get isApproved
     *
     * @return boolean 
     */
    public function getIsApproved()
    {
        return $this->isApproved;
    }

    /**
     * Set isPeerTested
     *
     * @param boolean $isPeerTested
     * @return Branch
     */
    public function setIsPeerTested($isPeerTested)
    {
        $this->isPeerTested = $isPeerTested;

        return $this;
    }

    /**
     * Get isPeerTested
     *
     * @return boolean 
     */
    public function getIsPeerTested()
    {
        return $this->isPeerTested;
    }

    /**
     * Set isDeployed
     *
     * @param boolean $isDeployed
     * @return Branch
     */
    public function setIsDeployed($isDeployed)
    {
        $this->isDeployed = $isDeployed;

        return $this;
    }

    /**
     * Get isDeployed
     *
     * @return boolean 
     */
    public function getIsDeployed()
    {
        return $this->isDeployed;
    }

    /**
     * Set vcsUrl
     *
     * @param string $vcsUrl
     * @return Branch
     */
    public function setVcsUrl($vcsUrl)
    {
        $this->vcsUrl = $vcsUrl;

        return $this;
    }

    /**
     * Get vcsUrl
     *
     * @return string 
     */
    public function getVcsUrl()
    {
        return $this->vcsUrl;
    }


    /**
     * Set vcsUrl
     *
     * @param string $vcsUrl
     * @return Branch
     */
    public function setRevision($revision)
    {
        $this->revision = $revision;

        return $this;
    }

    /**
     * Get vcsUrl
     *
     * @return string 
     */
    public function getRevision()
    {
        return $this->revision;
    }



    /**
     * Set ticketUrl
     *
     * @param string $ticketUrl
     * @return Branch
     */
    public function setTicketUrl($ticketUrl)
    {
        $this->ticketUrl = $ticketUrl;

        return $this;
    }

    /**
     * Get ticketUrl
     *
     * @return string 
     */
    public function getTicketUrl()
    {
        return $this->ticketUrl;
    }

    public function getSetTransitions($transitions) 
    {
      $this->transitions = $transitions;

      return $this;
    }

    public function getTransitions() 
    {
      return  $this->transitions;
    }

    public function getProject()
    {
      return $this->project;
    }

    public function getRelease()
    {
      return $this->release;
    }


}
