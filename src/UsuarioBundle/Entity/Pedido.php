<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pedido
 *
 * @ORM\Table(name="pedido", indexes={@ORM\Index(name="fk_pedido_idUPessoa", columns={"idPessoa"})})
 * @ORM\Entity
 */
class Pedido
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idPedido", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpedido;

    /**
     * @var string
     *
     * @ORM\Column(name="dtPedido", type="string", length=10, nullable=false)
     */
    private $dtpedido;

    /**
     * @var integer
     *
     * @ORM\Column(name="qtPassagem", type="integer", nullable=false)
     */
    private $qtpassagem;

    /**
     * @var string
     *
     * @ORM\Column(name="valorPagar", type="string", length=10, nullable=false)
     */
    private $valorpagar;

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

