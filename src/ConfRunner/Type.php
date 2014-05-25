<?php

namespace ConfRunner;

abstract class Type
{

    protected $name;

    public function getName()
    {
      return $this->name;
    }

    public function setName($name)
    {
      $this->name = $name;
      return $this;
    }

    public abstract function supports($data);

    public abstract function run();

    
}
