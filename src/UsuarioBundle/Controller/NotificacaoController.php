<?php

namespace UsuarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class NotificacaoController extends Controller
{
    /**
     * @Route("/notificacao-lida-homepage/{id}", name="ler_notificacao_homepage")
     */
    public function lerNotificacaoAction($id)
    {

        $notificacaoRepository = $this->getDoctrine()->getRepository('UsuarioBundle:Notificacao');

        $notificacao = $notificacaoRepository->find($id);

        $notificacao->setStatus(1);

        $em = $this->getDoctrine()->getManager();

        $em->persist($notificacao);
        $em->flush();

        return $this->redirectToRoute('inicio');

    }

}
