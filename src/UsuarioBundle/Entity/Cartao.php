<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cartao
 *
 * @ORM\Table(name="cartao", indexes={@ORM\Index(name="fk_cartao_usuario_pessoa", columns={"idPessoa"})})
 * @ORM\Entity
 */
class Cartao
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idCartao", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcartao;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroCartao", type="string", length=20, nullable=false)
     */
    private $numerocartao;

    /**
     * @var string
     *
     * @ORM\Column(name="tipoCartao", type="string", length=1, nullable=true)
     */
    private $tipocartao;

    /**
     * @var string
     *
     * @ORM\Column(name="viaCartao", type="string", length=1, nullable=true)
     */
    private $viacartao;

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

