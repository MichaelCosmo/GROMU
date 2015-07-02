<?php

namespace bddBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use bddBundle\Entity;

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
        return $this->render('bddBundle:Default:message.html.twig', array('message' => $messageClass, 'name' => null, 'commentary' => null, 'user' => null));
    }


    /**
     * @Route("/com/{id}")
     * @Template()
     */
    public function commentAction($id)
    {
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
                'name' => null,
                'id' => $id,
                'message' => null));
    }
}
