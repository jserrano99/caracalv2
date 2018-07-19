<?php

namespace ModelBundle\Entity;

/**
 * Ejercicios
 */
class Ejercicios
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
     * @var \DateTime
     */
    private $fcini;

    /**
     * @var \DateTime
     */
    private $fcfin;

    /**
     * @var integer
     */
    private $estado;

    /**
     * @var integer
     */
    private $asientoAperturaId;

    /**
     * @var integer
     */
    private $asientoRegularizacionId;

    /**
     * @var integer
     */
    private $asientoCierreId;


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
     * @return Ejercicios
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
     * Set fcini
     *
     * @param \DateTime $fcini
     *
     * @return Ejercicios
     */
    public function setFcini($fcini)
    {
        $this->fcini = $fcini;

        return $this;
    }

    /**
     * Get fcini
     *
     * @return \DateTime
     */
    public function getFcini()
    {
        return $this->fcini;
    }

    /**
     * Set fcfin
     *
     * @param \DateTime $fcfin
     *
     * @return Ejercicios
     */
    public function setFcfin($fcfin)
    {
        $this->fcfin = $fcfin;

        return $this;
    }

    /**
     * Get fcfin
     *
     * @return \DateTime
     */
    public function getFcfin()
    {
        return $this->fcfin;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return Ejercicios
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set asientoAperturaId
     *
     * @param integer $asientoAperturaId
     *
     * @return Ejercicios
     */
    public function setAsientoAperturaId($asientoAperturaId)
    {
        $this->asientoAperturaId = $asientoAperturaId;

        return $this;
    }

    /**
     * Get asientoAperturaId
     *
     * @return integer
     */
    public function getAsientoAperturaId()
    {
        return $this->asientoAperturaId;
    }

    /**
     * Set asientoRegularizacionId
     *
     * @param integer $asientoRegularizacionId
     *
     * @return Ejercicios
     */
    public function setAsientoRegularizacionId($asientoRegularizacionId)
    {
        $this->asientoRegularizacionId = $asientoRegularizacionId;

        return $this;
    }

    /**
     * Get asientoRegularizacionId
     *
     * @return integer
     */
    public function getAsientoRegularizacionId()
    {
        return $this->asientoRegularizacionId;
    }

    /**
     * Set asientoCierreId
     *
     * @param integer $asientoCierreId
     *
     * @return Ejercicios
     */
    public function setAsientoCierreId($asientoCierreId)
    {
        $this->asientoCierreId = $asientoCierreId;

        return $this;
    }

    /**
     * Get asientoCierreId
     *
     * @return integer
     */
    public function getAsientoCierreId()
    {
        return $this->asientoCierreId;
    }
}

