<?php

namespace ModelBundle\Entity;

/**
 * CuentasMayor
 */
class CuentasMayor
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
     * @var \ModelBundle\Entity\GrupoCuentas
     */
    private $grupoCuentas;

    /**
     * @var \ModelBundle\Entity\TiposCuenta
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
     * @return CuentasMayor
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
     * @return CuentasMayor
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
     * Set grupoCuentas
     *
     * @param \ModelBundle\Entity\GrupoCuentas $grupoCuentas
     *
     * @return CuentasMayor
     */
    public function setGrupoCuentas(\ModelBundle\Entity\GrupoCuentas $grupoCuentas = null)
    {
        $this->grupoCuentas = $grupoCuentas;

        return $this;
    }

    /**
     * Get grupoCuentas
     *
     * @return \ModelBundle\Entity\GrupoCuentas
     */
    public function getGrupoCuentas()
    {
        return $this->grupoCuentas;
    }

    /**
     * Set tipoCuenta
     *
     * @param \ModelBundle\Entity\TiposCuenta $tipoCuenta
     *
     * @return CuentasMayor
     */
    public function setTipoCuenta(\ModelBundle\Entity\TiposCuenta $tipoCuenta = null)
    {
        $this->tipoCuenta = $tipoCuenta;

        return $this;
    }

    /**
     * Get tipoCuenta
     *
     * @return \ModelBundle\Entity\TiposCuenta
     */
    public function getTipoCuenta()
    {
        return $this->tipoCuenta;
    }
}

