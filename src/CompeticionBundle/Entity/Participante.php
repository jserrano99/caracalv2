<?php

namespace CompeticionBundle\Entity;

/**
 * Participantes
 */
class Participante
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $dorsal;

    /**
     * @var \PersonaBundle\Entity\Arquero
     */
    private $arquero;

    /**
     * @var \CompeticionBundle\Entity\Competicion
     */
    private $competicion;

    /**
     * @var \CataBundle\Entity\Modalidad
     */
    private $modalidad;


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
     * Set dorsal
     *
     * @param integer $dorsal
     *
     * @return Participantes
     */
    public function setDorsal($dorsal)
    {
        $this->dorsal = $dorsal;

        return $this;
    }

    /**
     * Get dorsal
     *
     * @return integer
     */
    public function getDorsal()
    {
        return $this->dorsal;
    }

    /**
     * Set arquero
     *
     * @param \PersonaBundle\Entity\Arquero $arquero
     *
     * @return Participantes
     */
    public function setArquero(\PersonaBundle\Entity\Arquero $arquero = null)
    {
        $this->arquero = $arquero;

        return $this;
    }

    /**
     * Get arquero
     *
     * @return \PersonaBundle\Entity\Arquero
     */
    public function getArquero()
    {
        return $this->arquero;
    }

    /**
     * Set competicion
     *
     * @param \CompeticionBundle\Entity\Competiciones $competicion
     *
     * @return Participantes
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

    /**
     * Set modalidad
     *
     * @param \CataBundle\Entity\Modalidad $modalidad
     *
     * @return Participantes
     */
    public function setModalidad(\CataBundle\Entity\Modalidad $modalidad = null)
    {
        $this->modalidad = $modalidad;

        return $this;
    }

    /**
     * Get modalidad
     *
     * @return \CompeticionBundle\Entity\Modalidad
     */
    public function getModalidad()
    {
        return $this->modalidad;
    }
}

