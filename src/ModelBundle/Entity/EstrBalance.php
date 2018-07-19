<?php

namespace ModelBundle\Entity;

/**
 * EstrBalance
 */
class EstrBalance
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $nivel0;

    /**
     * @var integer
     */
    private $nivel1;

    /**
     * @var integer
     */
    private $nivel2;

    /**
     * @var integer
     */
    private $nivel3;

    /**
     * @var integer
     */
    private $nivel4;

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
     * Set nivel0
     *
     * @param integer $nivel0
     *
     * @return EstrBalance
     */
    public function setNivel0($nivel0)
    {
        $this->nivel0 = $nivel0;

        return $this;
    }

    /**
     * Get nivel0
     *
     * @return integer
     */
    public function getNivel0()
    {
        return $this->nivel0;
    }

    /**
     * Set nivel1
     *
     * @param integer $nivel1
     *
     * @return EstrBalance
     */
    public function setNivel1($nivel1)
    {
        $this->nivel1 = $nivel1;

        return $this;
    }

    /**
     * Get nivel1
     *
     * @return integer
     */
    public function getNivel1()
    {
        return $this->nivel1;
    }

    /**
     * Set nivel2
     *
     * @param integer $nivel2
     *
     * @return EstrBalance
     */
    public function setNivel2($nivel2)
    {
        $this->nivel2 = $nivel2;

        return $this;
    }

    /**
     * Get nivel2
     *
     * @return integer
     */
    public function getNivel2()
    {
        return $this->nivel2;
    }

    /**
     * Set nivel3
     *
     * @param integer $nivel3
     *
     * @return EstrBalance
     */
    public function setNivel3($nivel3)
    {
        $this->nivel3 = $nivel3;

        return $this;
    }

    /**
     * Get nivel3
     *
     * @return integer
     */
    public function getNivel3()
    {
        return $this->nivel3;
    }

    /**
     * Set nivel4
     *
     * @param integer $nivel4
     *
     * @return EstrBalance
     */
    public function setNivel4($nivel4)
    {
        $this->nivel4 = $nivel4;

        return $this;
    }

    /**
     * Get nivel4
     *
     * @return integer
     */
    public function getNivel4()
    {
        return $this->nivel4;
    }

    /**
     * Set multiplicador
     *
     * @param integer $multiplicador
     *
     * @return EstrBalance
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
     * @return EstrBalance
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

