<?php


namespace Relhub\BuildBundle\Service;

interface CommandInterface {

  public function handlesAction($action);

  public function execute($action);

  public function isManualAction();
}
