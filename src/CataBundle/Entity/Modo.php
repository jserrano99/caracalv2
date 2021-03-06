<?php

namespace CataBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Modo
 *
 * @ORM\Table(name="modos")
 * @ORM\Entity
 */
class Modo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


    /**
     * @var string
	 * 
	 * @ORM\Column(name="descripcion", type="string", length=255, nullable=false)
     */
    private $descripcion;
	
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Modos
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

