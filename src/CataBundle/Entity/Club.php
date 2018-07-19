<?php

namespace CataBundle\Entity;

/**
 * Club
 */
class Club
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
     * @var \CataBundle\Entity\Federaciones
     */
    private $federacion;

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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Club
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
     * Set federacion
     *
     * @param \CataBundle\Entity\Federacion$federacion
     *
     * @return Club
     */
    public function setFederacion(\CataBundle\Entity\Federacion $federacion = null)
    {
        $this->federacion = $federacion;

        return $this;
    }

    /**
     * Get federacion
     *
     * @return \CataBundle\Entity\Federacion
     */
    public function getFederacion()
    {
        return $this->federacion;
    }
}

