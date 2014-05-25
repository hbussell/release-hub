<?php

namespace spec\ConfRunner;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use ConfRunner\StepStage;

class ProcessSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('ConfRunner\Process');
    }

    function it_should_have_name()
    {
      $this->getName()->shouldReturn(null);
      $this->setName('test');
      $this->getName()->shouldReturn('test');
    }

    function it_should_have_a_collection_of_stages(StepStage $stage1, StepStage $stage2)
    {
      $stage1->getName()->willReturn('stage1');
      $stage2->getName()->willReturn('stage2');
      $this->getStages()->shouldReturn(array());
      $this->addStage($stage1);
      $this->addStage($stage2);
      $this->getStages()->shouldReturn(array($stage1, $stage2));
    }

    /*
    function it_should_have_pending_stage(StepStage $stage)
    {
      $this->getPendingStage()->shouldReturn(null);
      $this->addStage($stage);
      $stage->isComplete()->shouldBeCalled();
      $this->getPendingStage()->shouldReturn($stage);

    }*/

}
