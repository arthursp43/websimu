<?php

namespace UsuarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/homepage", name="homepage")
     */
    public function homepageAction()
    {
        return $this->render('@Usuario/Default/homepage.html.twig');
    }

    /**
     * @Route("/minha-conta", name="minha_conta")
     */
    public function minhaContaAction()
    {
        return $this->render('@Usuario/Default/homepage1.html.twig');
    }

    

    /**
     * @Route("/registrar", name="registrar")
     *
     */
    public function registrarAction()
    {
        return $this->render('@Usuario/Default/registrar.html.twig');
    }
}
