<?php

namespace ContabilidadBundle\Entity;

/**
 * CuentaMayor
 */
class CuentaMayor
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
     * @var \ContabilidadBundle\Entity\GrupoCuenta
     */
    private $grupoCuenta;

    /**
     * @var \ContabilidadBundle\Entity\TipoCuenta
     */
    private $tipoCuenta;

    public function __toString() {
        return $this->codigo.":".$this->descripcion;
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
     * @return CuentaMayor
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
     * @return CuentaMayor
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
     * Set grupoCuenta
     *
     * @param \ContabilidadBundle\Entity\GrupoCuenta $grupoCuenta
     *
     * @return CuentaMayor
     */
    public function setGrupoCuenta(\ContabilidadBundle\Entity\GrupoCuenta $grupoCuenta = null)
    {
        $this->grupoCuenta = $grupoCuenta;

        return $this;
    }

    /**
     * Get grupoCuenta
     *
     * @return \ContabilidadBundle\Entity\GrupoCuenta
     */
    public function getGrupoCuenta()
    {
        return $this->grupoCuenta;
    }

    /**
     * Set tipoCuenta
     *
     * @param \ContabilidadBundle\Entity\TipoCuenta $tipoCuenta
     *
     * @return CuentaMayor
     */
    public function setTipoCuenta(\ContabilidadBundle\Entity\TipoCuenta $tipoCuenta = null)
    {
        $this->tipoCuenta = $tipoCuenta;

        return $this;
    }

    /**
     * Get tipoCuenta
     *
     * @return \ContabilidadBundle\Entity\TipoCuenta
     */
    public function getTipoCuenta()
    {
        return $this->tipoCuenta;
    }
}

