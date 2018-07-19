<?php

namespace ModelBundle\Entity;

/**
 * Apuntes
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
     * @var \ModelBundle\Entity\Asientos
     */
    private $asiento;

    /**
     * @var \ModelBundle\Entity\CuentasMayor
     */
    private $cuentaDebe;

    /**
     * @var \ModelBundle\Entity\CuentasMayor
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
     * @return Apuntes
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
     * @return Apuntes
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
     * @return Apuntes
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
     * @return Apuntes
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
     * @return Apuntes
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
     * @param \ModelBundle\Entity\Asiento $asiento
     *
     * @return Apunte
     */
    public function setAsiento(\ModelBundle\Entity\Asiento $asiento = null)
    {
        $this->asiento = $asiento;

        return $this;
    }

    /**
     * Get asiento
     *
     * @return \ModelBundle\Entity\Asiento
     */
    public function getAsiento()
    {
        return $this->asiento;
    }

    /**
     * Set cuentaDebe
     *
     * @param \ModelBundle\Entity\CuentasMayor $cuentaDebe
     *
     * @return Apuntes
     */
    public function setCuentaDebe(\ModelBundle\Entity\CuentaMayor $cuentaDebe = null)
    {
        $this->cuentaDebe = $cuentaDebe;

        return $this;
    }

    /**
     * Get cuentaDebe
     *
     * @return \ModelBundle\Entity\CuentaMayor
     */
    public function getCuentaDebe()
    {
        return $this->cuentaDebe;
    }

    /**
     * Set cuentaHaber
     *
     * @param \ModelBundle\Entity\CuentaMayor $cuentaHaber
     *
     * @return Apunte
     */
    public function setCuentaHaber(\ModelBundle\Entity\CuentaMayor $cuentaHaber = null)
    {
        $this->cuentaHaber = $cuentaHaber;

        return $this;
    }

    /**
     * Get cuentaHaber
     *
     * @return \ModelBundle\Entity\CuentaMayor
     */
    public function getCuentaHaber()
    {
        return $this->cuentaHaber;
    }
}

