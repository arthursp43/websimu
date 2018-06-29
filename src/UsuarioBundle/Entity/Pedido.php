<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pedido
 *
 * @ORM\Table(name="pedido", indexes={@ORM\Index(name="fk_Pedido_Usuario1_idx", columns={"idUsuario"}), @ORM\Index(name="fk_Pedido_Pagamento1_idx", columns={"idPagamento"}), @ORM\Index(name="fk_Pedido_Empresa1_idx", columns={"idEmpresa"})})
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
     * @ORM\Column(name="dataPedido", type="string", length=45, nullable=false)
     */
    private $datapedido;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=45, nullable=false)
     */
    private $status;

    /**
     * @var float
     *
     * @ORM\Column(name="valor", type="float", precision=10, scale=0, nullable=false)
     */
    private $valor;

    /**
     * @var \Empresa
     *
     * @ORM\ManyToOne(targetEntity="Empresa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEmpresa", referencedColumnName="idEmpresa")
     * })
     */
    private $idempresa;

    /**
     * @var \Pagamento
     *
     * @ORM\ManyToOne(targetEntity="Pagamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPagamento", referencedColumnName="idPagamento")
     * })
     */
    private $idpagamento;

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUsuario", referencedColumnName="idUsuario")
     * })
     */
    private $idusuario;

    /**
     * @return int
     */
    public function getIdpedido()
    {
        return $this->idpedido;
    }

    /**
     * @param int $idpedido
     * @return Pedido
     */
    public function setIdpedido($idpedido)
    {
        $this->idpedido = $idpedido;
        return $this;
    }

    /**
     * @return string
     */
    public function getDatapedido()
    {
        return $this->datapedido;
    }

    /**
     * @param string $datapedido
     * @return Pedido
     */
    public function setDatapedido($datapedido)
    {
        $this->datapedido = $datapedido;
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
     * @return Pedido
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return float
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param float $valor
     * @return Pedido
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
        return $this;
    }

    /**
     * @return \Empresa
     */
    public function getIdempresa()
    {
        return $this->idempresa;
    }

    /**
     * @param \Empresa $idempresa
     * @return Pedido
     */
    public function setIdempresa($idempresa)
    {
        $this->idempresa = $idempresa;
        return $this;
    }

    /**
     * @return \Pagamento
     */
    public function getIdpagamento()
    {
        return $this->idpagamento;
    }

    /**
     * @param \Pagamento $idpagamento
     * @return Pedido
     */
    public function setIdpagamento($idpagamento)
    {
        $this->idpagamento = $idpagamento;
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
     * @return Pedido
     */
    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;
        return $this;
    }




}

