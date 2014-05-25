<?php

namespace spec\ConfRunner;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RunSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('ConfRunner\Run');
    }
}
