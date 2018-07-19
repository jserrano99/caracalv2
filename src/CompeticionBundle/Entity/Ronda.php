<?php

namespace CompeticionBundle\Entity;

/**
 * Rondas
 */
class Ronda
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
     * @var integer
     */
    private $num;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var integer
     */
    private $activa;

    /**
     * @var \CompeticionBundle\Entity\Competiciones
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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Rondas
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
     * Set num
     *
     * @param integer $num
     *
     * @return Rondas
     */
    public function setNum($num)
    {
        $this->num = $num;

        return $this;
    }

    /**
     * Get num
     *
     * @return integer
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Rondas
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
     * Set activa
     *
     * @param integer $activa
     *
     * @return Rondas
     */
    public function setActiva($activa)
    {
        $this->activa = $activa;

        return $this;
    }

    /**
     * Get activa
     *
     * @return integer
     */
    public function getActiva()
    {
        return $this->activa;
    }

    /**
     * Set competicion
     *
     * @param \CompeticionBundle\Entity\Competicion $competicion
     *
     * @return Rondas
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

