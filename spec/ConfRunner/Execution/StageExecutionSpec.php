<?php

namespace spec\ConfRunner\Execution;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use ConfRunner\StepStage;
use ConfRunner\UserInterface;

class StageExecutionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('ConfRunner\Execution\StageExecution');
    }

    function it_should_have_stage(StepStage $stage)
    {     
      $this->setStage($stage);
      $this->getStage()->shouldReturn($stage);
    }

    function it_should_have_start_time()
    {     
      $time = new \DateTime();
      $this->setStartTime($time);
      $this->getStartTime()->shouldReturn($time);
    }

    function it_should_have_complete_time()
    {     
      $time = new \DateTime();
      $this->setCompleteTime($time);
      $this->getCompleteTime()->shouldReturn($time);
    }

    function it_should_have_completion_flag()
    {     
      $this->isComplete()->shouldReturn(FALSE);
      $this->setComplete(TRUE);
      $this->isComplete()->shouldReturn(TRUE);
    }

}
