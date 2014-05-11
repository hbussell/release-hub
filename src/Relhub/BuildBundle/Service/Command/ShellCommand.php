<?php


namespace Relhub\BuildBundle\Service\Command;

use Relhub\BuildBundle\Service\CommandInterface;
use Relhub\WebBundle\Entity\CommandResult;


class ShellCommand {

  private $twig;
  private $checkout;

  public function __construct( $twig, $checkout) {
    $this->twig = $twig;
    $this->checkout = $checkout;
  }

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


  public function execute($action, $stage, $releaseVersion, $user, $options=NULL) {

    $data = $releaseVersion->getOptionsArray();
    $checkoutDir = $this->checkout->checkoutProject($releaseVersion->getProject());
    $data['action'] = $action;
    $data['checkout'] = $checkoutDir;

    $twig = $this->twig;
    foreach ($data as $key=>$value){
      try {
        $old = $twig->getLoader(); 
        $twig->setLoader(new \Twig_Loader_String()); 
        $value = $twig->render($value, $data); 
        $twig->setLoader($old); 
        $data[$key] = $value;
      }
      catch(\Exception $e) {

      }
    }

    $result = new CommandResult();
    $result->setAction($action);
    $result->setStage($stage);
    $result->setUser($user);
    $result->setReleaseId($releaseVersion->getId());

    print 'action options:: ' . PHP_EOL;
    var_dump($options);
    if (!empty($options) && in_array('each branch', $options)) {
      
      $branches = $releaseVersion->getBranches();
      $allBranchOutput = array();
      foreach ($branches as $branch) {

        $old = $twig->getLoader(); 
        $data['branch'] = $branch;
        $twig->setLoader(new \Twig_Loader_String()); 
        $actionRender = $twig->render($action, $data); 
        $twig->setLoader($old); 

        print 'Running shell command::: ' . $actionRender . PHP_EOL;
        exec($actionRender . ' 2>&1', $output, $retVal);

        $allBranchOutput = array_merge($allBranchOutput, $output);

        print 'all branch output:::::: ' . PHP_EOL;
        var_dump($allBranchOutput);
        $result->setOutput(implode(PHP_EOL, $allBranchOutput));

        if ($retVal != 0) {
          $result->setFailed();
          return $result;
        }
        $result->setSuccessful();
      }
      return $result;
    }
    else {

      print 'Running shell command (without render)::: ' . $action . PHP_EOL;
      $old = $twig->getLoader(); 
      $twig->setLoader(new \Twig_Loader_String()); 
      $actionRender = $twig->render($action, $data); 
      $twig->setLoader($old); 
      exec($actionRender . ' 2>&1', $output, $retVal);
      $result->setOutput(implode(PHP_EOL, $output));

      if ($retVal != 0) {
        $result->setFailed();
        return $result;
      }
      $result->setSuccessful();
      return $result;
    }

  }

  public function isManualAction() {
    return FALSE;
  }

}


