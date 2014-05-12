<?php
 
namespace Relhub\BuildBundle\Command;
 
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Parser;

use Relhub\WebBundle\Entity\ReleaseBuild;
use Relhub\WebBundle\Entity\CommandResult;


class TestCommand extends ContainerAwareCommand
{
 
    protected function configure()
    {
        parent::configure();
 
        $this->setName('relhub:build')
             ->setDescription('Build .');
    }
 
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $em = $this->getContainer()->get('doctrine')->getEntityManager();
        $buildService = $this->getContainer()->get('relhub_build.build');
        //      $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
              
        $query = $em->createQuery(
            'SELECT rb
            FROM RelhubWebBundle:ReleaseBuild rb
            where rb.status = :pending
            ORDER BY rb.created'
          )->setParameter('pending', ReleaseBuild::STATUS_PENDING);

        $builds = $query->getResult();
  
        foreach ($builds as $build ) {
            
            $output->writeln('Building release :: '. $build->getReleaseVersion());
            $releaseVersion = $build->getReleaseVersion();
            $branches = $releaseVersion->getBranches();
            $project = $releaseVersion->getProject();
            $stage = $build->getStage();
            $buildActionNames = $build->getActions();
            $user = $build->getUser();
            $stageActions = $releaseVersion->getActionsArray()[$stage];
            $processActions = array();
            foreach ($buildActionNames as $actionName) {
              foreach ($stageActions as $action) {
                if ($action['name'] == $actionName) {
                  $processActions []= $action;
                }
              }
            }
            if (empty($processActions)) {
              continue;
            }
            foreach ($processActions as $action) {
              $this->executeAction($buildService, $action['name'], $stage, $releaseVersion, $user, $action['options']); 
            }
            /*
            $yaml = new Parser();
            $actionResults = array();

            $existing = $yaml->parse($releaseVersion->getActions());
            $actions = $yaml->parse($releaseVersion->getActions());
            $useStage = FALSE;
            foreach ($actions as $actionStage => $actionSteps) {
              if (!$stage) {
                // No current stage so lets use the first stage found.
                $useStage = TRUE;
              }
              else if ($stage == $actionStage) {
                $useStage = TRUE; // Use the next stage.
                continue;
              }

              if ($useStage) {
                // Run this stage;
                print 'run this stage:: ' . $actionStage . PHP_EOL;
               // var_dump($actionSteps);
                $buildService->buildRelease($releaseVersion, $actionSteps, $actionStage);
                break;
              }
            }
            
            */
            /*foreach (explode(PHP_EOL, $hooks) as $hook) {
              $output->writeLn('Build hook:: ' . $hook);
              foreach ($branches as $branch) {
                $output->writeLn('build branch:: ' . $branch);
              }

        }*/
            $build->setDone();
            $build->setFinished(new \DateTime());
            $em->persist($build);
            $em->flush();
        }      

 
        return 0;
    }


    public function executeAction($buildService, $name, $stage, $releaseVersion, $user, $options) {
        $each_branch = FALSE;
        if (!empty($options) && in_array('each branch', $options)) {
          $each_branch = TRUE;              
        }

        $em = $this->getContainer()->get('doctrine')->getEntityManager();
        $command = $buildService->getCommandForAction($name);

  /*      $pendingResult = $em->getRepository('RelhubWebBundle:CommandResult')->find(array(
          'action'=>$name, 
          'stage'=>$stage,
          'releaseId'=>$releaseVersion->getId()
        ));

   */
//        var_dumP($name);
  //      var_dump($stage);
    //    var_dump($releaseVersion->getId());
        $pendingResult = $em->createQuery('SELECT c FROM RelhubWebBundle:CommandResult c WHERE c.action = :action and c.stage = :stage and c.releaseId = :releaseId and c.status = :status')
           ->setParameter('action', $name)
           ->setParameter('stage', $stage)
           ->setParameter('releaseId', $releaseVersion->getId())
           ->setParameter('status', CommandResult::STATUS_PENDING)
           ->getSingleResult();
//           ->getSingleResult();

        $result = $command->execute($name, $stage, $releaseVersion, $user, $options);
     
        if ($result) {
          $result->setCreated(new \DateTime());
          $result->setUser($user);

          if ($pendingResult) {
            $pendingResult->setOutput($result->getOutput());
            $pendingResult->setStatus($result->getStatus());
            $em->persist($pendingResult);
            $em->flush();
          }
          else {
            $em->persist($result);
            $em->flush();
          }
        }

    }
}
