<?php


namespace Relhub\BuildBundle\Service\Command;

use Relhub\BuildBundle\Service\CommandInterface;


class AnsibleCommand implements CommandInterface {

  public function handlesAction($action) {
    return (strpos($action, 'ansible') === 0);
  }


  public function execute($action, $releaseVersion, $options=NULL) {
    
  }

  public function isManualAction() {
    return FALSE;
  }
}


