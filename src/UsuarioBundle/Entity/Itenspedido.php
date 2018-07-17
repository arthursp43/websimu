<?php

namespace UsuarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Itenspedido
 *
 * @ORM\Table(name="itenspedido", indexes={@ORM\Index(name="fk_ItensPedido_Pedido1_idx", columns={"Pedido_idPedido"}), @ORM\Index(name="fk_ItensPedido_Cartao1_idx", columns={"Cartao_idUsuario", "Cartao_numeroCartao"})})
 * @ORM\Entity(repositoryClass="UsuarioBundle\Repository\ItensPedidoRepository")
 */
class Itenspedido
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idItensPedido", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iditenspedido;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=45, nullable=false)
     */
    private $valor;

    /**
     * @var \Cartao
     *
     * @ORM\ManyToOne(targetEntity="Cartao")
     *  @ORM\JoinColumn(name="Cartao_numeroCartao", referencedColumnName="numeroCartao")
     *
     */
    private $cartaousuario;

   
    /**
     * @var \Pedido
     *
     * @ORM\ManyToOne(targetEntity="Pedido")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Pedido_idPedido", referencedColumnName="idEmpresa")
     * })
     */
    private $pedidopedido;

    /**
     * @return int
     */
    public function getIditenspedido()
    {
        return $this->iditenspedido;
    }

    /**
     * @param int $iditenspedido
     * @return Itenspedido
     */
    public function setIditenspedido($iditenspedido)
    {
        $this->iditenspedido = $iditenspedido;
        return $this;
    }

    /**
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param string $valor
     * @return Itenspedido
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
        return $this;
    }

    /**
     * @return \Cartao
     */
    public function getCartaousuario()
    {
        return $this->cartaousuario;
    }

    /**
     * @param \Cartao $cartaousuario
     * @return Itenspedido
     */
    public function setCartaousuario($cartaousuario)
    {
        $this->cartaousuario = $cartaousuario;
        return $this;
    }

    /**
     * @return \Pedido
     */
    public function getPedidopedido()
    {
        return $this->pedidopedido;
    }

    /**
     * @param \Pedido $pedidopedido
     * @return Itenspedido
     */
    public function setPedidopedido($pedidopedido)
    {
        $this->pedidopedido = $pedidopedido;
        return $this;
    }





}

