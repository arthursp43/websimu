<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioEmpresa
 *
 * @ORM\Table(name="usuario_empresa", indexes={@ORM\Index(name="fk__empresa_cep", columns={"CEP"})})
 * @ORM\Entity
 */
class UsuarioEmpresa
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idEmpresa", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idempresa;

    /**
     * @var string
     *
     * @ORM\Column(name="nomeEmpresa", type="string", length=50, nullable=false)
     */
    private $nomeempresa;

    /**
     * @var string
     *
     * @ORM\Column(name="CNPJ", type="string", length=18, nullable=false)
     */
    private $cnpj;

    /**
     * @var string
     *
     * @ORM\Column(name="telefone", type="string", length=14, nullable=true)
     */
    private $telefone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="complemento", type="string", length=50, nullable=true)
     */
    private $complemento;

    /**
     * @var \Endereco
     *
     * @ORM\ManyToOne(targetEntity="Endereco")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CEP", referencedColumnName="CEP")
     * })
     */
    private $cep;


}

