<?php


namespace Relhub\BuildBundle\Service;

class Checkout {


  private $rootDir;

  public function __construct($rootDir) {
    $this->rootDir = $rootDir;
  }

  public function checkoutProject($project) {
    print 'checking out project :: ' . $project->getName() . PHP_EOL;
    $options = $project->getOptionsArray();
    if (!array_key_exists('gitUrl', $options)) {
      throw new \Exception('Please define option: gitUrl in your project');
    }
    $gitUrl = $options['gitUrl'];
    $name = $project->getName();
    $projectsPath = $this->rootDir . '/projects';
    $checkoutPath = $projectsPath. '/' . $name;
    if (!is_dir($projectsPath)) {
      if(!mkdir($porject)) {
        throw new \Exception('Could not create projects path: ' . $projectsPath . ' - Please ensure directory is writeable');
      }
    }
    if (!is_dir($checkoutPath)) {
      if(!mkdir($checkoutPath)) {
        throw new \Exception('Could not create checkout path: ' . $checkoutPath . ' - Please ensure directory is writeable');
      }
    }
    if (!is_dir($checkoutPath . '/.git')) {
      $cmd = 'git clone ' . $gitUrl . ' '. $checkoutPath;
      exec($cmd, $output, $retVal);
      if ($retVal !=0) {
        throw new \Exception('Could not clone project into ' . $checkoutPath .' - ' . implode(PHP_EOL, $output));
      }
    }

    return $checkoutPath; 
  }


}

