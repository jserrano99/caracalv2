<?php

namespace ModelBundle\Entity;

/**
 * MiembrosPatrulla
 */
class MiembrosPatrulla
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \ModelBundle\Entity\Patrullas
     */
    private $patrulla;

    /**
     * @var \ModelBundle\Entity\ParticipantesRondas
     */
    private $participanteRonda;


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
     * @param \ModelBundle\Entity\Patrullas $patrulla
     *
     * @return MiembrosPatrulla
     */
    public function setPatrulla(\ModelBundle\Entity\Patrullas $patrulla = null)
    {
        $this->patrulla = $patrulla;

        return $this;
    }

    /**
     * Get patrulla
     *
     * @return \ModelBundle\Entity\Patrullas
     */
    public function getPatrulla()
    {
        return $this->patrulla;
    }

    /**
     * Set participanteRonda
     *
     * @param \ModelBundle\Entity\ParticipantesRondas $participanteRonda
     *
     * @return MiembrosPatrulla
     */
    public function setParticipanteRonda(\ModelBundle\Entity\ParticipantesRondas $participanteRonda = null)
    {
        $this->participanteRonda = $participanteRonda;

        return $this;
    }

    /**
     * Get participanteRonda
     *
     * @return \ModelBundle\Entity\ParticipantesRondas
     */
    public function getParticipanteRonda()
    {
        return $this->participanteRonda;
    }
}

