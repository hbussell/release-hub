<?php

namespace spec\ConfRunner\Execution;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use ConfRunner\StepStage;
use ConfRunner\Execution\StageExecution;
use ConfRunner\UserInterface;

class StepExecutionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('ConfRunner\Execution\StepExecution');
    }

    function it_should_have_stage_execution(StageExecution $stageExecution)
    {     
      $this->setStageExecution($stageExecution);
      $this->getStageExecution()->shouldReturn($stageExecution);
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

    function it_should_have_output()
    {     
      $this->getOutput()->shouldReturn(NULL);
      $this->setOutput('some output');
      $this->getOutput()->shouldReturn('some output');
    }

    function it_should_have_user(UserInterface $user)
    {     
      $this->getUser()->shouldReturn(NULL);
      $this->setUser($user);
      $this->getUser()->shouldReturn($user);
    }


}
