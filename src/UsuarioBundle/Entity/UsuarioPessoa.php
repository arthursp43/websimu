<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioPessoa
 *
 * @ORM\Table(name="usuario_pessoa", indexes={@ORM\Index(name="fk_cep", columns={"CEP"})})
 * @ORM\Entity
 */
class UsuarioPessoa
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idPessoa", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpessoa;

    /**
     * @var string
     *
     * @ORM\Column(name="nomeCompleto", type="string", length=80, nullable=false)
     */
    private $nomecompleto;

    /**
     * @var string
     *
     * @ORM\Column(name="CPF", type="string", length=14, nullable=false)
     */
    private $cpf;

    /**
     * @var string
     *
     * @ORM\Column(name="sexo", type="string", length=1, nullable=true)
     */
    private $sexo;

    /**
     * @var string
     *
     * @ORM\Column(name="celular", type="string", length=14, nullable=false)
     */
    private $celular;

    /**
     * @var string
     *
     * @ORM\Column(name="telefone", type="string", length=13, nullable=true)
     */
    private $telefone;

    /**
     * @var string
     *
     * @ORM\Column(name="nomeMae", type="string", length=80, nullable=false)
     */
    private $nomemae;

    /**
     * @var string
     *
     * @ORM\Column(name="nomePai", type="string", length=80, nullable=false)
     */
    private $nomepai;

    /**
     * @var string
     *
     * @ORM\Column(name="dtNascimento", type="string", length=10, nullable=false)
     */
    private $dtnascimento;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero", type="integer", nullable=false)
     */
    private $numero;

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

