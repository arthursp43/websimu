<?php

namespace UsuarioBundle\Repository;

/**
 * PadraoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CartaoRepository extends \Doctrine\ORM\EntityRepository
{

    public function buscaCartoes($usuario)
    {

        return $this->getEntityManager()
            ->createQuery(
                "SELECT c FROM UsuarioBundle:Cartao c where c.idusuario = :usuario "
            )->setParameter('usuario',$usuario)
            ->getResult();
    }


    public function buscaCartoesAtivos($usuario,$status)
    {

        return $this->getEntityManager()
            ->createQuery(
                "SELECT c FROM UsuarioBundle:Cartao c where c.idusuario = :usuario and c.status = :status "
            )
            ->setParameter('usuario',$usuario)
            ->setParameter('status',$status)
            ->getResult();
    }

    public function buscaCartao($numeroCartao)
    {

        return $this->getEntityManager()
            ->createQuery(
                "SELECT c FROM UsuarioBundle:Cartao c where c.numerocartao = :numeroCartao "
            )->setParameter('numeroCartao',$numeroCartao)
            ->getSingleResult();
    }
}
