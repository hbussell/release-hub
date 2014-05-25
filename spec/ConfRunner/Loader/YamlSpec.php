<?php

namespace spec\ConfRunner\Loader;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use ConfRunner\Loader\Yaml;

class YamlSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('ConfRunner\Loader\Yaml');
    }

    function it_should_extend_loader()
    {
        $this->shouldBeAnInstanceOf('ConfRunner\StepLoader');
    }

    function it_should_create_step_collection_for_file(Yaml $loader)
    {
      $file = __DIR__ . '/data/steps.yaml';
      $process = $this->load($file);
      $process->shouldBeAnInstanceOf('ConfRunner\Process');
      $process->getName()->shouldBe('Production Release');
      $stages = $process->getStages();
      $stages[0]->getName()->shouldBe('stage1');
      $steps = $stages[0]->getSteps();
      $steps[0]->getName()->shouldBe('step 1');
      $steps[0]->getType()->shouldBeAnInstanceOf('ConfRunner\Type\Manual');
      $steps[1]->getName()->shouldBe('step 2');
      $steps[1]->getType()->shouldBeAnInstanceOf('ConfRunner\Type\Exec');
      $steps[2]->getName()->shouldBe('step 3');
      $steps[2]->getType()->shouldBeAnInstanceOf('ConfRunner\Type\Exec');
      $steps[3]->getName()->shouldBe('step 4');
      $steps[3]->getType()->shouldBeAnInstanceOf('ConfRunner\Type\Manual');

      $steps = $stages[1]->getSteps();
      $steps[0]->getName()->shouldBe('step 1');
      $steps[0]->getType()->shouldBeAnInstanceOf('ConfRunner\Type\Exec');
      $steps[1]->getName()->shouldBe('step 2');
      $steps[1]->getType()->shouldBeAnInstanceOf('ConfRunner\Type\Manual');
      $steps[1]->getDescription()->shouldBe('get manual confirmation');

    }

    function it_should_use_file_name_as_default_name(Yaml $loader)
    {
      $file = __DIR__ . '/data/steps2.yaml';
      $process = $this->load($file);
      $process->shouldBeAnInstanceOf('ConfRunner\Process');
      $process->getName()->shouldBe('steps2');
    }
}
