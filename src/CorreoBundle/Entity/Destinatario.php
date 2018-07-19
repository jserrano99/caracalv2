<?php

namespace CorreoBundle\Entity;

/**
 * Destinatario
 */
class Destinatario
{
    /**
     * @var int
     */
    private $id;
    
    /**
    * @var \CorreoBundle\Entity\Correo
    */
    private $correo;

    /**
    * @var \PersonaBundle\Entity\Persona
    */
    private $persona;

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
     * Set persona
     *
     * @param \PersonaBundle\Entity\Persona $persona
     *
     * @return Persona
     */
    public function setPersona(\PersonaBundle\Entity\Persona $persona = null)
    {
        $this->persona = $persona;

        return $this;
    }
    /**
     * Get persona
     *
     * @return \PersonaBundle\Entity\Persona
     */
    public function getPersona()
    {
        return $this->persona;
    }
    
    /**
     * Set correo
     *
     * @param \CorreoBundle\Entity\Correo $correo
     *
     * @return Correo
     */
    public function setCorreo(\CorreoBundle\Entity\Correo $correo = null)
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
}

