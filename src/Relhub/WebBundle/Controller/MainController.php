<?php

namespace Relhub\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Relhub\WebBundle\Entity\Project;
use Relhub\WebBundle\Entity\ReleaseVersion;
use Relhub\WebBundle\Entity\ReleaseBuild;
use Relhub\WebBundle\Form\ProjectType;
use Relhub\WebBundle\Form\ReleaseVersionType;
use Relhub\WebBundle\Form\ReleaseBuildType;




class MainController extends Controller
{
    public function indexAction()
    {
        return $this->render('RelhubWebBundle:Main:index.html.twig');
    }

    public function listProjectsAction()
    {
        $projects = $this->getDoctrine()->getManager()->getRepository('RelhubWebBundle:Project')->findAll();
        return $this->render('RelhubWebBundle:Main:listProjects.html.twig', 
          array('projects' => $projects)
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

      return $this->render('RelhubWebBundle:Main:createProject.html.twig', 
        array('form' => $form->createView())
      );
    }

    public function listReleasesAction()
    {

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT r
            FROM RelhubWebBundle:ReleaseVersion r
            where r.status != :published
            ORDER BY r.project ASC, r.dueDate'
          )->setParameter('published', ReleaseVersion::STATUS_PUBLISHED);

        $releases = $query->getResult();
#        $releases = $this->getDoctrine()->getManager()->getRepository('RelhubWebBundle:ReleaseVersion')->findAllOrderedByStatus();
        return $this->render('RelhubWebBundle:Main:listReleases.html.twig', 
          array('releases' => $releases)
        );
    }



    public function createReleaseAction(Request $request, $project)
    {    
      $release = new ReleaseVersion();
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

      return $this->render('RelhubWebBundle:Main:createRelease.html.twig', 
        array('form' => $form->createView())
      );

    }

    public function buildReleaseAction(Request $request, $release)
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

      return $this->render('RelhubWebBundle:Main:buildRelease.html.twig', 
        array(
          'form' => $form->createView(),
          'release' => $release
        )
      );

    }




}
