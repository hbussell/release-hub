<?php

namespace Relhub\WebBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

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
    private $gitUrl;


    /**
     * @var string
     */
    private $actions;

    /**
     * List of webhooks called before the release branch is built.
     * Eg /check-all-branches
     * @var string
     */ 
    private $preBuildHooks;

    /**
     * List of webhooks called after the release branch is built.
     * Eg /deploy-release?release=$release
     * @var string
     */ 
    private $postBuildHooks;

    /**
     * List of webhooks called before the release branch published.
     * Eg /check-test-server
     * @var string
     */ 
    private $prePublishHooks;

    /**
     * List of webhooks called after the release branch is published.
     * Eg /smoke-test-prod
     * @var string
     */ 
    private $postPublishHooks;


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
     * Set gitUrl
     *
     * @param string $gitUrl
     * @return Project
     */
    public function setGitUrl($gitUrl)
    {
        $this->gitUrl = $gitUrl;

        return $this;
    }

    /**
     * Get gitUrl
     *
     * @return string 
     */
    public function getGitUrl()
    {
        return $this->gitUrl;
    }



    /**
     * Set action
     *
     * @param string $action
     * @return Project
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
     * Set pre build hooks
     *
     * @param string $hooks
     * @return Project
     */
    public function setPreBuildHooks($hooks)
    {
        $this->preBuildHooks = $hooks;

        return $this;
    }

    /**
     * Get pre build hooks
     *
     * @return string 
     */
    public function getPreBuildHooks()
    {
        return $this->preBuildHooks;
    }

    /**
     * Set post build hooks
     *
     * @param string $hooks
     * @return Project
     */
    public function setPostBuildHooks($hooks)
    {
        $this->postBuildHooks = $hooks;

        return $this;
    }

    /**
     * Get post build hooks
     *
     * @return string 
     */
    public function getPostBuildHooks()
    {
        return $this->postBuildHooks;
    }

    /**
     * Set pre publish hooks
     *
     * @param string $hooks
     * @return Project
     */
    public function setPrePublishHooks($hooks)
    {
        $this->prePublishHooks = $hooks;

        return $this;
    }

    /**
     * Get pre publish hooks
     *
     * @return string 
     */
    public function getPrePublishHooks()
    {
        return $this->prePublishHooks;
    }

    /**
     * Set post publish hooks
     *
     * @param string $hooks
     * @return Project
     */
    public function setPostPublishHooks($hooks)
    {
        $this->postPublishHooks = $hooks;

        return $this;
    }

    /**
     * Get post publish hooks
     *
     * @return string 
     */
    public function getPostPublishHooks()
    {
        return $this->postPublishHooks;
    }


    public function __toString() {

      return $this->getName();
        
    }
}
