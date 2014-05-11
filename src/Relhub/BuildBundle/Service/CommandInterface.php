<?php


namespace Relhub\BuildBundle\Service;

interface CommandInterface {

  public function handlesAction($action);

  public function execute($action, $releaseVersion, $options=null);

  public function isManualAction();
}
