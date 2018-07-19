<?php

namespace CataBundle\Entity;

/**
 * Modalidades
 */
class Modalidad
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $cd;

    /**
     * @var string
     */
    private $descripcion;

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
     * Set cd
     *
     * @param string $cd
     *
     * @return Modalidad
     */
    public function setCd($cd)
    {
        $this->cd = $cd;

        return $this;
    }

    /**
     * Get cd
     *
     * @return string
     */
    public function getCd()
    {
        return $this->cd;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Modalidad
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
}

