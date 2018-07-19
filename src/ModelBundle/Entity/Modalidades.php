<?php

namespace ModelBundle\Entity;

/**
 * Modalidades
 */
class Modalidades
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
     * @return Modalidades
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
     * @return Modalidades
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

