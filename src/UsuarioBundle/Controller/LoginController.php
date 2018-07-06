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


class LoginController extends Controller
{
    /**
     * @Route("/login/{warning}", name="login")
     */
    public function loginAction($warning=null)
    {
        if($warning==1)
        {
            $warning = "Não foi Possível encontrar Usuario para essa combinação de login/senha";
        }
        return $this->render('@Usuario/Default/login.html.twig',array('warning' => $warning));
    }


    /**
     * @Route("/inicio", name="inicio")
     */
    public function efetuarLoginAction(Request $request)
    {

        //$request;

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

         //var_dump($log);exit;
        

        if(count($Login)!=0)
        {
            //$usuario = "a";
            $cartoes = $CartaoRepository->findAll();
            $usuario = $UsuarioRepository->buscaUsuario($Login);
            return $this->render('@Usuario/Default/homepage.html.twig',array(
                'usuario'=>$usuario,
                'cartoes'=>$cartoes
            ));
        }
        else
        {
            

            return $this->redirectToRoute('login', array('warning' => 1));
            //return $this->render('@Usuario/Default/login.html.twig',array('warning'=>$warning));
        }

/*
        if($Login)
        {
            $usuario = $UsuarioRepository->buscaUsuario($Login);
            //return $this->render('@Usuario/Default/homepage.html.twig');
                return $this->redirectToRout('')
            //var_dump($usuario);exit;
            
        }
        else
        {

            return new JsonResponse(array(),500);
        }*/
    }

    




    /**
     * @Route("/novo-usuario", name="novo_usuario")
     *
     */
    public function registrarUsuarioAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

            $usuario = new Usuario();
            $login = new Login();

            $login->setLogin($request->request->get('login'));
            $login->setSenha($request->request->get('senha'));

            $em->persist($login);
            $em->flush();


            $nome = $request->request->get('nome');
            $sobrenome = $request->request->get('sobrenome');
            $dtnascimento = $request->request->get('dtnascimento');
            $sexo = $request->request->get('sexo');
            $cpf = $request->request->get('cpf');
            $celular = $request->request->get('celular');
            $telefone = $request->request->get('telefone');
            $nomePai = $request->request->get('nomePai');
            $email = $request->request->get('email');
            $cep = $request->request->get('cep');
            $complemento = $request->request->get('complemento');

            //var_dump($cep);exit;

            $usuario->setNome($nome);
            $usuario->setSobrenome($sobrenome);
            $usuario->setDtnascimento($dtnascimento);
            $usuario->setSexo($sexo);
            $usuario->setCpf($cpf);
            $usuario->setCelular($celular);
            $usuario->setTelefone($telefone);
            $usuario->setNomepai($nomePai);
            $usuario->setEmail($email);

            $endereco = $this->getDoctrine()->getRepository('UsuarioBundle:Endereco')->find($cep);

            $usuario->setCep($endereco);
            $usuario->setComplemento($complemento);


            $LoginRP = $this->getDoctrine()->getRepository('UsuarioBundle:Login');

            $Login = $LoginRP->findBuscarUltimoLogin();

            $usuario->setIdlogin($Login);
            //var_dump($usuario);exit;
            $em->persist($usuario);
            $em->flush();
            return new JsonResponse(array(),200);










        //} catch (\Exception $e) {





    }
}
