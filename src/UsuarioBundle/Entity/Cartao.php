<?php

namespace UsuarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cartao
 *
 * @ORM\Table(name="cartao", indexes={@ORM\Index(name="fk_Cartao_Usuario1_idx", columns={"idUsuario"})})
 * @ORM\Entity(repositoryClass="UsuarioBundle\Repository\CartaoRepository")
 */
class Cartao
{
    /**
     * @var string
     *
     * @ORM\Column(name="numeroCartao", type="string", length=45, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $numerocartao;

    /**
     * @var string
     *
     * @ORM\Column(name="validade", type="string", length=45, nullable=false)
     */
    private $validade;

    /**
     * @var string
     *
     * @ORM\Column(name="titular", type="string", length=45, nullable=false)
     */
    private $titular;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=45, nullable=false)
     */
    private $tipo;

    /**
     * @var float
     *
     * @ORM\Column(name="saldo", type="float", precision=10, scale=0, nullable=false)
     */
    private $saldo;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=45, nullable=false)
     */
    private $status;

    /**
     * @var \Usuario
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUsuario", referencedColumnName="idUsuario")
     * })
     */
    private $idusuario;

    /**
     * @return string
     */
    public function getNumerocartao()
    {
        return $this->numerocartao;
    }

    /**
     * @return string
     */
    public function getTitular()
    {
        return $this->titular;
    }

    /**
     * @param string $titular
     * @return Cartao
     */
    public function setTitular($titular)
    {
        $this->titular = $titular;
        return $this;
    }



    /**
     * @param string $numerocartao
     * @return Cartao
     */
    public function setNumerocartao($numerocartao)
    {
        $this->numerocartao = $numerocartao;
        return $this;
    }

    /**
     * @return string
     */
    public function getValidade()
    {
        return $this->validade;
    }

    /**
     * @param string $validade
     * @return Cartao
     */
    public function setValidade($validade)
    {
        $this->validade = $validade;
        return $this;
    }

    /**
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param string $tipo
     * @return Cartao
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
        return $this;
    }

    /**
     * @return float
     */
    public function getSaldo()
    {
        return $this->saldo;
    }

    /**
     * @param float $saldo
     * @return Cartao
     */
    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Cartao
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return \Usuario
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }

    /**
     * @param \Usuario $idusuario
     * @return Cartao
     */
    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;
        return $this;
    }


}

