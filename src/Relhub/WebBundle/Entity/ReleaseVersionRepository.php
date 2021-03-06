<?php

namespace Relhub\WebBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TestRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReleaseVersionRepository extends EntityRepository
{

  /*
  private $buildService;
  private $entityManager;
  public function __construct($entityManager, $buildService) {
    $this->entityManager = $entityManager;
    $this->buildService = $buildService;
  }*/



  public function getCommands($id) {

//releaseId


/*    $query = 'select c from RelhubWebBundle:CommandResult c where releaseId = :releaseId';
    $commands = $this->getEntityManager()->createQuery($query)
      ->setParameter('releaseId', $id)
      ->execute()
      ->fetchAll();*/

/*     $query = $this->getEntityManager()->createQuery(
       'select c FROM RelhubWebBundle:CommandResult c where releaseId = :releaseId'
            
          )->setParameter('releaseId', $id);

        $commands = $query->getResult();
 */


    $em = $this->entityManager;
        $query = $em->createQuery(
            'SELECT r
            FROM RelhubWebBundle:CommandResult r
            where r.releaseId = :releaseId
            '
          )->setParameter('releaseId', $id);

        $commands = $query->getResult();



    return $commands;

  }

  public function getReleasesForDisplay() {

    $buildService = $this->buildService;

    $em = $this->entityManager;
    $query = $em->createQuery(
        'SELECT r
        FROM RelhubWebBundle:ReleaseVersion r
        where r.status != :published
        ORDER BY r.project ASC, r.dueDate'
      )->setParameter('published', ReleaseVersion::STATUS_PUBLISHED);

    $releases = $query->getResult();

    $outReleases = array();
    foreach ($releases as $release) {
      $commands = $this->getCommands($release->getId());
      $actionsArray = $release->getActions();
      $outRelease = array('release'=>array('name'=>$release->getName(), 'id'=>$release->getId()));
      $outActions = array();


      foreach ($actionsArray as $stage => $stageActions) {
        if(empty($stageActions))  {
          continue;
        }

        foreach ($stageActions as $action) {
          $actionRender = array('action'=>$action, 'stage'=>$stage, 'command'=>FALSE, 'isApprovable'=>FALSE);
          foreach ($commands as $command) {
            if ($command->getStage() == $stage && $command->getAction() == $action) {
              $actionRender['command'] = array('status'=>$command->getStatus());
              break;
            }
          }

          if (!isset($outActions[$stage]) || !is_array($outActions[$stage])) {
            $outActions[$stage] = array();
          }
          $outActions[$stage][] = $actionRender;            
        }
      }

      $stages = array_keys($outActions);
      foreach ($stages as $stage) {
        $allDone = TRUE;
        $currentStage = $stage;
        foreach ($outActions[$stage] as $action) {
          if (!$action['command'] || !$action['command']->isComplete()) {
            break 2;  // break stages foreach.
          }
        }
      }
      
      $hasApprovable = FALSE;
      $hasBuildable = FALSE;
      foreach ($outActions as $stage=>$actions) {
        foreach ($actions as $key=>$action) {
          if ($stage==$currentStage) {
            var_dump('command for :: ' . $action['action']);
            $command = $buildService->getCommandForAction($action['action']);
            if ($command->isManualAction()) {
              $outActions[$stage][$key]['isApprovable'] = TRUE;
              $hasApprovable = TRUE;
            }
            else {
              $hasBuildable = TRUE;
            }
          } 
        }
      }


      $outRelease['hasApprovable'] = $hasApprovable;
      $outRelease['hasBuildable'] = $hasBuildable;
      $outRelease['actions'] = $outActions;
      $outRelease['stages'] = array_keys($outActions);
      $outRelease['currentStage'] = $currentStage;
      $outReleases []= $outRelease;
    }

    return $outReleases;
  }


  public function getReleasesCurrentStage($release) { 
    $commands = $this->getCommands($release->getId());
    $actionsArray = $release->getActions();    
    $outActions = array();

    foreach ($actionsArray as $stage => $stageActions) {
      if(empty($stageActions))  {
        continue;
      }

      foreach ($stageActions as $action) {
        $actionRender = array('action'=>$action, 'stage'=>$stage, 'command'=>FALSE, 'isApprovable'=>FALSE);
        foreach ($commands as $command) {
          if ($command->getStage() == $stage && $command->getAction() == $action) {
            $actionRender['command'] = array('status'=>$command->getStatus());
            break;
          }
        }

        if (!isset($outActions[$stage]) || !is_array($outActions[$stage])) {
          $outActions[$stage] = array();
        }
        $outActions[$stage][] = $actionRender;            
      }
    }

    $stages = array_keys($outActions);
    foreach ($stages as $stage) {
      $allDone = TRUE;
      $currentStage = $stage;
      foreach ($outActions[$stage] as $action) {
        if (!$action['command'] || !$action['command']->isComplete()) {
          break 2;  // break stages foreach.
        }
      }
    }
    return $currentStage;
  }

}
