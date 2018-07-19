<?php

namespace CorreoBundle\Entity;

/**
 * Adjunto
 */
class Adjunto
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $fichero;
    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var \CorreoBundle\Entity\Correo
     */
    private $correo;

    

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
     * Set fichero
     *
     * @param string $fichero
     *
     * @return Adjunto
     */
    public function setFichero($fichero)
    {
        $this->fichero = $fichero;

        return $this;
    }

    /**
     * Get fichero
     *
     * @return string
     */
    public function getFichero()
    {
        return $this->fichero;
    }

    /**
     * Set correoId
     *
     * @param \CorreoBundle\Entity\Correo $correo
     *
     * @return Adjunto
     */
    public function setCorreo(\CorreoBundle\Entity\Correo $correo=null)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return \CorreoBundle\Entity\Correo
     */
    public function getCorreo()
    {
        return $this->correo;
    }
    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Adjunto
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
}

