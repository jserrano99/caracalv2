<?php

namespace CompeticionBundle\Entity;

/**
 * ClasificacionRonda
 */
class ClasificacionRonda
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \CompeticionBundle\Entity\Clasificacion
     */
    private $clasificacion;

    /**
     * @var \CompeticionBundle\Entity\Ronda
     */
    private $ronda;

    /**
     * @var int
     */
    private $puntos;

    /**
     * @var int
     */
    private $onces;

    /**
     * @var int
     */
    private $dieces;

   
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set clasificacion
     *
     * @param  \CompeticionBundle\Entity\Clasificacion
     *
     * @return ClasificacionRonda
     */
    public function setClasificacion(\CompeticionBundle\Entity\Clasificacion $clasificacion=null)
    {
        $this->clasificacion = $clasificacion;

        return $this;
    }

    /**
     * Get clasificacion
     *
     * @return \CompeticionBundle\Entity\Clasificacion
     */
    public function getClasificacion()
    {
        return $this->clasificacion;
    }

    /**
     * Set ronda
     *
     * @param  \CompeticionBundle\Entity\Ronda
     *
     * @return ClasificacionRonda
     */
    public function setRonda(\CompeticionBundle\Entity\Ronda $ronda=null)
    {
        $this->ronda = $ronda;

        return $this;
    }

    /**
     * Get rondaId
     *
     * @return CompeticionBundle\Entity\Ronda
     */
    public function getRonda()
    {
        return $this->ronda;
    }

    /**
     * Set puntos
     *
     * @param integer $puntos
     *
     * @return ClasificacionRonda
     */
    public function setPuntos($puntos)
    {
        $this->puntos = $puntos;

        return $this;
    }

    /**
     * Get puntos
     *
     * @return int
     */
    public function getPuntos()
    {
        return $this->puntos;
    }

    /**
     * Set onces
     *
     * @param integer $onces
     *
     * @return ClasificacionRonda
     */
    public function setOnces($onces)
    {
        $this->onces = $onces;

        return $this;
    }

    /**
     * Get onces
     *
     * @return int
     */
    public function getOnces()
    {
        return $this->onces;
    }

    /**
     * Set dieces
     *
     * @param integer $dieces
     *
     * @return ClasificacionRonda
     */
    public function setDieces($dieces)
    {
        $this->dieces = $dieces;

        return $this;
    }

    /**
     * Get dieces
     *
     * @return int
     */
    public function getDieces()
    {
        return $this->dieces;
    }

   
}

