<?php

namespace CompeticionBundle\Entity;

/**
 * Clasificacion
 */
class Clasificacion
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \CompeticionBundle\Entity\Competicion
     */
    private $competicion;

    /**
     * @var \CompeticionBundle\Entity\Participante
     */
    private $participante;

    /**
     * @var int
     */
    private $totalPuntos;

    /**
     * @var int
     */
    private $totalOnces;

    /**
     * @var int
     */
    private $totalDieces;

    /**
     * @var int
     */
    private $categoria;

    /**
     * @var int
     */
    private $modalidad;

    /**
     * @var int
     */
    private $menor;


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
     * Set competicionId
     *
     * @param   \CompeticionBundle\Entity\Competicion
     *
     * @return Clasificacion
     */
    public function setCompeticion( \CompeticionBundle\Entity\Competicion $competicion =null)
    {
        $this->competicion = $competicion;

        return $this;
    }

    /**
     * Get competicion
     *
     * @return  \CompeticionBundle\Entity\Competicion
     */
    public function getCompeticion()
    {
        return $this->competicion;
    }

    /**
     * Set participante
     *
     * @param   \CompeticionBundle\Entity\Participante
     *
     * @return Clasificacion
     */
    public function setParticipante (\CompeticionBundle\Entity\Participante $participante = null)
    {
        $this->participante = $participante;

        return $this;
    }

    /**
     * Get  \CompeticionBundle\Entity\Participante
     *
     * @return int
     */
    public function getParticipante()
    {
        return $this->participante;
    }

    /**
     * Set totalPuntos
     *
     * @param integer $totalPuntos
     *
     * @return Clasificacion
     */
    public function setTotalPuntos($totalPuntos)
    {
        $this->totalPuntos = $totalPuntos;

        return $this;
    }

    /**
     * Get totalPuntos
     *
     * @return int
     */
    public function getTotalPuntos()
    {
        return $this->totalPuntos;
    }

    /**
     * Set totalOnces
     *
     * @param integer $totalOnces
     *
     * @return Clasificacion
     */
    public function setTotalOnces($totalOnces)
    {
        $this->totalOnces = $totalOnces;

        return $this;
    }

    /**
     * Get totalOnces
     *
     * @return int
     */
    public function getTotalOnces()
    {
        return $this->totalOnces;
    }

    /**
     * Set totalDieces
     *
     * @param integer $totalDieces
     *
     * @return Clasificacion
     */
    public function setTotalDieces($totalDieces)
    {
        $this->totalDieces = $totalDieces;

        return $this;
    }

    /**
     * Get totalDieces
     *
     * @return int
     */
    public function getTotalDieces()
    {
        return $this->totalDieces;
    }

    /**
     * Set categoria
     *
     * @param   \CataBundle\Entity\Categoria
     *
     * @return Clasificacion
     */
    public function setCategoria(\CataBundle\Entity\Categoria $categoria = null)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return  \CataBundle\Entity\Categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set modalidad
     *
     * @param   \CataBundle\Entity\Modalidad
     *
     * @return Clasificacion
     */
    public function setModalidad(\CataBundle\Entity\Modalidad $modalidad=null)
    {
        $this->modalidad = $modalidad;

        return $this;
    }

    /**
     * Get modalidad
     *
     * @return \CataBundle\Entity\Modalidad
     */
    public function getModalidad()
    {
        return $this->modalidad;
    }

	
	 /**
     * Set menor
     *
     * @param string $menor
     *
     * @return ClasificacionRonda
     */
    public function setMenor($menor)
    {
        $this->menor = $menor;

        return $this;
    }

    /**
     * Get menor
     *
     * @return string
     */
    public function getMenor()
    {
        return $this->menor;
    }
}

