<?php

namespace ConfRunner\Execution;

use ConfRunner\StepStage;

class StageExecution
{

  protected $stage;
  protected $startTime;
  protected $completeTime;
  protected $isComplete = FALSE;
  protected $processExecution;

    public function __construct($stage=NULL, $processExecution=NULL) {
      $this->setStage($stage);
      $this->processExecution = $processExecution;
    }

    public function setStage($stage)
    {
      $this->stage = $stage;
      return $this;
    }

    public function getStage()
    {
      return $this->stage;
    }


    public function getName() {
      return $this->stage->getName();
    }

    public function setStartTime($startTime)
    {
      $this->startTime = $startTime;
      return $this;
    }

    public function getStartTime()
    {
      return $this->startTime;
    }

    public function isComplete()
    {
      return $this->isComplete;
    }

    public function setComplete($complete)
    {
      $this->isComplete = $complete;
      return $this;
    }

    public function setCompleteTime($completeTime)
    {
      $this->completeTime = $completeTime;
      return $this;
    }

    public function getCompleteTime()
    {
      return $this->completeTime;
    }

    public function setUser($user)
    {
      $this->user = $user;
      return $this;
    }

    public function getUser()
    {
      return $this->user;
    }

    public function getProcessExecution() {
      return $this->processExecution;
    }
}
