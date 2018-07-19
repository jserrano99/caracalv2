<?php

namespace ContabilidadBundle\Entity;

/**
 * Apunte
 */
class Apunte
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
     * @var float
     */
    private $importeDebe;

    /**
     * @var float
     */
    private $importeHaber;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var string
     */
    private $observaciones;

    /**
     * @var \ContabilidadBundle\Entity\Asiento
     */
    private $asiento;

    /**
     * @var \ContabilidadBundle\Entity\CuentaMayor
     */
    private $cuentaDebe;

    /**
     * @var \ContabilidadBundle\Entity\CuentaMayor
     */
    private $cuentaHaber;


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
     * @return Apunte
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
     * Set importeDebe
     *
     * @param float $importeDebe
     *
     * @return Apunte
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
     * @return Apunte
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Apunte
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
     * @return Apunte
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
     * Set asiento
     *
     * @param \ContabilidadBundle\Entity\Asiento $asiento
     *
     * @return Apunte
     */
    public function setAsiento(\ContabilidadBundle\Entity\Asiento $asiento = null)
    {
        $this->asiento = $asiento;

        return $this;
    }

    /**
     * Get asiento
     *
     * @return \ContabilidadBundle\Entity\Asiento
     */
    public function getAsiento()
    {
        return $this->asiento;
    }

    /**
     * Set cuentaDebe
     *
     * @param \ContabilidadBundle\Entity\CuentasMayor $cuentaDebe
     *
     * @return Apunte
     */
    public function setCuentaDebe(\ContabilidadBundle\Entity\CuentaMayor $cuentaDebe = null)
    {
        $this->cuentaDebe = $cuentaDebe;

        return $this;
    }

    /**
     * Get cuentaDebe
     *
     * @return \ContabilidadBundle\Entity\CuentaMayor
     */
    public function getCuentaDebe()
    {
        return $this->cuentaDebe;
    }

    /**
     * Set cuentaHaber
     *
     * @param \ContabilidadBundle\Entity\CuentaMayor $cuentaHaber
     *
     * @return Apunte
     */
    public function setCuentaHaber(\ContabilidadBundle\Entity\CuentaMayor $cuentaHaber = null)
    {
        $this->cuentaHaber = $cuentaHaber;

        return $this;
    }

    /**
     * Get cuentaHaber
     *
     * @return \ContabilidadBundle\Entity\CuentaMayor
     */
    public function getCuentaHaber()
    {
        return $this->cuentaHaber;
    }
}

