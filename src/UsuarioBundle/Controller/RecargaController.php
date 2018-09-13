<?php

namespace UsuarioBundle\Controller;


use Symfony\Component\Validator\Constraints\Date;
use UsuarioBundle\Entity\Cartao;
use UsuarioBundle\Entity\Itenspedido;
use Symfony\Component\Validator\Constraints\DateTime;
use UsuarioBundle\Entity\Notificacao;
use UsuarioBundle\Entity\Pagamento;
use UsuarioBundle\Entity\Pedido;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use UsuarioBundle\Entity\Endereco;
use UsuarioBundle\Entity\Login;
use UsuarioBundle\Entity\Usuario;
use UsuarioBundle\Repository\ItensPedidoRepository;
use UsuarioBundle\Repository\LoginRepository;
use UsuarioBundle\Repository\PedidoRepository;
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

        /* @var PedidoRepository
         */
        $PedidoRepository = $this->getDoctrine()->getRepository('UsuarioBundle:Pedido');


        $NotificacaoRepository = $this->getDoctrine()->getRepository('UsuarioBundle:Notificacao');


        $Login = $LoginRepositorio->buscaLogin($login,$senha);

        //var_dump($log);exit;


        if(count($Login)!=0)
        {
            //$usuario = "a";

            $usuario = $UsuarioRepository->buscaUsuario($Login);

            $pedidos = $PedidoRepository->buscaPedidoValido($usuario);



            setcookie('login', $login);
            setcookie('senha', $senha);
            setcookie('usuario', $usuario->getIdusuario()."");

            $notificacoes = $NotificacaoRepository->findBy(array(
                'idUsuario'=>$usuario,
                'status'=>0
            ), array('id'=>'DESC'));

            return $this->render('@Usuario/Recarga/homepage.html.twig',array(
                'usuario'=>$usuario,
                'pedidos'=>$pedidos,
                'notificacoes'=>$notificacoes

            ));
        }
        else
        {


            return $this->redirectToRoute('login', array('warning' => 1));
            //return $this->render('@Usuario/Default/login.html.twig',array('warning'=>$warning));
        }


    }

    /**
     * @Route("/recarga/meus-cartoes/{id}",defaults={"id"=null}, name="recarga_meus_cartoes")
     */
    public function recargaMeusCartoesAction($id)
    {

        ///$request;
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
            $status='Ativo';
            $cartoes = $CartaoRepository->buscaCartoesAtivos($usuario,$status);

            setcookie('login', $login);
            setcookie('senha', $senha);
            setcookie('usuario', $usuario->getIdusuario()."");




            if(!$id) {

                $pedido = new Pedido();

                $pedido->setIdusuario($usuario);
                $pedido->setStatus("fase1");
                $pedido->setValor(0);
                $pedido->setDatapedido("");

                $em = $this->getDoctrine()->getManager();

                $em->persist($pedido);
                $em->flush();
            }else {


                /* @var PedidoRepository
                 */
                $PedidoRepository = $this->getDoctrine()->getRepository('UsuarioBundle:Pedido');
                $pedido = $PedidoRepository->find($id);
            }
                /* @var ItensPedidoRepository
                 */
                $ItensPedidoRepository = $this->getDoctrine()->getRepository('UsuarioBundle:Itenspedido');
                $itenspedido1 = $ItensPedidoRepository->findBy(array('pedidopedido' => $pedido));


            $NotificacaoRepository = $this->getDoctrine()->getRepository('UsuarioBundle:Notificacao');
            $notificacoes = $NotificacaoRepository->findBy(array(
                'idUsuario'=>$usuario,
                'status'=>0
            ), array('id'=>'DESC'));

            return $this->render('@Usuario/Recarga/recarga1.html.twig', array(
                    'pedido'=>$pedido,
                    'usuario' => $usuario,
                    'cartoes' => $cartoes,
                    'itenspedido1' => $itenspedido1,
                    'notificacoes' => $notificacoes
                ));

        }
        else
        {


            return $this->redirectToRoute('login', array('warning' => 1));
            //return $this->render('@Usuario/Default/login.html.twig',array('warning'=>$warning));
        }


    }


    /**
     * @Route("/recarga/registrar-item-pedido", name="recarga_registrar_item_pedido")
     */
    public function registrarItemPedidoAction(Request $request)
    {

        ///$request;
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
            $status='Ativo';
            $cartoes = $CartaoRepository->buscaCartoesAtivos($usuario,$status);

            setcookie('login', $login);
            setcookie('senha', $senha);
            setcookie('usuario', $usuario->getIdusuario()."");

            /* @var PedidoRepository
             */
            $PedidoRepository = $this->getDoctrine()->getRepository('UsuarioBundle:Pedido');





            $itempedido = new Itenspedido();

            $idpedido =$request->request->get('id');
            $valor = $request->request->get('valor');
            $cartao = $request->request->get('cartao');

            $card = $CartaoRepository->find($cartao);

            $pedido = $PedidoRepository->find($idpedido);

            $itempedido->setValor($valor);
            $itempedido->setCartaousuario($card);
            $itempedido->setPedidopedido($pedido);


            $em = $this->getDoctrine()->getManager();

            $em->persist($itempedido);
            $em->flush();




            return new JsonResponse(array(),200);


        }
        else
        {


            return $this->redirectToRoute('login', array('warning' => 1));
            //return $this->render('@Usuario/Default/login.html.twig',array('warning'=>$warning));
        }


    }

    /**
     * @Route("/recarga/excluir-item-pedido", name="recarga_excluir_item_pedido")
     */
    public function excluirItemPedidoAction(Request $request)
    {

        ///$request;
        if (isset($_POST['login'])) {
            $login = $_POST['login'];
        } else {
            $login = $_COOKIE['login'];
        }
        if (isset($_POST['senha'])) {
            $senha = $_POST['senha'];
        } else {
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


        $Login = $LoginRepositorio->buscaLogin($login, $senha);

        //var_dump($log);exit;


        if (count($Login) != 0) {
            //$usuario = "a";

            $usuario = $UsuarioRepository->buscaUsuario($Login);
            $status = 'Ativo';
            $cartoes = $CartaoRepository->buscaCartoesAtivos($usuario, $status);

            setcookie('login', $login);
            setcookie('senha', $senha);
            setcookie('usuario', $usuario->getIdusuario() . "");

            /* @var PedidoRepository
             */
            $PedidoRepository = $this->getDoctrine()->getRepository('UsuarioBundle:Pedido');


            $itempedido = new Itenspedido();

            $idpedido = $request->request->get('iditenspedido');

            /* @var PedidoRepository
             */
            $itemPedidoRepository = $this->getDoctrine()->getRepository('UsuarioBundle:Itenspedido');

            $itempedido = $itemPedidoRepository->find($idpedido);


            $em = $this->getDoctrine()->getManager();
            $em->remove($itempedido);
            $em->flush();

            return new JsonResponse(array(), 200);
        } else {
            return $this->redirectToRoute('login', array('warning' => 1));
            //return $this->render('@Usuario/Default/login.html.twig',array('warning'=>$warning));
        }
    }

        /**
         * @Route("/recarga/encaminhar-pedido", name="recarga_encaminhar_pedido")
         */
        public function encaminharPedido(Request $request)
    {

        ///$request;
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



        if(count($Login)!=0)
        {
            //$usuario = "a";

            $usuario = $UsuarioRepository->buscaUsuario($Login);
            $status='Ativo';
            $cartoes = $CartaoRepository->buscaCartoesAtivos($usuario,$status);

            setcookie('login', $login);
            setcookie('senha', $senha);
            setcookie('usuario', $usuario->getIdusuario()."");

            $idpedido =$request->request->get('id');

            /* @var PedidoRepository
             */
            $PedidoRepository = $this->getDoctrine()->getRepository('UsuarioBundle:Pedido');

            $pedido=$PedidoRepository->find($idpedido);

            $valor = 0;

            /* @var ItensPedidoRepository
             */
            $ItensPedidoRepository = $this->getDoctrine()->getRepository('UsuarioBundle:Itenspedido');
            $itenspedido= $ItensPedidoRepository->findBy(array('pedidopedido' => $pedido));


            foreach ($itenspedido as $itenpedido) {
                $valor = $valor + $itenpedido->getValor();
            }





            $pedido->setStatus("Aguardando Confirmação de Pagamento");
            $pedido->setValor($valor);



            $pedido->setDatapedido("");






            $em = $this->getDoctrine()->getManager();
            $em->persist($pedido);
            $em->flush();

            return new JsonResponse(array(),200);
        }
        else
        {
            return $this->redirectToRoute('login', array('warning' => 1));
            //return $this->render('@Usuario/Default/login.html.twig',array('warning'=>$warning));
        }


    }

    /**
     * @Route("/recarga/checkout/{id}", name="recarga_checkout")
     */
    public function recargaCheckout($id)
    {

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

        $LoginRepositorio = $this->getDoctrine()->getRepository('UsuarioBundle:Login');
        $UsuarioRepository= $this->getDoctrine()->getRepository('UsuarioBundle:Usuario');

        $Login = $LoginRepositorio->buscaLogin($login,$senha);

        $usuario = $UsuarioRepository->buscaUsuario($Login);


        $PedidoRepository = $this->getDoctrine()->getRepository('UsuarioBundle:Pedido');

        /** @var Pedido $pedido */
        $pedido = $PedidoRepository->find($id);

        $valorTotal = $pedido->getValor();

        return $this->render('@Usuario/Pagamento/homepage.html.twig',
            array(
                'usuario'=>$usuario,
                'pedido'=>$pedido,
                 'valor'=>$valorTotal
        ));
    }

    /**
     * @Route("/recarga/pagamento", name="recarga_pagamento")
     */
    public function efetuarPagamentoAction(Request $request)
    {

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

        $LoginRepositorio = $this->getDoctrine()->getRepository('UsuarioBundle:Login');
        $UsuarioRepository= $this->getDoctrine()->getRepository('UsuarioBundle:Usuario');

        $Login = $LoginRepositorio->buscaLogin($login,$senha);

        $usuario = $UsuarioRepository->buscaUsuario($Login);


        $PedidoRepository = $this->getDoctrine()->getRepository('UsuarioBundle:Pedido');
        $CartaoRepository = $this->getDoctrine()->getRepository('UsuarioBundle:Cartao');

        $itemPedidoRepository = $this->getDoctrine()->getRepository('UsuarioBundle:Itenspedido');

        $id=$request->request->get('id');

        /** @var Pedido $pedido */
        $pedido = $PedidoRepository->find($id);

        $pedido->setStatus("Concluído");

        $em = $this->getDoctrine()->getManager();
        $em->persist($pedido);
        $em->flush();

        $itensPedido = $itemPedidoRepository->findBy(array('pedidopedido'=>$pedido));

        foreach ($itensPedido as $item)
        {
            /** @var Itenspedido $item */

            /** @var Cartao $cartao */
            $cartao =  $item->getCartaousuario();

            $cartao->setSaldo($cartao->getSaldo()+$item->getValor());

            $em->persist($pedido);
            $em->flush();

        }


        /** @var Pagamento $pagamento */
        $pagamento = new Pagamento();
        $pagamento->setStatus("Aprovado!");
        $pagamento->setData("28/08/2018");
        $pagamento->setTipo("Cartão de Crédito 1x");

        $em->persist($pagamento);
        $em->flush();


        $notificacao= new Notificacao();

        $notificacao->setStatus(0);
        $notificacao->setTitulo("Pedido Concluído!");
        $notificacao->setDescricao("Seu Pedido de número ".$pedido->getIdpedido()." de valor: R$".$pedido->getValor().",00 ");
        $notificacao->setIdUsuario($usuario);

        $em->persist($notificacao);
        $em->flush();


        return new JsonResponse(array(),200);


    }

    /**
     * @Route("/cartao/saldo", name="cartao_ver_saldo")
     */
    public function saldoAction(Request $request)
    {
        $cartaoid = $request->request->get("id");

        $CartaoRepository = $this->getDoctrine()->getRepository('UsuarioBundle:Cartao');

        /** @var Cartao $cartao */
        $cartao = $CartaoRepository->find($cartaoid);

        $saldo = $cartao->getSaldo();

        return new JsonResponse(array('saldo'=>$saldo),200);
    }


}
