<?php

namespace CompeticionBundle\Entity;

/**
 * Patrullas
 */
class Patrulla
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $numero;

    /**
     * @var \CompeticionBundle\Entity\Ronda
     */
    private $ronda;


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
     * Set numero
     *
     * @param integer $numero
     *
     * @return Patrullas
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set ronda
     *
     * @param \CompeticionBundle\Entity\Rondas $ronda
     *
     * @return Patrulla
     */
    public function setRonda(\CompeticionBundle\Entity\Ronda $ronda = null)
    {
        $this->ronda = $ronda;

        return $this;
    }

    /**
     * Get ronda
     *
     * @return \CompeticionBundle\Entity\Ronda
     */
    public function getRonda()
    {
        return $this->ronda;
    }
}

