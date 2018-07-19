<?php

namespace ModelBundle\Entity;

/**
 * CuentaResultados
 */
class CuentaResultados
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nivel1;

    /**
     * @var string
     */
    private $nivel2;

    /**
     * @var string
     */
    private $nivel3;

    /**
     * @var integer
     */
    private $multiplicador;

    /**
     * @var \ModelBundle\Entity\CuentasMayor
     */
    private $cuentaMayor;


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
     * Set nivel1
     *
     * @param string $nivel1
     *
     * @return CuentaResultados
     */
    public function setNivel1($nivel1)
    {
        $this->nivel1 = $nivel1;

        return $this;
    }

    /**
     * Get nivel1
     *
     * @return string
     */
    public function getNivel1()
    {
        return $this->nivel1;
    }

    /**
     * Set nivel2
     *
     * @param string $nivel2
     *
     * @return CuentaResultados
     */
    public function setNivel2($nivel2)
    {
        $this->nivel2 = $nivel2;

        return $this;
    }

    /**
     * Get nivel2
     *
     * @return string
     */
    public function getNivel2()
    {
        return $this->nivel2;
    }

    /**
     * Set nivel3
     *
     * @param string $nivel3
     *
     * @return CuentaResultados
     */
    public function setNivel3($nivel3)
    {
        $this->nivel3 = $nivel3;

        return $this;
    }

    /**
     * Get nivel3
     *
     * @return string
     */
    public function getNivel3()
    {
        return $this->nivel3;
    }

    /**
     * Set multiplicador
     *
     * @param integer $multiplicador
     *
     * @return CuentaResultados
     */
    public function setMultiplicador($multiplicador)
    {
        $this->multiplicador = $multiplicador;

        return $this;
    }

    /**
     * Get multiplicador
     *
     * @return integer
     */
    public function getMultiplicador()
    {
        return $this->multiplicador;
    }

    /**
     * Set cuentaMayor
     *
     * @param \ModelBundle\Entity\CuentasMayor $cuentaMayor
     *
     * @return CuentaResultados
     */
    public function setCuentaMayor(\ModelBundle\Entity\CuentasMayor $cuentaMayor = null)
    {
        $this->cuentaMayor = $cuentaMayor;

        return $this;
    }

    /**
     * Get cuentaMayor
     *
     * @return \ModelBundle\Entity\CuentasMayor
     */
    public function getCuentaMayor()
    {
        return $this->cuentaMayor;
    }
}

