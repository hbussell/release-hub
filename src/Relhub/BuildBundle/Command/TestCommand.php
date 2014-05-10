<?php
 
namespace Relhub\BuildBundle\Command;
 
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Parser;

use Relhub\WebBundle\Entity\ReleaseBuild;


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
            $hooks = $project->getPreBuildHooks();
            $stage = $build->getStage();
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
            

            /*foreach (explode(PHP_EOL, $hooks) as $hook) {
              $output->writeLn('Build hook:: ' . $hook);
              foreach ($branches as $branch) {
                $output->writeLn('build branch:: ' . $branch);
              }

        }*/

        }
        

 
        return 0;
    }
}
