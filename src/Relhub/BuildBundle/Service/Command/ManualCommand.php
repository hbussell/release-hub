<?php


namespace Relhub\BuildBundle\Service\Command;

use Relhub\BuildBundle\Service\CommandInterface;


class ManualCommand implements CommandInterface {

  public function handlesAction($action) {
    return TRUE;
  }


  public function execute($action, $releaseVersion, $options=NULL) {
    
  }

  public function isManualAction() {
    return TRUE;
  }


}


