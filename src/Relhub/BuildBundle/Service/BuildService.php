<?php


namespace Relhub\BuildBundle\Service;

use Symfony\Component\ClassLoader\UniversalClassLoader;
use Relhub\BuildBundle\Service\Command\HttpCommand;

class BuildService {

  private $commands;

  public function __construct() {
    $this->commands =func_get_args(); 
  }

  public function buildRelease($release, $actions, $stage) {

    foreach ($actions as $action) {
      $action = trim($action);
      foreach ($this->commands as $command) {

        if ($command->handlesAction($action)) {
          if ($command->isManualAction()) {
            break;
          }
        }
      }
    }
    //    $project = $release->getProject();
    //
    //$actions = $release->getActions();
    /*
    $build = Null;// get build
    $pendingActions = array();
    $queuedActions = array();
    $queue = false;
    foreach ($actions as $action) {
      if (strpos($action, 'manual') ===0) {
        $queue = true;
        continue;
      }
      if ($queue) {
        array_push($queuedActions, $action);
      }
      else {
        array_push($pendingActions, $action);
      }
    }

    if (empty($pendingActions)) {
      return;
    }

//    print ' commands :: ' . count($this->commands) . PHP_EOL;
    //   var_dump($this->commands);
    print 'Pending actions:: ' . count($pendingActions) . PHP_EOL;
    var_dump($pendingActions);
    $details = array();
    $passed = TRUE;



    foreach ($pendingActions as $action) {
     
//      exec($action, $output, $retval);
      if ($retval !=0){
        $passed = FALSE;
      }
      $details []= array(
        'action' => $action,
        'output' => $output,
        'retval' => $retval
      );
      if (!$passed) {
        break;
      }
    } */

  }


  public function getCommandForAction($action) {
    $action = trim($action);
    foreach ($this->commands as $command) {
      if ($command->handlesAction($action)) {
        return $command;
      }
    }
  }
}
