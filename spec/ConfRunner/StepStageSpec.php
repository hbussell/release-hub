<?php

namespace spec\ConfRunner;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use ConfRunner\Step;


class StepStageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('ConfRunner\StepStage');
    }

    function it_should_have_steps()
    {
      $this->getSteps()->shouldReturn(null);
    }

    function it_should_accept_new_steps(Step $step)
    {
      $this->addStep($step);
      $this->getSteps()->shouldBe(array($step));
    }

    function it_should_reject_duplicate_steps(Step $step)
    {
      $this->addStep($step);
      $this->addStep($step);
      $this->getSteps()->shouldBe(array($step));
    }

    function it_should_have_a_name()
    {
      $this->setName('test');
      $this->getName()->shouldBe('test');
    }

}
