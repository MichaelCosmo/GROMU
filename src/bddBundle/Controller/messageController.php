<?php

namespace bddBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class messageController extends Controller
{
    /**
     * @Route("/bdd/{name}")
     * @Template()
     */

    public function messageAction($name)
    {
        $messageClass = $this->getDoctrine()
            ->getRepository('bddBundle:messageClass')
            ->findAll();

        if (!$messageClass) {
            throw $this->createNotFoundException(
                'error, no messages found'
            );
        }
        return $this->render('bddBundle:Default:index.html.twig', array('message' => $messageClass, 'name' => $name));
    }
}
