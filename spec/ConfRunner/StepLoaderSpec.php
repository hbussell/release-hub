<?php

namespace spec\ConfRunner;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StepLoaderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('ConfRunner\StepLoader');
    }
}
