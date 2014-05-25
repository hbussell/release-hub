<?php

namespace ConfRunner\Bundle\UiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ConfRunnerUiBundle:Default:index.html.twig', array('name' => $name));
    }
}
