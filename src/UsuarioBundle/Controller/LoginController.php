<?php

namespace UsuarioBundle\Controller;

use App\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class LoginController extends Controller
{


    /**
     * @Route("/novo-usuario", name="novo_usuario")
     *
     */
    public function registrarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        



        $usuario = new Usuario();



    }
}
