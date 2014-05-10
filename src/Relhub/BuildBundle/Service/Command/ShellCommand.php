<?php


namespace Relhub\BuildBundle\Service\Command;

use Relhub\BuildBundle\Service\CommandInterface;


class ShellCommand implements CommandInterface {

  public function handlesAction($action) {
    $parts = explode(' ', $action);
    $cmd = $parts[0];
    if (strpos($cmd, '.sh') == strlen($cmd) - 3) {
      return TRUE;
    }
   /* exec('which '. $cmd, $output, $retval);
    if ($retval == 0) {
      return TRUE;
    }*/
  }


  public function execute($action) {
    
  }

  public function isManualAction() {
    return FALSE;
  }

}


