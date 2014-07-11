<?php

namespace ConfRunner;

class Process
{

  protected $name;
  protected $stages;

    public function __construct() {
      $this->stages = array();
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

    public function getStages() {
      return $this->stages;
    }

    public function addStage(StepStage $stage)
    {
      if (!isset($this->stages)) {
        $this->stages = array();
      }
      if (in_array($stage, $this->stages)) {
        return $this;
      }
      $this->stages []= $stage;
      return $this;
    }


    public function getPendingStage()
    {
      // TODO: write logic here
      //array_pop($this->stages);
      if (empty($this->stages)) {
        return NULL;
      }
      return $this->stages[0];
    }
}
