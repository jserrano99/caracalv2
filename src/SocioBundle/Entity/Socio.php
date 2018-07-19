<?php

namespace SocioBundle\Entity;

/**
 * Socio
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
     * @var \PersonaBundle\Entity\Persona
     */
    private $persona;

    /**
     * @var \CataBundle\Entity\Estado
     */
    private $estado;
	 /**
     * @var string
     */
	private $foto;
	
	
	public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set foto
     *
     * @param string foto
     *
     * @return Socio
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }
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
     * @return Socio
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
     * @return Socio
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
     * @return Socio
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
     * @return Socio
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
     * @return Socio
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
     * @return Socio
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
     * @param \PersonaBundle\Entity\Persona $persona
     *
     * @return Socio
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
     * Set estado
     *
     * @param \CataBundle\Entity\Estado $estado
     *
     * @return Socio
     */
    public function setEstado(\CataBundle\Entity\Estado $estado = null)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return \CataBundle\Entity\Estado
     */
    public function getEstado()
    {
        return $this->estado;
    }
}

