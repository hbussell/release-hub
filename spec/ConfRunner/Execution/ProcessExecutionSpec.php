<?php

namespace spec\ConfRunner\Execution;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use ConfRunner\StepStage;
use ConfRunner\Execution\StageExecution;
use ConfRunner\Execution\ProcessExecution;
use ConfRunner\UserInterface;
use ConfRunner\Process;


class ProcessExecutionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('ConfRunner\Execution\ProcessExecution');
    }

    function it_should_have_stage_execution(Process $process)
    {     
      $this->setProcess($process);
      $this->getProcess()->shouldReturn($process);
    }

    function it_should_have_an_id()
    {     
      $this->getId()->shouldReturn(NULL);
      $this->setId('sample');
      $this->getId()->shouldReturn('sample');
    }

    function it_should_have_empty_pending_stage_by_default()
    {     
      $this->getPendingStage()->shouldReturn(NULL);
    }

    function it_should_have_a_list_of_stage_executions(ProcessExecution $processExecution, Process $process, StepStage $stage1, StepStage $stage2)
    { 
      $stage1->getName()->willReturn('stage1');
      $stage2->getName()->willReturn('stage2');

      $process->getStages()->willReturn(array($stage1, $stage2));
      $this->setProcess($process);
      $stages = $this->getStages();
      $stages[0]->shouldHaveType('ConfRunner\Execution\StageExecution');
      $stages[1]->shouldHaveType('ConfRunner\Execution\StageExecution');
      $stages[0]->getName()->shouldBe('stage1');
      $stages[1]->getName()->shouldBe('stage2');
    }

    function it_should_have_pending_stage_after_adding_process(Process $process, StepStage $stage1, StageExecution $stage1Execution)
    { 
      $stage1Execution->getName()->willReturn('stage1');
      $process->getStages()->willReturn(array($stage1));
      $stage1Execution->setStage($stage1);
      $stage1Execution->isComplete()->shouldBeCalled();
      $this->setProcess($process);
      $this->setStages([$stage1Execution]);
      $pending = $this->getPendingStage();
      $pending->getName()->shouldBe('stage1');
    }

    function it_should_get_first_uncomplete_pending_stage(Process $process, StepStage $stage1,
      StageExecution $stage1Execution, StepStage $stage2, StageExecution $stage2Execution)
    { 
      $stage1Execution->getName()->willReturn('stage1');
      $stage2Execution->getName()->willReturn('stage2');
      $process->getStages()->willReturn([$stage1, $stage2]);
      $stage1Execution->setStage($stage1);
      $stage2Execution->setStage($stage2);
      $stage1Execution->isComplete()->willReturn(TRUE);
      $stage1Execution->isComplete()->shouldBeCalled();
      $stage2Execution->isComplete()->shouldBeCalled();
      $this->setProcess($process);
      $this->setStages([$stage1Execution, $stage2Execution]);
      $pending = $this->getPendingStage();
      $pending->getName()->shouldBe('stage2');
    }

}
