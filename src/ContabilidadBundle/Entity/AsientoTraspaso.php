<?php

namespace ContabilidadBundle\Entity;

/**
 * AsientoTraspaso
 */
class AsientoTraspaso
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $observaciones;

    /**
     * @var string
     */
    private $importe;

    /**
     * @var \ContabilidadBundle\Entity\CuentaMayor
     */
    private $cuentaDestino;

    /**
     * @var date
     */
    private $fecha;


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
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return AsientoTraspaso
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
     * Set importe
     *
     * @param string $importe
     *
     * @return AsientoTraspaso
     */
    public function setImporte($importe)
    {
        $this->importe = $importe;

        return $this;
    }

    /**
     * Get importe
     *
     * @return string
     */
    public function getImporte()
    {
        return $this->importe;
    }

    /**
     * Set cuentaDestino
     *
     * @param \ContabilidadBundle\Entity\CuentaMayor $cuentaDestino
     *
     * @return AsientoTraspaso
     */
    public function setCuentaDestino(\ContabilidadBundle\Entity\CuentaMayor $cuentaDestino=null )
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

    /**
     * Set fecha
     *
     * @param date $fecha
     *
     * @return AsientoTraspaso
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return date
     */
    public function getFecha()
    {
        return $this->fecha;
    }
}

