<?php

namespace ModelBundle\Entity;

/**
 * ModoEstructura
 */
class ModoEstructura
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \ModelBundle\Entity\Modos
     */
    private $modo;

    /**
     * @var \ModelBundle\Entity\Divisiones
     */
    private $division;

    /**
     * @var \ModelBundle\Entity\Categorias
     */
    private $categoria;

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
     * Set modo
     *
     * @param \ModelBundle\Entity\Modos $modo
     *
     * @return ModoEstructura
     */
    public function setModo(\ModelBundle\Entity\Modos $modo = null)
    {
        $this->modo = $modo;

        return $this;
    }

    /**
     * Get modo
     *
     * @return \ModelBundle\Entity\Modos
     */
    public function getModo()
    {
        return $this->modo;
    }

    /**
     * Set division
     *
     * @param \ModelBundle\Entity\Divisiones $division
     *
     * @return ModoEstructura
     */
    public function setDivision(\ModelBundle\Entity\Divisiones $division = null)
    {
        $this->division = $division;

        return $this;
    }

    /**
     * Get division
     *
     * @return \ModelBundle\Entity\Divisiones
     */
    public function getDivision()
    {
        return $this->division;
    }

    /**
     * Set categoria
     *
     * @param \ModelBundle\Entity\Categorias $categoria
     *
     * @return ModoEstructura
     */
    public function setCategoria(\ModelBundle\Entity\Categorias $categoria = null)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \ModelBundle\Entity\Categorias
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set modalidad
     *
     * @param \ModelBundle\Entity\Modalidades $modalidad
     *
     * @return ModoEstructura
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

