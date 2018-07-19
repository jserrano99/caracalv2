<?php

namespace ModelBundle\Entity;

/**
 * CompeticionesImagenes
 */
class CompeticionesImagenes
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
     * @var \ModelBundle\Entity\Competiciones
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
     * @param \ModelBundle\Entity\Competiciones $competicion
     *
     * @return CompeticionesImagenes
     */
    public function setCompeticion(\ModelBundle\Entity\Competiciones $competicion = null)
    {
        $this->competicion = $competicion;

        return $this;
    }

    /**
     * Get competicion
     *
     * @return \ModelBundle\Entity\Competiciones
     */
    public function getCompeticion()
    {
        return $this->competicion;
    }
}

