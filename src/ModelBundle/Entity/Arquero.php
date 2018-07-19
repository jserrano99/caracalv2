<?php

namespace ModelBundle\Entity;

/**
 * Arqueros
 */
class Arquero
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $licencia;

    /**
     * @var \ModelBundle\Entity\Club
     */
    private $club;

    /**
     * @var \ModelBundle\Entity\Categoria
     */
    private $categoria;

    /**
     * @var \ModelBundle\Entity\Persona
     */
    private $persona;


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
     * Set licencia
     *
     * @param string $licencia
     *
     * @return Arquero
     */
    public function setLicencia($licencia)
    {
        $this->licencia = $licencia;

        return $this;
    }

    /**
     * Get licencia
     *
     * @return string
     */
    public function getLicencia()
    {
        return $this->licencia;
    }

    /**
     * Set club
     *
     * @param \ModelBundle\Entity\Club $club
     *
     * @return Arquero
     */
    public function setClub(\ModelBundle\Entity\Club $club = null)
    {
        $this->club = $club;

        return $this;
    }

    /**
     * Get club
     *
     * @return \ModelBundle\Entity\Club
     */
    public function getClub()
    {
        return $this->club;
    }

    /**
     * Set categoria
     *
     * @param \ModelBundle\Entity\Categoria $categoria
     *
     * @return Arquero
     */
    public function setCategoria(\ModelBundle\Entity\Categoria $categoria = null)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \ModelBundle\Entity\Categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set persona
     *
     * @param \ModelBundle\Entity\Persona $persona
     *
     * @return Arquero
     */
    public function setPersona(\ModelBundle\Entity\Persona $persona = null)
    {
        $this->persona = $persona;

        return $this;
    }

    /**
     * Get persona
     *
     * @return \ModelBundle\Entity\Persona
     */
    public function getPersona()
    {
        return $this->persona;
    }
}

