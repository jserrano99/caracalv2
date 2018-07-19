<?php

namespace ContabilidadBundle\Entity;

/**
 * EjercicioActual
 */
class EjercicioActual
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \ContabilidadBundle\Entity\Ejercicio
     */
    private $ejercicio;


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
     * Set ejercicio
     *
     * @param \ContabilidadBundle\Entity\Ejercicio $ejercicio
     *
     * @return EjercicioActual
     */
    public function setEjercicio(\ContabilidadBundle\Entity\Ejercicio $ejercicio=null)
    {
        $this->ejercicio = $ejercicio;

        return $this;
    }

    /**
     * Get ejercicio
     *
     * @return \ContabilidadBundle\Entity\Ejercicio
     */
    public function getEjercicio()
    {
        return $this->ejercicio;
    }
}

