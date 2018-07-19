<?php

namespace ContabilidadBundle\Entity;

/**
 * Ejercicio
 */
class Ejercicio
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var \DateTime
     */
    private $fcini;

    /**
     * @var \DateTime
     */
    private $fcfin;

    /**
     * @var \ContabilidadBundle\Entity\EstadoEjercicio
     */
    private $estadoEjercicio;

    /**
     * @var \ContabilidadBundle\Entity\Asiento
     */
    private $asientoApertura;

    /**
     * @var \ContabilidadBundle\Entity\Asiento
     */
    private $asientoRegularizacion;

    /**
     * @var \ContabilidadBundle\Entity\Asiento
     */
    private $asientoCierre;


    public function __toString() {
        return $this->descripcion;
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Ejercicio
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

    /**
     * Set fcini
     *
     * @param \DateTime $fcini
     *
     * @return Ejercicio
     */
    public function setFcini($fcini)
    {
        $this->fcini = $fcini;

        return $this;
    }

    /**
     * Get fcini
     *
     * @return \DateTime
     */
    public function getFcini()
    {
        return $this->fcini;
    }

    /**
     * Set fcfin
     *
     * @param \DateTime $fcfin
     *
     * @return Ejercicio
     */
    public function setFcfin($fcfin)
    {
        $this->fcfin = $fcfin;

        return $this;
    }

    /**
     * Get fcfin
     *
     * @return \DateTime
     */
    public function getFcfin()
    {
        return $this->fcfin;
    }

    /**
     * Set estadoEjercicio
     *
     * @param integer \ContabilidadBundle\Entity\EstadoEjercicio
     *
     * @return Ejercicio
     */
    public function setEstadoEjercicio(\ContabilidadBundle\Entity\EstadoEjercicio $estadoEjercicio=null)
    {
        $this->estadoEjercicio = $estadoEjercicio;

        return $this;
    }

    /** 
     * Get estado
     *
     * @return integer
     */
    public function getEstadoEjercicio()
    {
        return $this->estadoEjercicio;
    }

    /**
     * Set asientoApertura
     *
     * @param \ContabilidadBundle\Entity\Asiento $asientoApertura
     *
     * @return Ejercicio
     */
    public function setAsientoApertura(\ContabilidadBundle\Entity\Asiento $asientoApertura = null)
    {
        $this->asientoApertura = $asientoApertura;

        return $this;
    }

    /**
     * Get $asientoApertura
     *
     * @return \ContabilidadBundle\Entity\Asiento
     */
    public function getAsientoApertura()
    {
        return $this->asientoApertura;
    }
    /**
     * Set asientoCierre
     *
     * @param \ContabilidadBundle\Entity\Asiento $asientoCierre
     *
     * @return Ejercicio
     */
    public function setAsientoCierre(\ContabilidadBundle\Entity\Asiento $asientoCierre = null)
    {
        $this->asientoCierre = $asientoCierre;

        return $this;
    }

    /**
     * Get $asientoCierre
     *
     * @return \ContabilidadBundle\Entity\Asiento
     */
    public function getAsientoCierre()
    {
        return $this->asientoCierre;
    }

    /**
     * Set asientoRegularizacion
     *
     * @param \ContabilidadBundle\Entity\Asiento $asientoRegularizacion
     *
     * @return Ejercicio
     */
    public function setAsientoRegularizacion(\ContabilidadBundle\Entity\Asiento $asientoRegularizacion = null)
    {
        $this->asientoRegularizacion = $asientoRegularizacion;

        return $this;
    }

    /**
     * Get $asientoRegularizacion
     *
     * @return \ContabilidadBundle\Entity\Asiento
     */
    public function getAsientoRegularizacion()
    {
        return $this->asientoRegularizacion;
    }
}

