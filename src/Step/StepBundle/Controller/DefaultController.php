<?php

namespace Step\StepBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('StepStepBundle:Default:index.html.twig', array('name' => $name));
    }
}
