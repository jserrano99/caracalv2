<?php

namespace CompeticionBundle\Entity;

/**
 * CompeticionesImagenes
 */
class ImagenCompeticion
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $imagen;

    /**
     * @var string
     */
    private $tipo;

    /**
     * @var \CompeticionBundle\Entity\Competicion
     */
    private $competicion;


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
     * Set imagen
     *
     * @param string $imagen
     *
     * @return CompeticionesImagenes
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return CompeticionesImagenes
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set competicion
     *
     * @param \CompeticiooBundle\Entity\Competicion $competicion
     *
     * @return CompeticionesImagenes
     */
    public function setCompeticion(\CompeticionBundle\Entity\Competicion $competicion = null)
    {
        $this->competicion = $competicion;

        return $this;
    }

    /**
     * Get competicion
     *
     * @return \CompeticionBundle\Entity\Competicion
     */
    public function getCompeticion()
    {
        return $this->competicion;
    }
}

