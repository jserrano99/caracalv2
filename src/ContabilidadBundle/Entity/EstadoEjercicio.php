<?php

namespace ContabilidadBundle\Entity;

/**
 * EstadoEjercicio
 */
class EstadoEjercicio
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $descripcion;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function __toString() {
        return $this->descripcion;
    }
    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return EstadoEjercicio
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
}

