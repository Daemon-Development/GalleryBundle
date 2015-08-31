<?php

namespace Daemon\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DaemonGalleryBundle:Default:index.html.twig', array('name' => $name));
    }
}
