<?php

namespace CompeticionBundle\Entity;

/**
 * Competicion
 */
class Competicion
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var integer
     */
    private $descontar;

    /**
     * @var \CataBundle\Entity\Modo
     */
    private $modo;

    /**
     * @var \CataBundle\Entity\TipoCompeticion
     */
    private $tipoCompeticion;


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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Competicion
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Competicion
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
     * Set descontar
     *
     * @param integer $descontar
     *
     * @return Competicion
     */
    public function setDescontar($descontar)
    {
        $this->descontar = $descontar;

        return $this;
    }

    /**
     * Get descontar
     *
     * @return integer
     */
    public function getDescontar()
    {
        return $this->descontar;
    }

    /**
     * Set modo
     *
     * @param \CataBundle\Entity\Modo $modo
     *
     * @return Competicion
     */
    public function setModo(\CataBundle\Entity\Modo $modo = null)
    {
        $this->modo = $modo;

        return $this;
    }

    /**
     * Get modo
     *
     * @return \CataBundle\Entity\Modo
     */
    public function getModo()
    {
        return $this->modo;
    }

    /**
     * Set tipoCompeticion
     *
     * @param \CataBundle\Entity\TipoCompeticion $tipoCompeticion
     *
     * @return Competicion
     */
    public function setTipoCompeticion(\CataBundle\Entity\TipoCompeticion $tipoCompeticion = null)
    {
        $this->tipoCompeticion = $tipoCompeticion;

        return $this;
    }

    /**
     * Get tipoCompeticion
     *
     * @return \CataBundle\Entity\TipoCompeticion
     */
    public function getTipoCompeticion()
    {
        return $this->tipoCompeticion;
    }
}

