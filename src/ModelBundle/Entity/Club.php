<?php

namespace ModelBundle\Entity;

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
     * @var \ModelBundle\Entity\Federaciones
     */
    private $federacion;


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
     * @param \ModelBundle\Entity\Federacion$federacion
     *
     * @return Club
     */
    public function setFederacion(\ModelBundle\Entity\Federacion $federacion = null)
    {
        $this->federacion = $federacion;

        return $this;
    }

    /**
     * Get federacion
     *
     * @return \ModelBundle\Entity\Federacion
     */
    public function getFederacion()
    {
        return $this->federacion;
    }
}

