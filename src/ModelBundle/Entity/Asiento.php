<?php

namespace ModelBundle\Entity;

/**
 * Asientos
 */
class Asiento
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $numero;

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
     * @var float
     */
    private $importeDebe;

    /**
     * @var float
     */
    private $importeHaber;

    /**
     * @var \ModelBundle\Entity\Ejercicio
     */
    private $ejercicio;

    /**
     * @var \ModelBundle\Entity\Proyecto
     */
    private $proyecto;


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
     * Set numero
     *
     * @param integer $numero
     *
     * @return Asiento
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Asiento
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
     * @return Asiento
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
     * @return Asiento
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
     * Set importeDebe
     *
     * @param float $importeDebe
     *
     * @return Asiento
     */
    public function setImporteDebe($importeDebe)
    {
        $this->importeDebe = $importeDebe;

        return $this;
    }

    /**
     * Get importeDebe
     *
     * @return float
     */
    public function getImporteDebe()
    {
        return $this->importeDebe;
    }

    /**
     * Set importeHaber
     *
     * @param float $importeHaber
     *
     * @return Asiento
     */
    public function setImporteHaber($importeHaber)
    {
        $this->importeHaber = $importeHaber;

        return $this;
    }

    /**
     * Get importeHaber
     *
     * @return float
     */
    public function getImporteHaber()
    {
        return $this->importeHaber;
    }

    /**
     * Set ejercicio
     *
     * @param \ModelBundle\Entity\Ejercicio $ejercicio
     *
     * @return Asiento
     */
    public function setEjercicio(\ModelBundle\Entity\Ejercicio $ejercicio = null)
    {
        $this->ejercicio = $ejercicio;

        return $this;
    }

    /**
     * Get ejercicio
     *
     * @return \ModelBundle\Entity\Ejercicio
     */
    public function getEjercicio()
    {
        return $this->ejercicio;
    }

    /**
     * Set proyecto
     *
     * @param \ModelBundle\Entity\Proyecto $proyecto
     *
     * @return Asiento
     */
    public function setProyecto(\ModelBundle\Entity\Proyecto $proyecto = null)
    {
        $this->proyecto = $proyecto;

        return $this;
    }

    /**
     * Get proyecto
     *
     * @return \ModelBundle\Entity\Proyecto
     */
    public function getProyecto()
    {
        return $this->proyecto;
    }
}

