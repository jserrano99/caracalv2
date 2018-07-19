<?php

namespace ModelBundle\Entity;

/**
 * OrigenIngresos
 */
class OrigenIngresos
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return OrigenIngresos
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
     * @return OrigenIngresos
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

