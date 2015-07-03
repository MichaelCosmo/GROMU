<?php

namespace bddBundle\Controller;

use bddBundle\Entity\commentaryClass;
use bddBundle\Entity\userClass;
use bddBundle\Entity\messageClass;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    /**
     * @Route("/yolo/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        $session = new Session();
        $session->start();
        if($session->get('name') =='') {
            $name = 'anonyme';
            $session->set('name', $name);
        }



        if(isset($_POST['log'])){

            $mail=$_POST['mail'];
            $pwd=$_POST['password'];
            $log= new userClass();
            $log->setLogin($mail);
            $log->setPassword($pwd);

            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('bddBundle:userClass');
            $bool=true;
            $query = $repository->createQueryBuilder('uc')
                ->where('uc.login = :log')
                ->setParameter('log', $mail)
                ->getQuery();

            $product=$query->getResult();


            if($product){
                $repository = $em->getRepository('bddBundle:userClass');
                $query = $repository->createQueryBuilder('uc')
                    ->where('uc.login = :log')
                    ->andWhere('uc.password = :pass')
                    ->setParameters(array('log'=> $mail, 'pass' =>$pwd))
                    ->getQuery();
                $products=$query->getResult();
                if($products){
                    $name=$mail;
                    $session->set('name', $mail);
                    $session->get('name');
                    $session->set('password',$pwd);
                }
            }
            else{
                $em1 = $this->getDoctrine()->getManager();
                $em1->persist($log);
                $em1->flush();
                $name=$mail;
                $session->set('name', $mail);
                $session->get('name');
                $session->set('pwd',$pwd);
            }
        }
        if(isset($_POST['newMessage'])){
            $nM=$_POST['newMess'];
            $title = new messageClass();
            $title->setName($nM);


            $em = $this->getDoctrine()->getManager();
            $em->persist($title);
            $em->flush();

            //   return $this->render('bddBundle:Default:index.html.twig', array('name' => $name));
        }
        if(isset($_GET['newComment'])){
            $reply=$_GET['newComment'];
            $login=$_GET['loginUp'];
            $idMess=$_GET['idMessage'];
            $textPrec=$_GET['text'];

            $pm = $this->getDoctrine()->getManager();
            $repository = $pm->getRepository('bddBundle:messageClass');
            $query = $repository->createQueryBuilder('mc')
                ->where('mc.id = :id')
                ->setParameter('id',$idMess)
                ->getQuery();
            $products=$query->getResult();
            $msg= $products[0];
            $reposi = $pm->getRepository('bddBundle:userClass');
            $query = $reposi->createQueryBuilder('uuc')
                ->where('uuc.login = :log')
                ->setParameter('log',$login)
                ->getQuery();
            $users=$query->getResult();
            $user= $users[0];

            $comment= new commentaryClass();
            $comment->setText($reply);
            $comment->setUserLogin($user);
            $comment->setMessageId($msg);
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('bddBundle:commentaryClass');
            $bool=true;
            $query = $repository->createQueryBuilder('cc')
                ->where('cc.text = :text')
                ->setParameter('text', $textPrec)
                ->getQuery();

            $product=$query->getResult();$newCom=$product[0];
            $newCom->setText($reply);
            $em->flush();
        }
        if(isset($_POST['reply'])){

            $reply=$_POST['reply'];
            $login=$_POST['nameActu'];
            $idMess=$_POST['idMess'];

            $pm = $this->getDoctrine()->getManager();
            $repository = $pm->getRepository('bddBundle:messageClass');
            $query = $repository->createQueryBuilder('mc')
                ->where('mc.id = :id')
                ->setParameter('id',$idMess)
                ->getQuery();
            $products=$query->getResult();
            $msg= $products[0];
            $reposi = $pm->getRepository('bddBundle:userClass');
            $query = $reposi->createQueryBuilder('uuc')
                ->where('uuc.login = :log')
                ->setParameter('log',$login)
                ->getQuery();
            $users=$query->getResult();
            $user= $users[0];

            $comment= new commentaryClass();
            $comment->setText($reply);
            $comment->setUserLogin($user);
            $comment->setMessageId($msg);

         $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
        }
        return $this->render('bddBundle:Default:index.html.twig', array('message' => null, 'name' => $session->get('name'), 'commentary' => null));
    }
}
