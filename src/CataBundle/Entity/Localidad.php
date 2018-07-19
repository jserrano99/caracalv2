<?php

namespace CataBundle\Entity;

/**
 * Localidades
 */
class Localidad
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $cd;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var \CataBundle\Entity\Provincia
     */
    private $provincia;


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
     * @param integer $cd
     *
     * @return Localidades
     */
    public function setCd($cd)
    {
        $this->cd = $cd;

        return $this;
    }

    /**
     * Get cd
     *
     * @return integer
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
     * @return Localidades
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
     * Set provincia
     *
     * @param \CataBundle\Entity\Provincia $provincia
     *
     * @return Localidades
     */
    public function setProvincia(\CataBundle\Entity\Provincia $provincia = null)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return \CataBundle\Entity\Provincia
     */
    public function getProvincia()
    {
        return $this->provincia;
    }
}

