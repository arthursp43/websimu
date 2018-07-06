<?php

namespace UsuarioBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
     * @Route("/efetuar-login", name="efetuar_login")
     *
     */
    public function efetuarLoginAction(Request $request)
    {

        $login=$request->request->get('login');
        $senha=$request->request->get('senha');

        /* @var UsuarioRepository
         */
        $UsuarioRepository = $this->getDoctrine()->getRepository('UsuarioBundle:Usuario');

        /* @var UsuarioRepository
         */
        $LoginRepositorio = $this->getDoctrine()->getRepository('UsuarioBundle:Login');



        $Login = $LoginRepositorio->buscaLogin($login,$senha);




        if(count($Login)!=0)
        {
            $usuario = $UsuarioRepository->buscaUsuario($Login);
            //return $this->render('@Usuario/Default/homepage.html.twig');

            //var_dump($usuario);exit;
            return $this->redirectToRoute('homepage', array(), 301);
        }
        else
        {

            return new JsonResponse(array(),500);
        }













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
