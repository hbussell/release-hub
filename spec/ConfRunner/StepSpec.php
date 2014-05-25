<?php

namespace spec\ConfRunner;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use ConfRunner\Type;

class StepSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('ConfRunner\Step');
    }

    function it_should_have_name()
    {
      $this->getName()->shouldReturn(null);
      $this->setName('test');
      $this->getName()->shouldReturn('test');
    }

    function it_should_have_description()
    {
      $this->getDescription()->shouldReturn(null);
      $this->setDescription('desc');
      $this->getDescription()->shouldReturn('desc');
    }


    function it_should_have_type(Type $type)
    {
      $this->getType()->shouldReturn(null);
      $this->setType($type);
      $this->getType()->shouldReturn($type);
    }
}
