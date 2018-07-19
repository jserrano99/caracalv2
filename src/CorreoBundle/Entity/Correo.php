<?php

namespace CorreoBundle\Entity;

/**
 * Correo
 */
class Correo
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $asunto;

    /**
     * @var string
     */
    private $cuerpo;

    /**
    * @var \CorreoBundle\Entity\EstadoCorreo
    */
    private $estadoCorreo;
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
     * Set asunto
     *
     * @param string $asunto
     *
     * @return EstadoCorreo
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;

        return $this;
    }

    /**
     * Get asunto
     *
     * @return string
     */
    public function getAsunto()
    {
        return $this->asunto;
    }

    /**
     * Set cuerpo
     *
     * @param string $cuerpo
     *
     * @return EstadoCorreo
     */
    public function setCuerpo($cuerpo)
    {
        $this->cuerpo = $cuerpo;

        return $this;
    }

    /**
     * Get cuerpo
     *
     * @return string
     */
    public function getCuerpo()
    {
        return $this->cuerpo;
    }
    
    /**
     * Set estadoCorreo
     *
     * @param \CorreoBundle\Entity\EstadoCorreo $estadoCorreo
     *
     * @return EstadoCorreo
     */
    public function setEstadoCorreo(\CorreoBundle\Entity\EstadoCorreo $estadoCorreo = null)
    {
        $this->estadoCorreo = $estadoCorreo;

        return $this;
    }
    /**
     * Get estadoCorreo
     *
     * @return \CorreoBundle\Entity\EstadoCorreo
     */
    public function getEstadoCorreo()
    {
        return $this->estadoCorreo;
    }
}

