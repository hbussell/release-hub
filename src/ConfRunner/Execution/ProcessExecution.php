<?php

namespace ConfRunner\Execution;

class ProcessExecution
{

    protected $process;

    protected $stages;

    protected $id;

    public function setProcess($process)
    {
      $this->process = $process;
      $this->stages = [];
      $stages = $process->getStages();
      if (!empty($stages)) {
        foreach ($stages as $stage) {
          $this->stages []= new StageExecution($stage, $this);
        }
      }
      return $this;
    }

    public function getProcess()
    {
      return $this->process;
    }

    public function setId($id)
    {
      $this->id = $id;
      return $this;
    }

    public function getId()
    {
      return $this->id;
    }

    public function getPendingStage()
    {
       if (empty($this->stages)) {
          return NULL;
       }
       foreach ($this->stages as $stage) {
          if (!$stage->isComplete()) {
            return $stage;
          }
       }
    }

    public function setStages($stages){ 
      $this->stages = $stages;
      return $this;
    }

    public function getStages()
    {
      return $this->stages;
    }
}
