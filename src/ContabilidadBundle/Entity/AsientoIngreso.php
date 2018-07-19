<?php

namespace ContabilidadBundle\Entity;

/**
 * AsientoIngreso
 */
class AsientoIngreso
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var float
     */
    private $importe;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var string
     */
    private $observaciones;

    /**
     * @var \ContabilidadBundle\Entity\CuentaMayor
     */
    private $cuentaIngreso;

    /**
     * @var \ContabilidadBundle\Entity\Proyecto
     */
    private $proyecto;

    /**
     * @var \ContabilidadBundle\Entity\CuentaMayor
     */
    private $cuentaDestino;


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
     * Set importe
     *
     * @param float $importe
     *
     * @return AsientoIngreso
     */
    public function setImporte($importe)
    {
        $this->importe = $importe;

        return $this;
    }

    /**
     * Get importe
     *
     * @return float
     */
    public function getImporte()
    {
        return $this->importe;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return AsientoIngreso
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return AsientoIngreso
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
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return AsientoIngreso
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
     * Set cuentaIngreso
     *
     * @param \ContabilidadBundle\Entity\CuentaMayor $cuentaIngreso
     *
     * @return AsientoIngreso
     */
    public function setCuentaIngreso(\ContabilidadBundle\Entity\CuentaMayor $cuentaIngreso=null)
    {
        $this->cuentaIngreso = $cuentaIngreso;

        return $this;
    }

    /**
     * Get cuentaIngreso
     *
     * @return \ContabilidadBundle\Entity\CuentaMayor
     */
    public function getCuentaIngreso()
    {
        return $this->cuentaIngreso;
    }

    /**
     * Set proyecto
     *
     * @param \ContabilidadBundle\Entity\Proyecto $proyecto
     *
     * @return AsientoIngreso
     */
    public function setProyecto(\ContabilidadBundle\Entity\proyecto $proyecto=null)
    {
        $this->proyecto = $proyecto;

        return $this;
    }

    /**
     * Get proyecto
     *
     * @return \ContabilidadBundle\Entity\Proyecto
     */
    public function getProyecto()
    {
        return $this->proyecto;
    }

    /**
     * Set cuentaDestino
     *
     * @param \ContabilidadBundle\Entity\CuentaMayor $cuentaDestino
     *
     * @return AsientoIngreso
     */
    public function setCuentaDestino(\ContabilidadBundle\Entity\CuentaMayor $cuentaDestino=null)
    {
        $this->cuentaDestino = $cuentaDestino;

        return $this;
    }

    /**
     * Get cuentaDestino
     *
     * @return \ContabilidadBundle\Entity\CuentaMayor
     */
    public function getCuentaDestino()
    {
        return $this->cuentaDestino;
    }
}

