<?php

namespace Relhub\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Relhub\WebBundle\Entity\Project;
use Relhub\WebBundle\Entity\ReleaseVersion;
use Relhub\WebBundle\Entity\ReleaseBuild;
use Relhub\WebBundle\Entity\CommandResult;

use Relhub\WebBundle\Form\ProjectType;
use Relhub\WebBundle\Form\ReleaseVersionType;
use Relhub\WebBundle\Form\ReleaseBuildType;




class MainController extends Controller
{
    public function indexAction()
    {
        return $this->listReleasesAction();
//        return $this->render('RelhubWebBundle:Main:index.html.twig');
    }

    public function listProjectsAction()
    {
        $projects = $this->getDoctrine()->getManager()->getRepository('RelhubWebBundle:Project')->findAll();
        $data = array('projects' => $projects);
        return $this->render('RelhubWebBundle:Main:listProjects.html.twig', 
          array_merge($data, $this->getCommonData())
        );
    }

    public function createProjectAction(Request $request)
    {

      $project = new Project();
      $form = $this->createForm(new ProjectType(), $project);
      $form->handleRequest($request);
      if ($form->isValid() ) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($project);
        $em->flush();

        $this->get('session')->getFlashBag()->set('success', 'Project Created');
        return $this->redirect($this->generateUrl('relhub_web_projects'));

      }

      $data = array('form' => $form->createView());
      return $this->render('RelhubWebBundle:Main:createProject.html.twig', 
        array_merge($data, $this->getCommonData())
      );
    }

    public function editProjectAction(Request $request, $project)
    {
      $em = $this->getDoctrine()->getManager();
      $project = $em->getRepository('RelhubWebBundle:Project')->find($project);


      $form = $this->createForm(new ProjectType(), $project);
      $form->handleRequest($request);
      if ($form->isValid() ) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($project);
        $em->flush();

        $this->get('session')->getFlashBag()->set('success', 'Project Updated');
        return $this->redirect($this->generateUrl('relhub_web_projects'));

      }

      $data = array('form' => $form->createView(), 'project'=> $project);
      return $this->render('RelhubWebBundle:Main:editProject.html.twig', 
        array_merge($data, $this->getCommonData())
      );
    }



    public function listReleasesAction()
    {

/*      $releases = $this->getDoctrine()
            ->getRepository('RelhubWebBundle:ReleaseVersion')
            ->getReleasesForDisplay();*/

      $rep = $this->get('relhub_web.release_version');
      $releases = $rep->getReleasesForDisplay();
      $data = array(
          'releases' => $releases,
        );
      return $this->render('RelhubWebBundle:Main:listReleases.html.twig', 
        array_merge($data, $this->getCommonData())
      );

    }

    public function listProjectReleasesAction($project)
    {

      $em = $this->getDoctrine()->getManager();
      $project = $em->getRepository('RelhubWebBundle:Project')->findByName($project);
      $rep = $this->get('relhub_web.release_version');
      $releases = $rep->getReleasesForDisplay($project);
      $data = array(
          'releases' => $releases,
        );
      return $this->render('RelhubWebBundle:Main:listReleases.html.twig', 
        array_merge($data, $this->getCommonData())
      );

    }

    public function createReleaseAction(Request $request, $project)
    {    
      $release = new ReleaseVersion();
      $em = $this->getDoctrine()->getManager();
      $project = $em->getRepository('RelhubWebBundle:Project')->find($project);

      $release->setActions($project->getActions());
      $release->setOptions($project->getOptions());
      $form = $this->createForm(new ReleaseVersionType(), $release);
      $form->handleRequest($request);
      if ($form->isValid() ) {
        $em = $this->getDoctrine()->getManager();
        $release->setCreated(new \DateTime());
        $release->setStatus(ReleaseVersion::STATUS_PENDING);
        $em->persist($release);
        $em->flush();

        $this->get('session')->getFlashBag()->set('success', 'Release Created');
        return $this->redirect($this->generateUrl('relhub_web_projects'));
      }
      $data = array('form' => $form->createView());
      return $this->render('RelhubWebBundle:Main:createRelease.html.twig', 
        array_merge($data, $this->getCommonData())
      );
    }

    public function editReleaseAction(Request $request, $release)
    {    
      $em = $this->getDoctrine()->getManager();
      $release = $em->getRepository('RelhubWebBundle:ReleaseVersion')->find($release);


      //$release->setActions($project->getActions());
      $form = $this->createForm(new ReleaseVersionType(), $release);
      $form->handleRequest($request);
      if ($form->isValid() ) {
        $em = $this->getDoctrine()->getManager();
//        $release->setCreated(new \DateTime());
//        $release->setStatus(ReleaseVersion::STATUS_PENDING);
        $em->persist($release);
        $em->flush();

        $this->get('session')->getFlashBag()->set('success', 'Release Updated');
        return $this->redirect($this->generateUrl('relhub_web_releases'));
      }

      $data = array(
          'form' => $form->createView(),
          'release' => $release
        );

      return $this->render('RelhubWebBundle:Main:editRelease.html.twig', 
        array_merge($data, $this->getCommonData())
      );
    }



    public function buildReleaseStageAction(Request $request, $release, $stage)
    {    

      $em = $this->getDoctrine()->getManager();
      $release = $em->getRepository('RelhubWebBundle:ReleaseVersion')->find($release);

      $releaseVersion = $this->get('relhub_web.release_version');
      $currentVersion = $releaseVersion->getReleasesCurrentStage($release);
      if ($currentVersion != $stage) {
        throw $this->createNotFoundException('Release stage not valid');
      }

      $actions = $releaseVersion->getBuildableActionsForStage($release, $stage);
      
     

      $build = new ReleaseBuild();
      $build->setActions($actions);
      $build->setStage($stage);
      $form = $this->createForm(new ReleaseBuildType(), $build);
      $form->handleRequest($request);
      if ($form->isValid() ) {
        $user = $this->get('security.context')->getToken()->getUser();
        $build->setCreated(new \DateTime());
        $build->setStatus(ReleaseBuild::STATUS_PENDING);
        $build->setReleaseVersion($release);
        $build->setUser($user);
        $em->persist($build);

        foreach ($actions as $action) { 
          $commandResult = new CommandResult();
          $commandResult->setAction($action);
          $commandResult->setStage($stage);
          $commandResult->setReleaseId($release->getId());
          $commandResult->setUser($user);
          $commandResult->setCreated(new \DateTime());
          $em->persist($commandResult);
        }
        $em->flush();
        $this->get('session')->getFlashBag()->set('success', 'Release Build Created');
        return $this->redirect($this->generateUrl('relhub_web_releases'));
      }

      return $this->render('RelhubWebBundle:Main:buildRelease.html.twig', 
        array(
          'form' => $form->createView(),
          'release' => $release,
          'actions' => $actions
        )
      );

    }

    public function approveReleaseStageAction(Request $request, $release, $stage)
    {    
      $em = $this->getDoctrine()->getManager();
      $release = $em->getRepository('RelhubWebBundle:ReleaseVersion')->find($release);

      $approveActions = $request->get('action');
      $releaseVersion = $this->get('relhub_web.release_version');

      $currentVersion = $releaseVersion->getReleasesCurrentStage($release);
      if ($currentVersion != $stage) {
        throw $this->createNotFoundException('Release stage not valid');
      }

      if (empty($approveActions)) {
        throw $this->createNotFoundException('Actions to approve must be given');
      }

      $build = new ReleaseBuild();      
      $form = $this->createForm(new ReleaseBuildType(), $build);
      $form->handleRequest($request);
      var_dump('form valid:: ');
      var_dump($form->isValid());
      if ($form->isValid() ) {

        $user = $this->get('security.context')->getToken()->getUser();
        var_dump($user);
        /*$build->setCreated(new \DateTime());
        $build->setStatus(ReleaseBuild::STATUS_PENDING);
        $build->setReleaseVersion($release);
        $build->setUser($user);
        $em->persist($build);
        $em->flush();*/

        $em = $this->getDoctrine()->getManager();
        foreach ($approveActions as $action) {
          $command = new CommandResult(); 
          $command->setAction($action);
          $command->setStage($stage);
          $command->setReleaseId($release->getId());
          $command->setUser($user);
          $command->setApproved();
          $command->setCreated(new \DateTime());

          $em->persist($command);
        }

        $em->flush();
        $this->get('session')->getFlashBag()->set('success', 'Release Actions Approved');
        return $this->redirect($this->generateUrl('relhub_web_releases'));
      }

      return $this->render('RelhubWebBundle:Main:approveReleaseStage.html.twig', 
        array(
          'stage' => $stage,
          'form' => $form->createView(),
          'release' => $release,
          'actions' => $approveActions
        )
      );

    }



    public function publishReleaseAction(Request $request, $release)
    {    

      $em = $this->getDoctrine()->getManager();
      $release = $em->getRepository('RelhubWebBundle:ReleaseVersion')->find($release);

      $build = new ReleaseBuild();
      $form = $this->createForm(new ReleaseBuildType(), $build);
      $form->handleRequest($request);
      if ($form->isValid() ) {
        $user = $this->get('security.context')->getToken()->getUser();
        $build->setCreated(new \DateTime());
        $build->setStatus(ReleaseBuild::STATUS_PENDING);
        $build->setReleaseVersion($release);
        $build->setUser($user);
        $em->persist($build);
        $em->flush();
        $this->get('session')->getFlashBag()->set('success', 'Release Build Created');
        return $this->redirect($this->generateUrl('relhub_web_releases'));
      }

      return $this->render('RelhubWebBundle:Main:publishRelease.html.twig', 
        array(
          'form' => $form->createView(),
          'release' => $release
        )
      );

    }

    public function commandRemoveAction(Request $request, $command)
    {    

      $em = $this->getDoctrine()->getManager();
      $command = $em->getRepository('RelhubWebBundle:CommandResult')->find($command);
      $em->remove($command);
      $em->flush();
      $this->get('session')->getFlashBag()->set('success', 'Command Removed');
      return $this->redirect($this->generateUrl('relhub_web_releases'));

    }

    public function getCommonData() {
      $em = $this->getDoctrine()->getManager();
      $projects = $em->getRepository('RelhubWebBundle:Project')->findAll();
      $releases = $em->getRepository('RelhubWebBundle:ReleaseVersion')->findAll();
      $data = array(
        'all_projects'=>$projects,
        'all_releases'=>$releases
      );
      return $data;

    }
}
