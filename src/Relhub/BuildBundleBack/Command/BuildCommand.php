<?php

namespace Relhub\BuildBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
#use Symfony\Component\Console\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Relhub\WebBundle\Entity\ReleaseBuild;

class BuildCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('build:build')
            ->setDescription('Build Releaes')
            ->addArgument(
                'release',
                InputArgument::OPTIONAL,
                'Specify release build'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {


        $name = $input->getArgument('release');
        if ($name) {
            $text = 'Hello '.$name;
        } else {
            $text = 'Hello';
        }

        $em = $this->getContainer()->get('doctrine')->getEntityManager();

        $query = $em->createQuery(
            'SELECT rb
            FROM RelhubWebBundle:ReleaseBuild rb
            where rb.status = :pending
            ORDER BY rb.dueDate'
          )->setParameter('pending', ReleaseBuild::STATUS_PUBLISHED);

        $releases = $query->getResult();
  
        foreach ($releases as $release ) {

            $output->writeln('build :: '. $release);
        }

        $output->writeln($text);
    }
}
