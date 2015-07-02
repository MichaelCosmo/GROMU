<?php

namespace bddBundle\Controller;

use Proxies\__CG__\bddBundle\Entity\userClass;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class commentaryController extends Controller
{
    /**
     * @Route("/osef")
     * @Template()
     */
    public function indexAction()
    {
        $commentaryClass = $this->getDoctrine()
            ->getRepository('bddBundle:commentaryClass');


        if (!$commentaryClass) {
            throw $this->createNotFoundException(
                'error, no messages found'
            );
        }

        //var_dump($commentaryClass);

        return array('commentary' => $commentaryClass, 'name' => null, 'message' => null);
    }

}
