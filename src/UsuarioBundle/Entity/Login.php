<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Login
 *
 * @ORM\Table(name="login", indexes={@ORM\Index(name="fk_login_pessoa", columns={"idPessoa"}), @ORM\Index(name="fk_login_empresa", columns={"idEmpresa"})})
 * @ORM\Entity
 */
class Login
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idCadastro", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcadastro;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=30, nullable=false)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="senha", type="string", length=20, nullable=false)
     */
    private $senha;

    /**
     * @var \UsuarioEmpresa
     *
     * @ORM\ManyToOne(targetEntity="UsuarioEmpresa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEmpresa", referencedColumnName="idEmpresa")
     * })
     */
    private $idempresa;

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

