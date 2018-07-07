<?php

namespace UsuarioBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use UsuarioBundle\Entity\Endereco;
use UsuarioBundle\Entity\Login;
use UsuarioBundle\Entity\Usuario;
use UsuarioBundle\Repository\LoginRepository;
use UsuarioBundle\Repository\UsuarioRepository;


class RecargaController extends Controller
{

    public function manterUsuario($login,$senha)
    {

    }

    /**
     * @Route("/recarga/inicio", name="recarga_inicio")
     */
    public function recargaInicioAction()
    {
        var_dump("RECARGA SERÁ FEITA AQUI");exit;

    }



    





}
