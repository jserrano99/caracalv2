<?php

namespace ModelBundle\Entity;

/**
 * Patrullas
 */
class Patrullas
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
     * @var \ModelBundle\Entity\Rondas
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
     * @param \ModelBundle\Entity\Rondas $ronda
     *
     * @return Patrullas
     */
    public function setRonda(\ModelBundle\Entity\Rondas $ronda = null)
    {
        $this->ronda = $ronda;

        return $this;
    }

    /**
     * Get ronda
     *
     * @return \ModelBundle\Entity\Rondas
     */
    public function getRonda()
    {
        return $this->ronda;
    }
}

