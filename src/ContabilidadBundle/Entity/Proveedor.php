<?php

namespace ContabilidadBundle\Entity;

/**
 * Proveedores
 */
class Proveedor
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nif;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var \ContabilidadBundle\Entity\CuentaMayor
     */
    private $cuentaMayor;


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
     * Set nif
     *
     * @param string $nif
     *
     * @return Proveedores
     */
    public function setNif($nif)
    {
        $this->nif = $nif;

        return $this;
    }

    /**
     * Get nif
     *
     * @return string
     */
    public function getNif()
    {
        return $this->nif;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Proveedores
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
     * Set cuentaMayor
     *
     * @param \ContabilidadBundle\Entity\CuentasMayor $cuentaMayor
     *
     * @return Proveedores
     */
    public function setCuentaMayor(\ContabilidadBundle\Entity\CuentaMayor $cuentaMayor = null)
    {
        $this->cuentaMayor = $cuentaMayor;

        return $this;
    }

    /**
     * Get cuentaMayor
     *
     * @return \ContabilidadBundle\Entity\CuentaMayor
     */
    public function getCuentaMayor()
    {
        return $this->cuentaMayor;
    }
}

