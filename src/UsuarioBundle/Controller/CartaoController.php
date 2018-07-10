<?php

namespace UsuarioBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use UsuarioBundle\Entity\Cartao;
use UsuarioBundle\Entity\Endereco;
use UsuarioBundle\Entity\Login;
use UsuarioBundle\Entity\Usuario;
use UsuarioBundle\Repository\LoginRepository;
use UsuarioBundle\Repository\UsuarioRepository;


class CartaoController extends Controller
{

    public function manterUsuario($login,$senha)
    {

    }

    /**
     * @Route("/cartao/novo", name="cartao_novo")
     */
    public function novoCartaoAction()
    {
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        //$login=$request->request->get('login');
        //$senha=$request->request->get('senha');

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

        $usuario = $UsuarioRepository->buscaUsuario($Login);






        return $this->render('@Usuario/Cartao/novoCartao.html.twig',array('usuario'=>$usuario));

    }

    /**
     * @Route("/cartao/registrar", name="cartao_registrar")
     */
    public function registrarCartaoAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
//        $login = $_POST['login'];
//        $senha = $_POST['senha'];
        $login=$request->request->get('login');
        $senha=$request->request->get('senha');
        $titular=$request->request->get('titular');
        $validade=$request->request->get('validade');
        $tipo=$request->request->get('tipo');


        //var_dump($tipo);exit;

        /* @var UsuarioRepository
         */
        $UsuarioRepository = $this->getDoctrine()->getRepository('UsuarioBundle:Usuario');

        /* @var UsuarioRepository
         */
        $LoginRepositorio = $this->getDoctrine()->getRepository('UsuarioBundle:Login');





        $Login = $LoginRepositorio->buscaLogin($login,$senha);

        $usuario = $UsuarioRepository->buscaUsuario($Login);

        $numeroCartao="";
        for ($x = 0; $x <= 15; $x++) {
            if ($x==4 OR $x==8 OR $x==12)
            {
                $numeroCartao=$numeroCartao." ";
            }
            $numeroCartao=$numeroCartao.rand(1,9)."";

        }

        /* @var Cartao
         */
        $cartao = new Cartao();

        $cartao->setIdusuario($usuario);
        $cartao->setNumerocartao($numeroCartao);
        $cartao->setSaldo(0);

        $cartao->setTitular($titular);
        $cartao->setValidade($validade);
        $cartao->setTipo($tipo);
        $cartao->setStatus("Solicitado - Aguardando Envio");


        //var_dump($usuario);exit;
        $em->persist($cartao);
        $em->flush();


        return $this->redirectToRoute('inicio' );
        //return new JsonResponse(array(json_encode($login),json_encode($senha)),200);






    }


    /**
     * @Route("/cartao/chegou/{id}", name="cartao_chegou")
     */
    public function chegouCartaoAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        /* @var CartaoRepository
         */
        $CartaoRepository = $this->getDoctrine()->getRepository('UsuarioBundle:Cartao');

        $cartao = $CartaoRepository->buscaCartao($id);

        $cartao->setStatus('Ativo');

        $em->persist($cartao);
        $em->flush();

        return $this->redirectToRoute('inicio' );

    }

    /**
     * @Route("/cartao/cancelar/{id}", name="cartao_cancelar")
     */
    public function cancelarCartaoAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        /* @var CartaoRepository
         */
        $CartaoRepository = $this->getDoctrine()->getRepository('UsuarioBundle:Cartao');

        $cartao = $CartaoRepository->buscaCartao($id);

        $cartao->setStatus('Cancelado');

        $em->persist($cartao);
        $em->flush();

        return $this->redirectToRoute('inicio' );

    }

    /**
     * @Route("/cartao/bloquear/{id}", name="cartao_bloquear")
     */
    public function bloquearCartaoAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        /* @var CartaoRepository
         */
        $CartaoRepository = $this->getDoctrine()->getRepository('UsuarioBundle:Cartao');

        $cartao = $CartaoRepository->buscaCartao($id);

        $cartao->setStatus('Inativo');

        $em->persist($cartao);
        $em->flush();

        return $this->redirectToRoute('inicio' );

    }

    





}
