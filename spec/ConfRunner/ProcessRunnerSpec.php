<?php

namespace spec\ConfRunner;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use ConfRunner\Process;

class ProcessRunnerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('ConfRunner\ProcessRunner');
    }

//    function it_should_run_a_process(Process $process)
  //  {
//      $process->run()->shouldBeCalled();
//      $process->run();
    //}
    

}
