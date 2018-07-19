<?php

namespace CataBundle\Entity;

/**
 * Categorias
 */
class Categoria
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $codigo;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var integer
     */
    private $edadDesde;

    /**
     * @var integer
     */
    private $edadHasta;


	public function __toString() {
		return $this->descripcion;
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
     * Set codigo
     *
     * @param string $codigo
     *
     * @return Categoria
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Categoria
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

    /**
     * Set edadDesde
     *
     * @param integer $edadDesde
     *
     * @return Categoria
     */
    public function setEdadDesde($edadDesde)
    {
        $this->edadDesde = $edadDesde;

        return $this;
    }

    /**
     * Get edadDesde
     *
     * @return integer
     */
    public function getEdadDesde()
    {
        return $this->edadDesde;
    }

    /**
     * Set edadHasta
     *
     * @param integer $edadHasta
     *
     * @return Categoria
     */
    public function setEdadHasta($edadHasta)
    {
        $this->edadHasta = $edadHasta;

        return $this;
    }

    /**
     * Get edadHasta
     *
     * @return integer
     */
    public function getEdadHasta()
    {
        return $this->edadHasta;
    }
}

