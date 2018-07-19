<?php

namespace ModelBundle\Entity;

/**
 * Participantes
 */
class Participantes
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
     * @var \ModelBundle\Entity\Arqueros
     */
    private $arquero;

    /**
     * @var \ModelBundle\Entity\Competiciones
     */
    private $competicion;

    /**
     * @var \ModelBundle\Entity\Modalidades
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
     * @param \ModelBundle\Entity\Arqueros $arquero
     *
     * @return Participantes
     */
    public function setArquero(\ModelBundle\Entity\Arqueros $arquero = null)
    {
        $this->arquero = $arquero;

        return $this;
    }

    /**
     * Get arquero
     *
     * @return \ModelBundle\Entity\Arqueros
     */
    public function getArquero()
    {
        return $this->arquero;
    }

    /**
     * Set competicion
     *
     * @param \ModelBundle\Entity\Competiciones $competicion
     *
     * @return Participantes
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

    /**
     * Set modalidad
     *
     * @param \ModelBundle\Entity\Modalidades $modalidad
     *
     * @return Participantes
     */
    public function setModalidad(\ModelBundle\Entity\Modalidades $modalidad = null)
    {
        $this->modalidad = $modalidad;

        return $this;
    }

    /**
     * Get modalidad
     *
     * @return \ModelBundle\Entity\Modalidades
     */
    public function getModalidad()
    {
        return $this->modalidad;
    }
}

