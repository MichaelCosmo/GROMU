<?php

namespace bddBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use bddBundle\Entity;
use Symfony\Component\HttpFoundation\Session\Session;

class messageController extends Controller
{
    /**
     * @Route("/mess")
     * @Template()
     */

    public function messageAction()
    {
       $session = new Session();
        $messageClass = $this->getDoctrine()
            ->getRepository('bddBundle:messageClass')
            ->findAll();

        if (!$messageClass) {
            throw $this->createNotFoundException(
                'error, no messages found'
            );
        }
        return $this->render('bddBundle:Default:message.html.twig', array('message' => $messageClass, 'name' => $session->get('name'), 'commentary' => null, 'user' => null));
    }


    /**
     * @Route("/com/{id}")
     * @Template()
     */
    public function commentAction($id)
    {
        $session = new Session();
        $commentaryClass = $this->getDoctrine()->getManager();
        $repository = $commentaryClass->getRepository('bddBundle:commentaryClass');
        $query = $repository->createQueryBuilder('cc')
            ->where('cc.messageId = :id')
            ->setParameter('id', $id)
            ->getQuery();
        $result=$query->getResult();

        if (!$commentaryClass) {
            throw $this->createNotFoundException(
                'error, no messages found'
            );
        }

        return $this->render('bddBundle:Default:comment.html.twig',
            array('commentary' => $result,
                'name' => $session->get('name'),
                'id' => $id,
                'message' => null));
    }
}
