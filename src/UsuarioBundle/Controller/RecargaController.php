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








    /**
     * @Route("/recarga/inicio", name="recarga_inicio")
     */
    public function recargaInicioAction()
    {

        //$request;
        if(isset($_POST['login'])) {
            $login = $_POST['login'];
        }
        else{
            $login = $_COOKIE['login'];
        }
        if(isset($_POST['senha'])) {
            $senha = $_POST['senha'];
        }
        else{
            $senha = $_COOKIE['senha'];
        }

        /* @var UsuarioRepository
         */
        $UsuarioRepository = $this->getDoctrine()->getRepository('UsuarioBundle:Usuario');

        /* @var UsuarioRepository
         */
        $LoginRepositorio = $this->getDoctrine()->getRepository('UsuarioBundle:Login');

        /* @var CartaoRepository
         */
        $CartaoRepository = $this->getDoctrine()->getRepository('UsuarioBundle:Cartao');



        $Login = $LoginRepositorio->buscaLogin($login,$senha);

        //var_dump($log);exit;


        if(count($Login)!=0)
        {
            //$usuario = "a";

            $usuario = $UsuarioRepository->buscaUsuario($Login);


            setcookie('login', $login);
            setcookie('senha', $senha);
            setcookie('usuario', $usuario->getIdusuario()."");

            return $this->render('@Usuario/Recarga/homepage.html.twig',array(
                'usuario'=>$usuario

            ));
        }
        else
        {


            return $this->redirectToRoute('login', array('warning' => 1));
            //return $this->render('@Usuario/Default/login.html.twig',array('warning'=>$warning));
        }


    }

    





}
