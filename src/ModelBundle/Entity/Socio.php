<?php

namespace ModelBundle\Entity;

/**
 * Socios
 */
class Socio
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $nmsocio;

    /**
     * @var string
     */
    private $licenciaMonitor;

    /**
     * @var string
     */
    private $numeroLicencia;

    /**
     * @var \DateTime
     */
    private $fcalta;

    /**
     * @var \DateTime
     */
    private $fcbaja;

    /**
     * @var string
     */
    private $observaciones;

    /**
     * @var \ModelBundle\Entity\Persona
     */
    private $persona;

    /**
     * @var \ModelBundle\Entity\Estado
     */
    private $estado;


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
     * Set nmsocio
     *
     * @param integer $nmsocio
     *
     * @return Socios
     */
    public function setNmsocio($nmsocio)
    {
        $this->nmsocio = $nmsocio;

        return $this;
    }

    /**
     * Get nmsocio
     *
     * @return integer
     */
    public function getNmsocio()
    {
        return $this->nmsocio;
    }

    /**
     * Set licenciaMonitor
     *
     * @param string $licenciaMonitor
     *
     * @return Socios
     */
    public function setLicenciaMonitor($licenciaMonitor)
    {
        $this->licenciaMonitor = $licenciaMonitor;

        return $this;
    }

    /**
     * Get licenciaMonitor
     *
     * @return string
     */
    public function getLicenciaMonitor()
    {
        return $this->licenciaMonitor;
    }

    /**
     * Set numeroLicencia
     *
     * @param string $numeroLicencia
     *
     * @return Socios
     */
    public function setNumeroLicencia($numeroLicencia)
    {
        $this->numeroLicencia = $numeroLicencia;

        return $this;
    }

    /**
     * Get numeroLicencia
     *
     * @return string
     */
    public function getNumeroLicencia()
    {
        return $this->numeroLicencia;
    }

    /**
     * Set fcalta
     *
     * @param \DateTime $fcalta
     *
     * @return Socios
     */
    public function setFcalta($fcalta)
    {
        $this->fcalta = $fcalta;

        return $this;
    }

    /**
     * Get fcalta
     *
     * @return \DateTime
     */
    public function getFcalta()
    {
        return $this->fcalta;
    }

    /**
     * Set fcbaja
     *
     * @param \DateTime $fcbaja
     *
     * @return Socios
     */
    public function setFcbaja($fcbaja)
    {
        $this->fcbaja = $fcbaja;

        return $this;
    }

    /**
     * Get fcbaja
     *
     * @return \DateTime
     */
    public function getFcbaja()
    {
        return $this->fcbaja;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return Socios
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set persona
     *
     * @param \ModelBundle\Entity\Personas $persona
     *
     * @return Socios
     */
    public function setPersona(\ModelBundle\Entity\Persona $persona = null)
    {
        $this->persona = $persona;

        return $this;
    }

    /**
     * Get persona
     *
     * @return \ModelBundle\Entity\Personas
     */
    public function getPersona()
    {
        return $this->persona;
    }

    /**
     * Set estado
     *
     * @param \ModelBundle\Entity\Estados $estado
     *
     * @return Socios
     */
    public function setEstado(\ModelBundle\Entity\Estado $estado = null)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return \ModelBundle\Entity\Estados
     */
    public function getEstado()
    {
        return $this->estado;
    }
}

