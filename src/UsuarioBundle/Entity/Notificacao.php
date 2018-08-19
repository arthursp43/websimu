<?php

namespace UsuarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Padrao
 *
 * @ORM\Table(name="notificacao")
 * @ORM\Entity(repositoryClass="UsuarioBundle\Repository\CartaoRepository")
 */
class Notificacao
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=255)
     */
    private $descricao;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var \Usuario
     *
     * @ORM\OneToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUsuario", referencedColumnName="idUsuario")
     * })
     */
    private $idUsuario;


    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     *
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     *
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set id
     *
     * @return int
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return \Usuario
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * @param \Usuario $idUsuario
     * @return Notificacao
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
        return $this;
    }


}

