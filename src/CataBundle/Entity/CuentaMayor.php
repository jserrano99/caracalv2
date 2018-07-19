<?php

namespace CataBundle\Entity;

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
     * @var \CataBundle\Entity\GrupoCuenta
     */
    private $grupoCuenta;

    /**
     * @var \CataBundle\Entity\TipoCuenta
     */
    private $tipoCuenta;


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
     * @param \CataBundle\Entity\GrupoCuenta $grupoCuenta
     *
     * @return CuentaMayor
     */
    public function setGrupoCuenta(\CataBundle\Entity\GrupoCuenta $grupoCuenta = null)
    {
        $this->grupoCuenta = $grupoCuenta;

        return $this;
    }

    /**
     * Get grupoCuenta
     *
     * @return \CataBundle\Entity\GrupoCuenta
     */
    public function getGrupoCuenta()
    {
        return $this->grupoCuenta;
    }

    /**
     * Set tipoCuenta
     *
     * @param \CataBundle\Entity\TipoCuenta $tipoCuenta
     *
     * @return CuentaMayor
     */
    public function setTipoCuenta(\CataBundle\Entity\TipoCuenta $tipoCuenta = null)
    {
        $this->tipoCuenta = $tipoCuenta;

        return $this;
    }

    /**
     * Get tipoCuenta
     *
     * @return \CataBundle\Entity\TipoCuenta
     */
    public function getTipoCuenta()
    {
        return $this->tipoCuenta;
    }
}

