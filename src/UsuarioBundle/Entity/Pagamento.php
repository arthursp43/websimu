<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pagamento
 *
 * @ORM\Table(name="pagamento", indexes={@ORM\Index(name="fk_pagamento_pessoa", columns={"idPessoa"})})
 * @ORM\Entity
 */
class Pagamento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idPgto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpgto;

    /**
     * @var string
     *
     * @ORM\Column(name="dtPgto", type="string", length=10, nullable=false)
     */
    private $dtpgto;

    /**
     * @var string
     *
     * @ORM\Column(name="formaPgto", type="string", length=1, nullable=false)
     */
    private $formapgto;

    /**
     * @var string
     *
     * @ORM\Column(name="valorPago", type="string", length=10, nullable=false)
     */
    private $valorpago;

    /**
     * @var string
     *
     * @ORM\Column(name="statusPgto", type="string", length=1, nullable=true)
     */
    private $statuspgto;

    /**
     * @var \UsuarioPessoa
     *
     * @ORM\ManyToOne(targetEntity="UsuarioPessoa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPessoa", referencedColumnName="idPessoa")
     * })
     */
    private $idpessoa;


}

