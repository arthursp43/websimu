<?php

namespace UsuarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/usuario")
     */
    public function indexAction()
    {
        return $this->render('@Usuario/Default/index.html.twig');
    }

    /**
     * @Route("/login")
     */
    public function loginAction()
    {
        return $this->render('@Usuario/Default/login.html.twig');
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
