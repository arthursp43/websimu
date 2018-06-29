<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario", indexes={@ORM\Index(name="fk_Usuario_Login1_idx", columns={"idLogin"}), @ORM\Index(name="fk_Usuario_Endereco1_idx", columns={"CEP"})})
 * @ORM\Entity
 */
class Usuario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idUsuario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idusuario;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=45, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="sobrenome", type="string", length=45, nullable=false)
     */
    private $sobrenome;

    /**
     * @var string
     *
     * @ORM\Column(name="CPF", type="string", length=14, nullable=false)
     */
    private $cpf;

    /**
     * @var string
     *
     * @ORM\Column(name="sexo", type="string", length=1, nullable=false)
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
     * @ORM\Column(name="dtNascimento", type="string", length=45, nullable=false)
     */
    private $dtnascimento;

    /**
     * @var string
     *
     * @ORM\Column(name="nomePai", type="string", length=45, nullable=false)
     */
    private $nomepai;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=45, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="complemento", type="string", length=45, nullable=false)
     */
    private $complemento;

    /**
     * @var \Endereco
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Endereco")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CEP", referencedColumnName="CEP")
     * })
     */
    private $cep;

    /**
     * @var \Login
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Login")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idLogin", referencedColumnName="idLogin")
     * })
     */
    private $idlogin;

    /**
     * @return int
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }

    /**
     * @param int $idusuario
     * @return Usuario
     */
    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;
        return $this;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     * @return Usuario
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return string
     */
    public function getSobrenome()
    {
        return $this->sobrenome;
    }

    /**
     * @param string $sobrenome
     * @return Usuario
     */
    public function setSobrenome($sobrenome)
    {
        $this->sobrenome = $sobrenome;
        return $this;
    }

    /**
     * @return string
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param string $cpf
     * @return Usuario
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
        return $this;
    }

    /**
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @param string $sexo
     * @return Usuario
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
        return $this;
    }

    /**
     * @return string
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * @param string $celular
     * @return Usuario
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;
        return $this;
    }

    /**
     * @return string
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @param string $telefone
     * @return Usuario
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
        return $this;
    }

    /**
     * @return string
     */
    public function getDtnascimento()
    {
        return $this->dtnascimento;
    }

    /**
     * @param string $dtnascimento
     * @return Usuario
     */
    public function setDtnascimento($dtnascimento)
    {
        $this->dtnascimento = $dtnascimento;
        return $this;
    }

    /**
     * @return string
     */
    public function getNomepai()
    {
        return $this->nomepai;
    }

    /**
     * @param string $nomepai
     * @return Usuario
     */
    public function setNomepai($nomepai)
    {
        $this->nomepai = $nomepai;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Usuario
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * @param string $complemento
     * @return Usuario
     */
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
        return $this;
    }

    /**
     * @return \Endereco
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * @param \Endereco $cep
     * @return Usuario
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
        return $this;
    }

    /**
     * @return \Login
     */
    public function getIdlogin()
    {
        return $this->idlogin;
    }

    /**
     * @param \Login $idlogin
     * @return Usuario
     */
    public function setIdlogin($idlogin)
    {
        $this->idlogin = $idlogin;
        return $this;
    }




}

