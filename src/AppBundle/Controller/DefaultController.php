<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->redirectToRoute('fos_user_registration_register');
    }

    /**
     * @Route("/cgu", name="cgu")
     */
    public function cguAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('cgu.html.twig');    }
}
