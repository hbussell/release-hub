<?php

namespace ConfRunner;

use ConfRunner\Type;

class Step
{

    protected $name;
    protected $type;
    protected $description;

    public function getName()
    {
      return $this->name;
    }

    public function setName($name)
    {
      $this->name = $name;
      return $this;
    }

    public function getDescription()
    {
      return $this->description;
    }

    public function setDescription($description)
    {
      $this->description = $description;
      return $this;
    }

    public function getType()
    {
      return $this->type;
    }

    public function setType(Type $type) 
    {
      $this->type = $type;
      return $this;
    }
}
