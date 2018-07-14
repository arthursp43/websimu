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
     * @Route("/configuracao/inicio/{warning}",defaults={"warning"=null}, name="configuracao_inicio")
     */
    public function configuracaoInicioAction($warning)
    {
        $txtwarninglogin="";
        $txtwarningsenha="";

        if($warning=="login")
        {
            $txtwarninglogin = 'Combinação inválida';
        }
        if($warning=="senha")
        {
            $txtwarningsenha = 'Combinação inválida';
        }

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

            return $this->render('@Usuario/Configuracao/homepage.html.twig',array(
                'usuario'=>$usuario,
                'warninglogin'=>$txtwarninglogin,
                'warningsenha'=>$txtwarningsenha
            ));
        }
        else
        {


            return $this->redirectToRoute('login', array('warning' => 1));
            //return $this->render('@Usuario/Default/login.html.twig',array('warning'=>$warning));
        }


    }


    /**
     * @Route("/configuracao/login/alterar", name="login_alterar")
     */
    public function alterarLogin()
    {
        $id         = $_POST['idlogin'];
        $loginvelho = $_POST['loginvelho'];
        $novologin  = $_POST['novologin'];
        $cnovologin = $_POST['cnovologin'];

        /* @var UsuarioRepository
         */
        $LoginRepositorio = $this->getDoctrine()->getRepository('UsuarioBundle:Login');

        $login = $LoginRepositorio->find($id);

        if(($login->getLogin() == $loginvelho) and ($novologin==$cnovologin))
        {

            $login->setLogin($novologin);

            $em = $this->getDoctrine()->getManager();
            $em->persist($login);
            $em->flush();
            return $this->render('@Usuario/Default/login.html.twig');

        }else
        {


            $warning = "senha";
            return $this->redirectToRoute('configuracao_inicio',array('warning'=>$warning));
        }
    }

    /**
     * @Route("/configuracao/senha/alterar", name="senha_alterar")
     */
    public function alterarSenha()
    {
        $id         = $_POST['idlogin'];
        $senhavelha = $_POST['senhavelha'];
        $novasenha  = $_POST['novasenha'];
        $cnovasenha = $_POST['cnovasenha'];

        /* @var UsuarioRepository
         */
        $LoginRepositorio = $this->getDoctrine()->getRepository('UsuarioBundle:Login');

        $login = $LoginRepositorio->find($id);

        if(($login->getSenha() == $senhavelha) and ($novasenha==$cnovasenha))
        {

            $login->setSenha($novasenha);

            $em = $this->getDoctrine()->getManager();
            $em->persist($login);
            $em->flush();
            return $this->render('@Usuario/Default/login.html.twig');

        }else
        {

            $warning = "senha";
            return $this->redirectToRoute('configuracao_inicio',array('warning'=>$warning));
        }
    }

    





}
