<?php

namespace bddBundle\Controller;

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
            $log= new Entity\userClass();
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
                }
            }
            else{
                $em1 = $this->getDoctrine()->getManager();
                $em1->persist($log);
                $em1->flush();
                $name=$mail;
                $session->set('name', $mail);
                $session->get('name');
            }
        }
        if(isset($_POST['newMessage'])){
            $nM=$_POST['newMess'];
            $title = new Entity\messageClass();
            $title->setName($nM);


            $em = $this->getDoctrine()->getManager();
            $em->persist($title);
            $em->flush();

            //   return $this->render('bddBundle:Default:index.html.twig', array('name' => $name));
        }
        return $this->render('bddBundle:Default:index.html.twig', array('message' => null, 'name' => $session->get('name'), 'commentary' => null));
    }
}
