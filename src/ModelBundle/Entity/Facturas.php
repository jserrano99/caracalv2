<?php

namespace ModelBundle\Entity;

/**
 * Facturas
 */
class Facturas
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $numero;

    /**
     * @var string
     */
    private $serie;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var float
     */
    private $importe;

    /**
     * @var float
     */
    private $baseIva;

    /**
     * @var float
     */
    private $cuotaIva;

    /**
     * @var string
     */
    private $fichero;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var \ModelBundle\Entity\Proveedores
     */
    private $proveedor;

    /**
     * @var \ModelBundle\Entity\Asientos
     */
    private $asiento;


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
     * @param string $numero
     *
     * @return Facturas
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set serie
     *
     * @param string $serie
     *
     * @return Facturas
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * Get serie
     *
     * @return string
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Facturas
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
     * Set importe
     *
     * @param float $importe
     *
     * @return Facturas
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
     * Set baseIva
     *
     * @param float $baseIva
     *
     * @return Facturas
     */
    public function setBaseIva($baseIva)
    {
        $this->baseIva = $baseIva;

        return $this;
    }

    /**
     * Get baseIva
     *
     * @return float
     */
    public function getBaseIva()
    {
        return $this->baseIva;
    }

    /**
     * Set cuotaIva
     *
     * @param float $cuotaIva
     *
     * @return Facturas
     */
    public function setCuotaIva($cuotaIva)
    {
        $this->cuotaIva = $cuotaIva;

        return $this;
    }

    /**
     * Get cuotaIva
     *
     * @return float
     */
    public function getCuotaIva()
    {
        return $this->cuotaIva;
    }

    /**
     * Set fichero
     *
     * @param string $fichero
     *
     * @return Facturas
     */
    public function setFichero($fichero)
    {
        $this->fichero = $fichero;

        return $this;
    }

    /**
     * Get fichero
     *
     * @return string
     */
    public function getFichero()
    {
        return $this->fichero;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Facturas
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
     * Set proveedor
     *
     * @param \ModelBundle\Entity\Proveedores $proveedor
     *
     * @return Facturas
     */
    public function setProveedor(\ModelBundle\Entity\Proveedores $proveedor = null)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    /**
     * Get proveedor
     *
     * @return \ModelBundle\Entity\Proveedores
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }

    /**
     * Set asiento
     *
     * @param \ModelBundle\Entity\Asientos $asiento
     *
     * @return Facturas
     */
    public function setAsiento(\ModelBundle\Entity\Asientos $asiento = null)
    {
        $this->asiento = $asiento;

        return $this;
    }

    /**
     * Get asiento
     *
     * @return \ModelBundle\Entity\Asientos
     */
    public function getAsiento()
    {
        return $this->asiento;
    }
}

