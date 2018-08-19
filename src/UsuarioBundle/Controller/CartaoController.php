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
use UsuarioBundle\Entity\Notificacao;
use UsuarioBundle\Repository\LoginRepository;
use UsuarioBundle\Repository\NotificacaoRepository;
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

        $codSeguranca="";
        for ($x = 0; $x <= 2; $x++) {
            $codSeguranca=$codSeguranca.rand(1,9)."";

        }

        /* @var Cartao
         */
        $cartao = new Cartao();

        $cartao->setIdusuario($usuario);
        $cartao->setNumerocartao($numeroCartao);
        $cartao->setSaldo(0);
        $cartao->setCodSeguranca($codSeguranca);

        $validade="31/12/2020";

        $cartao->setTitular($titular);
        $cartao->setValidade($validade);
        $cartao->setTipo($tipo);
        $cartao->setStatus("Solicitado - Aguardando Envio");


        //var_dump($usuario);exit;
        $em->persist($cartao);
        $em->flush();

        /** @var Notificacao $notificacao */
        $notificacao = new Notificacao();
        $notificacao->setTitulo('Novo Pedido de Cartão!');
        $notificacao->setDescricao('Seu cartão  de numero '.$cartao->getNumerocartao().' foi solicitado com sucesso, e o mesmo já se encontra em produção!');
        $notificacao->setStatus(0);
        $notificacao->setIdUsuario($usuario);

        $em->persist($notificacao);
        $em->flush();


        return $this->redirectToRoute('inicio' );
        //return new JsonResponse(array(json_encode($login),json_encode($senha)),200);






    }


    /**
     * @Route("/cartao/chegou", name="cartao_chegou")
     */
    public function chegouCartaoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();


        $id= $request->request->get('id');
        $codSeguranca= $request->request->get('result');

        $CartaoRepository = $this->getDoctrine()->getRepository('UsuarioBundle:Cartao');

        $cartao = $CartaoRepository->buscaCartao($id);

        if($cartao->getCodSeguranca() == $codSeguranca)
        {
             $cartao->setStatus('Ativo');

             $em->persist($cartao);
             $em->flush();

             return new JsonResponse(array('status'=>'ok'),200);
        }else{
            return new JsonResponse(array('status'=>'errado'),200);
        }
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
