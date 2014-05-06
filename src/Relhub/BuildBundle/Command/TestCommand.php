<?php
 
namespace Relhub\BuildBundle\Command;
 
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

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
            foreach (explode(PHP_EOL, $hooks) as $hook) {
              $output->writeLn('Build hook:: ' . $hook);
              foreach ($branches as $branch) {
                $output->writeLn('build branch:: ' . $branch);
              }

            }

        }
        

 
        return 0;
    }
}
