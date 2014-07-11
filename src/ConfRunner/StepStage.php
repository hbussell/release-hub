<?php

namespace ConfRunner;

class StepStage
{

    protected $steps;
    protected $name;

    public function getSteps()
    {
        return $this->steps;
    }

    public function addStep($step)
    {
      // TODO: write logic here
      if (!isset($this->steps)) {
        $this->steps = array();
      }
      if (in_array($step, $this->steps)) {
        return $this;
      }
      $this->steps []= $step;
      return $this;
    }

    public function getName()
    {
      return $this->name;
    }

    public function setName($name)
    {
      $this->name = $name;
      return $this;
    }


    public function getStages()
    {
      // TODO: write logic here

    }

    public function isComplete() 
    {
      if (empty($this->steps)) {
        return FALSE;
      }
      foreach($this->steps as $step) {
        if (!$step->isComplete()) {
          return FALSE;
        }
      }
      return TRUE;
    }
}

