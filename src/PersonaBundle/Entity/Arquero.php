<?php

namespace PersonaBundle\Entity;

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
     * @var \PersonaBundle\Entity\Persona
     */
    private $persona;
	
	private $nombreArquero;

	public function __toString() {
		return $this->persona->getApenom().' -- {'.$this->club->getDescripcion().'}';
    }
	
	public function setNombreArquerp($param) {
		$this->nombreArquero = $this->persona->getApenom().' -- {'.$this->club->getDescripcion().'}';
		return $this;
	}
	
	public function getNombreArquero() {
		
		return $this->nombreArquero;
	}
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
     * @param \CataBundle\Entity\Club $club
     *
     * @return Arquero
     */
    public function setClub(\CataBundle\Entity\Club $club = null)
    {
        $this->club = $club;

        return $this;
    }

    /**
     * Get club
     *
     * @return \CataBundle\Entity\Club
     */
    public function getClub()
    {
        return $this->club;
    }

    /**
     * Set categoria
     *
     * @param \CataBundle\Entity\Categoria $categoria
     *
     * @return Arquero
     */
    public function setCategoria(\CataBundle\Entity\Categoria $categoria = null)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \CataBundle\Entity\Categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set persona
     *
     * @param \PersonaBundle\Entity\Persona $persona
     *
     * @return Arquero
     */
    public function setPersona(\PersonaBundle\Entity\Persona $persona = null)
    {
        $this->persona = $persona;

        return $this;
    }

    /**
     * Get persona
     *
     * @return \PersonaBundle\Entity\Persona
     */
    public function getPersona()
    {
        return $this->persona;
    }
}

