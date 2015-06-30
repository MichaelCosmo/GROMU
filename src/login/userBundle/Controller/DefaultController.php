<?php

namespace login\userBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/login/{name}")
     * @Template()
     */
    public function IndexAction($name)
    {
        return array('name' => $name);
    }
}
