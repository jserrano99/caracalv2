<?php

namespace UsuarioBundle\Entity;

/**
 * UsuariosConexiones
 */
class UsuarioConexion
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $dsconexion;

    /**
     * @var integer
     */
    private $usuario;

    /**
     * @var \DateTime
     */
    private $fcconexion;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dsconexion
     *
     * @param string $dsconexion
     *
     * @return UsuariosConexiones
     */
    public function setDsconexion($dsconexion)
    {
        $this->dsconexion = $dsconexion;

        return $this;
    }

    /**
     * Get dsconexion
     *
     * @return string
     */
    public function getDsconexion()
    {
        return $this->dsconexion;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return UsuariosConexiones
     */
    public function setUsuario(\UsuarioBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuarioId
     *
     * @return integer
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set fcconexion
     *
     * @param \DateTime $fcconexion
     *
     * @return UsuariosConexiones
     */
    public function setFcconexion($fcconexion)
    {
        $this->fcconexion = $fcconexion;

        return $this;
    }

    /**
     * Get fcconexion
     *
     * @return \DateTime
     */
    public function getFcconexion()
    {
        return $this->fcconexion;
    }
}

