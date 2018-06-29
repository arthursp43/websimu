<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Endereco
 *
 * @ORM\Table(name="endereco")
 * @ORM\Entity
 */
class Endereco
{
    /**
     * @var string
     *
     * @ORM\Column(name="CEP", type="string", length=9, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cep;

    /**
     * @var string
     *
     * @ORM\Column(name="rua", type="string", length=45, nullable=false)
     */
    private $rua;

    /**
     * @var string
     *
     * @ORM\Column(name="bairro", type="string", length=45, nullable=false)
     */
    private $bairro;

    /**
     * @var string
     *
     * @ORM\Column(name="cidade", type="string", length=45, nullable=false)
     */
    private $cidade;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=45, nullable=false)
     */
    private $estado;

    /**
     * @return string
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * @param string $cep
     * @return Endereco
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
        return $this;
    }

    /**
     * @return string
     */
    public function getRua()
    {
        return $this->rua;
    }

    /**
     * @param string $rua
     * @return Endereco
     */
    public function setRua($rua)
    {
        $this->rua = $rua;
        return $this;
    }

    /**
     * @return string
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * @param string $bairro
     * @return Endereco
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
        return $this;
    }

    /**
     * @return string
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * @param string $cidade
     * @return Endereco
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
        return $this;
    }

    /**
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param string $estado
     * @return Endereco
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
        return $this;
    }




}

