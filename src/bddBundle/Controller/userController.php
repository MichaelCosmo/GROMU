<?php

namespace bddBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class userController extends Controller
{
    /**
     * @Route("/users")
     * @Template()
     */

    public function userAction()
    {

        $userClass = $this->getDoctrine()
            ->getRepository('bddBundle:userClass')
            ->findAll();

        if (!$userClass) {
            throw $this->createNotFoundException(
                'error, no messages found'
            );
        }
        return $this->render('bddBundle:Default:user.html.twig', array('user' => $userClass));
    }
}
