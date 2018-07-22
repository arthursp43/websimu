<?php

namespace UsuarioBundle\Controller;


use Symfony\Component\Validator\Constraints\Date;
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

        /* @var PedidoRepository
         */
        $PedidoRepository = $this->getDoctrine()->getRepository('UsuarioBundle:Pedido');




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

            return $this->render('@Usuario/Recarga/homepage.html.twig',array(
                'usuario'=>$usuario,
                'pedidos'=>$pedidos

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



            return $this->render('@Usuario/Recarga/recarga1.html.twig', array(
                    'pedido'=>$pedido,
                    'usuario' => $usuario,
                    'cartoes' => $cartoes,
                    'itenspedido1' => $itenspedido1
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

    





}
