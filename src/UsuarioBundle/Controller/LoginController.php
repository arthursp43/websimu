<?php

namespace UsuarioBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use UsuarioBundle\Entity\Login;
use UsuarioBundle\Entity\Usuario;


class LoginController extends Controller
{


    /**
     * @Route("/novo-usuario", name="novo_usuario")
     *
     */
    public function registrarUsuarioAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

            //var_dump($request->request->get('senha'));exit;

            $login = $request->request->get('login');
            $senha = $request->request->get('senha');
            $Login = new Login();

            $Login->setLogin($request->request->get('login'));
            $Login->setSenha($request->request->get('senha'));

            var_dump($Login);exit;
            $em->persist($Login);
            $em->flush();

            $usuario = new Usuario();


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



            $usuario->setNome($nome);
            $usuario->setSobrenome($sobrenome);
            $usuario->setDtnascimento($dtnascimento);
            $usuario->setSexo($sexo);
            $usuario->setCpf($cpf);
            $usuario->setCelular($celular);
            $usuario->setTelefone($telefone);
            $usuario->setNomepai($nomePai);
            $usuario->setEmail($email);
            $usuario->setCep($cep);
            $usuario->setComplemento($complemento);






            $LoginRP = $this->getDoctrine()->getRepository('UsuarioBundle:Login');

            $Login = $LoginRP->buscarUltimoLogin();

            $usuario->setLogin($Login);

            $em->persist($usuario);
            $em->flush();
            return new JsonResponse(array(), 200);










        //} catch (\Exception $e) {





    }
}
