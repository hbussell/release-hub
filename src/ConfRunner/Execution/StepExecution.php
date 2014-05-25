<?php

namespace ConfRunner\Execution;

class StepExecution
{
    protected $stage;
  
    protected $user;
  protected $startTime;
  protected $completeTime;
  protected $isComplete = FALSE;
  protected $output;

    public function setStageExecution($stage)
    {
      $this->stage = $stage;
      return $this;
    }

    public function getStageExecution()
    {
      return $this->stage;
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

      public function setOutput($output)
      {
        $this->output = $output;
        return $this;
      }

      public function getOutput()
      {
        return $this->output;
      }



}
