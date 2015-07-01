<?php

namespace bddBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class messageController extends Controller
{
    /**
     * @Route("/mess")
     * @Template()
     */

    public function messageAction()
    {
       
        $messageClass = $this->getDoctrine()
            ->getRepository('bddBundle:messageClass')
            ->findAll();

        if (!$messageClass) {
            throw $this->createNotFoundException(
                'error, no messages found'
            );
        }
        return $this->render('bddBundle:Default:message.html.twig', array('message' => $messageClass, 'name' => null, 'commentary' => null));
    }
}
