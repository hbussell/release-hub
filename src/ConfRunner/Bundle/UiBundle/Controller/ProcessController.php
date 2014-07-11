<?php

namespace ConfRunner\Bundle\UiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ConfRunner\Process;


class ProcessController extends Controller
{
    public function listAction()
    {

      $p = new Process();
      var_dump($p);
      return $this->render(
          'ConfRunnerUiBundle:Process:list.html.twig',
          array('name' => 'test')
      );
    }

    public function createAction()
    {
    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }

}
