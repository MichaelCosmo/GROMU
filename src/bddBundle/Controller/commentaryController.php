<?php

namespace bddBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class commentaryController extends Controller
{
    /**
     * @Route("/com")
     * @Template()
     */

    public function commentaryAction()
    {

        $commentaryClass = $this->getDoctrine()
            ->getRepository('bddBundle:commentaryClass')
            ->findAll();

        if (!$commentaryClass) {
            throw $this->createNotFoundException(
                'error, no messages found'
            );
        }
        return $this->render('bddBundle:Default:commentary.html.twig', array('commentary' => $commentaryClass, 'name' => null, 'message' => null));
    }
}
