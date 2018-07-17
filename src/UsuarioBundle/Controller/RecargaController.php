<?php

namespace UsuarioBundle\Controller;


use UsuarioBundle\Entity\Itenspedido;
use Symfony\Component\Validator\Constraints\DateTime;
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

    /**
     * @Route("/recarga/meus-cartoes", name="recarga_meus_cartoes")
     */
    public function recargaMeusCartoesAction()
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

            $pedido = new Pedido();

            $pedido->setIdusuario($usuario);
            $pedido->setStatus("fase1");
            $pedido->setValor(0);
            $pedido->setDatapedido("");

            $em = $this->getDoctrine()->getManager();

            $em->persist($pedido);
            $em->flush();



            /* @var PedidoRepository
             */
            $PedidoRepository = $this->getDoctrine()->getRepository('UsuarioBundle:Pedido');
            $pedido = $PedidoRepository->BuscarUltimoPagamentoUsuario($usuario);

            /* @var ItensPedidoRepository
             */
            $ItensPedidoRepository = $this->getDoctrine()->getRepository('UsuarioBundle:Itenspedido');
            $itenspedido = $ItensPedidoRepository->buscarItensPedidoPedido($pedido);


            return $this->render('@Usuario/Recarga/recarga1.html.twig',array(
                'usuario'=>$usuario,
                'cartoes'=>$cartoes,
                'itenspedido'=>$itenspedido
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



            $pedido = $PedidoRepository->BuscarUltimoPagamentoUsuario($usuario);

            $itempedido = new Itenspedido();

            $valor = $request->request->get('valor');
            $cartao = $request->request->get('cartao');

            $itempedido->setValor($valor);
            $itempedido->setCartaousuario($cartao);
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

    





}
