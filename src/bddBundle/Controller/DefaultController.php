<?php

namespace bddBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/yolo/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return $this->render('bddBundle:Default:index.html.twig', array('message' => null, 'name' => $name, 'commentary' => null));
    }
}
