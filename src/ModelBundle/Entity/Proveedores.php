<?php

namespace ModelBundle\Entity;

/**
 * Proveedores
 */
class Proveedores
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
     * @var \ModelBundle\Entity\CuentasMayor
     */
    private $cuentaMayor;


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
     * @param \ModelBundle\Entity\CuentasMayor $cuentaMayor
     *
     * @return Proveedores
     */
    public function setCuentaMayor(\ModelBundle\Entity\CuentasMayor $cuentaMayor = null)
    {
        $this->cuentaMayor = $cuentaMayor;

        return $this;
    }

    /**
     * Get cuentaMayor
     *
     * @return \ModelBundle\Entity\CuentasMayor
     */
    public function getCuentaMayor()
    {
        return $this->cuentaMayor;
    }
}

