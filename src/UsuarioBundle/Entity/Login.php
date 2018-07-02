<?php

namespace UsuarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Login
 *
 * @ORM\Table(name="login")
 * @ORM\Entity
 */
class Login
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idLogin", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlogin;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=45, nullable=false)
     */
    private $login;


    /**
     * @var string
     *
     * @ORM\Column(name="senha", type="string", length=45, nullable=false)
     */
    private $senha;

    /**
     * @return string
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param string $senha
     * @return Login
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
        return $this;
    }



    /**
     * @return int
     */
    public function getIdlogin()
    {
        return $this->idlogin;
    }

    /**
     * @param int $idlogin
     * @return Login
     */
    public function setIdlogin($idlogin)
    {
        $this->idlogin = $idlogin;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     * @return Login
     */
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }




}

