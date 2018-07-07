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


class ConfiguracaoController extends Controller
{

    public function manterUsuario($login,$senha)
    {

    }

    /**
     * @Route("/configuracao/inicio", name="configuracao_inicio")
     */
    public function configuracaoInicioAction()
    {
        var_dump("CONFIGURACAO SERÁ FEITA AQUI");exit;

    }

    





}
