<?php

namespace ConfRunner\Loader;

use ConfRunner\StepLoader;
use ConfRunner\Process;
use ConfRunner\StepStage;
use ConfRunner\Step;
use ConfRunner\Type\Manual;
use ConfRunner\Type\Exec;

use Symfony\Component\Yaml\Parser;

class Yaml extends StepLoader
{

    public function load($file)
    {
      $yaml = new Parser();
      $data = $yaml->parse(file_get_contents($file));       

      $process = new Process();
      if (array_key_exists('name', $data)) {
        $process->setName($data['name']);
      }
      else {
        $info = \pathinfo($file);
        $process->setName($info['filename']);
      }
      $coreKeys = array('name', 'description');
      foreach ($data as $key=>$value) {
        if (in_array($key, $coreKeys)) {
          continue;
        }
        $stepStage = new StepStage();
        $stepStage->setName($key);

        //
        foreach ($value as $stepKey=>$stepValue) {
          $step = new Step();
          $step->setName($stepKey);
          
          if (is_array($stepValue)) {

            if (array_key_exists('desc', $stepValue)) {
              $step->setDescription($stepValue['desc']);
            }
            $types = $this->getTypes();
            foreach ($types as $availType) {
              if ($availType->supports($stepValue)) {
                $type = $availType;
                break;
              }
            } 
          }
          else {
            $type = new Manual();
          }
          $step->setType($type);

          $stepStage->addStep($step);
        }
        $process->addStage($stepStage);
      }
      return $process;
    }

    private function getTypes() {
      return array(new Exec(), new Manual());
    }
}
