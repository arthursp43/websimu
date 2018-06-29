<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Empresa
 *
 * @ORM\Table(name="empresa", indexes={@ORM\Index(name="fk_Empresa_Endereco1_idx", columns={"CEP"}), @ORM\Index(name="fk_Empresa_Login", columns={"idlLogin"})})
 * @ORM\Entity
 */
class Empresa
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idEmpresa", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idempresa;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=45, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="CNPJ", type="string", length=18, nullable=false)
     */
    private $cnpj;

    /**
     * @var string
     *
     * @ORM\Column(name="telefone", type="string", length=45, nullable=false)
     */
    private $telefone;

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
     *   @ORM\JoinColumn(name="idlLogin", referencedColumnName="idLogin")
     * })
     */
    private $idllogin;

    /**
     * @return int
     */
    public function getIdempresa()
    {
        return $this->idempresa;
    }

    /**
     * @param int $idempresa
     * @return Empresa
     */
    public function setIdempresa($idempresa)
    {
        $this->idempresa = $idempresa;
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
     * @return Empresa
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return string
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * @param string $cnpj
     * @return Empresa
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
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
     * @return Empresa
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
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
     * @return Empresa
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
     * @return Empresa
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
     * @return Empresa
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
        return $this;
    }

    /**
     * @return \Login
     */
    public function getIdllogin()
    {
        return $this->idllogin;
    }

    /**
     * @param \Login $idllogin
     * @return Empresa
     */
    public function setIdllogin($idllogin)
    {
        $this->idllogin = $idllogin;
        return $this;
    }






}

