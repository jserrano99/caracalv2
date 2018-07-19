<?php

namespace CompeticionBundle\Entity;

/**
 * MiembrosPatrulla
 */
class MiembroPatrulla
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \CompeticionBundle\Entity\Patrulla
     */
    private $patrulla;

    /**
     * @var \CompeticionBundle\Entity\PartiRonda
     */
    private $partiRonda;


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
     * Set patrulla
     *
     * @param \CompeticionBundle\Entity\Patrulla $patrulla
     *
     * @return MiembroPatrulla
     */
    public function setPatrulla(\CompeticionBundle\Entity\Patrulla $patrulla = null)
    {
        $this->patrulla = $patrulla;

        return $this;
    }

    /**
     * Get patrulla
     *
     * @return \CompeticionBundle\Entity\Patrulla
     */
    public function getPatrulla()
    {
        return $this->patrulla;
    }

    /**
     * Set partiRonda
     *
     * @param \CompeticionBundle\Entity\PartiRonda  $partiRonda)
     *
     * @return MiembroPatrulla
     */
    public function setPartiRonda(\CompeticionBundle\Entity\PartiRonda $partiRonda = null)
    {
        $this->partiRonda = $partiRonda;

        return $this;
    }

    /**
     * Get partiRonda
     *
     * @return \CompeticionBundle\Entity\PartiRonda
     */
    public function getPartiRonda()
    {
        return $this->partiRonda;
    }
}

