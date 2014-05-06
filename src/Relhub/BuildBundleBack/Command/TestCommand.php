<?php
 
namespace Relhub\BuildBundle\Command;
 
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
 
class TestCommand extends ContainerAwareCommand
{
 
    protected function configure()
    {
        parent::configure();
 
        $this->setName('sj:test')
             ->setDescription('Sends the day\'s sexts to everyone.');
    }
 
    protected function execute(InputInterface $input, OutputInterface $output)
    {
 
         $ph = $this->getContainer()->get('doctrine')
                    ->getRepository("SextDejourBundle:Phonenumber")
                    ->createQueryBuilder("u")
                    ->getQuery()
                    ->getResult();
 
         $msg = $this->getContainer()->get('doctrine')
                    ->getRepository("SextDejourBundle:Message")
                    ->createQueryBuilder("u")
                    ->where("u.is_used = false")
                    ->setMaxResults(1)
                    ->getQuery()
                    ->getResult();
         $msg = array_pop( $msg );
 
         $msg->setIsUsed( true );
         // $this->getContainer()->get('doctrine')->getEntityManager()->flush();
 
         $accountId = $this->getContainer()->getParameter("twilio_app_id");
         $authToken = $this->getContainer()->getParameter("twilio_token");
         $myNumber = $this->getContainer()->getParameter("twilio_number");
 
         $client = new \Services_Twilio($accountId, $authToken);
 
         foreach( $ph as $p ){
 
           $sms = $p->getGender() == 0 ? $msg->getGuyText() : $msg->getGirlText();
 
           $res = $client->account->sms_messages->create ( $myNumber, $p->getPhoneNumber(), $sms );
 
           $output->writeln( $p->getPhoneNumber() . " => " . $sms );
 
         }
 
         return 0;
    }
}
