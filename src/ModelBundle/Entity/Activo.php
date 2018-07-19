<?php

namespace ModelBundle\Entity;

/**
 * Activos
 */
class Activo
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
     * @var integer
     */
    private $inventario;

    /**
     * @var \DateTime
     */
    private $fcadquision;

    /**
     * @var float
     */
    private $importeCompra;

    /**
     * @var float
     */
    private $importeAmortizado;


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
     * @return Activos
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
     * Set inventario
     *
     * @param integer $inventario
     *
     * @return Activos
     */
    public function setInventario($inventario)
    {
        $this->inventario = $inventario;

        return $this;
    }

    /**
     * Get inventario
     *
     * @return integer
     */
    public function getInventario()
    {
        return $this->inventario;
    }

    /**
     * Set fcadquision
     *
     * @param \DateTime $fcadquision
     *
     * @return Activos
     */
    public function setFcadquision($fcadquision)
    {
        $this->fcadquision = $fcadquision;

        return $this;
    }

    /**
     * Get fcadquision
     *
     * @return \DateTime
     */
    public function getFcadquision()
    {
        return $this->fcadquision;
    }

    /**
     * Set importeCompra
     *
     * @param float $importeCompra
     *
     * @return Activos
     */
    public function setImporteCompra($importeCompra)
    {
        $this->importeCompra = $importeCompra;

        return $this;
    }

    /**
     * Get importeCompra
     *
     * @return float
     */
    public function getImporteCompra()
    {
        return $this->importeCompra;
    }

    /**
     * Set importeAmortizado
     *
     * @param float $importeAmortizado
     *
     * @return Activos
     */
    public function setImporteAmortizado($importeAmortizado)
    {
        $this->importeAmortizado = $importeAmortizado;

        return $this;
    }

    /**
     * Get importeAmortizado
     *
     * @return float
     */
    public function getImporteAmortizado()
    {
        return $this->importeAmortizado;
    }
}

