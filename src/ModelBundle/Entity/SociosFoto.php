<?php

namespace ModelBundle\Entity;

/**
 * SociosFoto
 */
class SociosFoto
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $foto;

    /**
     * @var string
     */
    private $tipo;

    /**
     * @var \ModelBundle\Entity\Socios
     */
    private $socio;


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
     * Set foto
     *
     * @param string $foto
     *
     * @return SociosFoto
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get foto
     *
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return SociosFoto
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set socio
     *
     * @param \ModelBundle\Entity\Socios $socio
     *
     * @return SociosFoto
     */
    public function setSocio(\ModelBundle\Entity\Socios $socio = null)
    {
        $this->socio = $socio;

        return $this;
    }

    /**
     * Get socio
     *
     * @return \ModelBundle\Entity\Socios
     */
    public function getSocio()
    {
        return $this->socio;
    }
}

