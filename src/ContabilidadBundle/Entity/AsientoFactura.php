<?php

namespace ContabilidadBundle\Entity;

/**
 * AsientoFactura
 */
class AsientoFactura
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $numero;

    /**
     * @var string
     */
    private $serie;

    /**
     * @var \Date
     */
    private $fecha;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var string
     */
    private $observaciones;

    /**
     * @var \ContabilidadBundle\Entity\Proveedor
     */
    private $proveedor;

    /**
     * @var \ContabilidadBundle\Entity\CuentaMayor
     */
    private $cuentaPago;

    /**
     * @var \ContabilidadBundle\Entity\CuentaMayor
     */
    private $cuentaGasto;

    /**
     * @var \ContabilidadBundle\Entity\Proyecto
     */
    private $proyecto;

    /**
     * @var double
     */
    private $importeBase;
/**
     * @var double
     */
    private $importe;
/**
     * @var double
     */
    
    private $cuotaIva;
/**
     * @var double
     */
    private $importeFactura;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set numero
     *
     * @param string $numero
     *
     * @return AsientoFactura
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set serie
     *
     * @param string $serie
     *
     * @return AsientoFactura
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * Get serie
     *
     * @return string
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return AsientoFactura
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return AsientoFactura
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
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return AsientoFactura
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set proveedor
     *
     * @param \ContabilidadBundle\Entity\Proveedor $proveedor
     *
     * @return AsientoFactura
     */
    public function setProveedor(\ContabilidadBundle\Entity\Proveedor $proveedor=null )
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    /**
     * Get proveedor
     *
     * @return \ContabilidadBundle\Entity\Proveedor
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }

    /**
     * Set cuentaPago
     *
     * @param \ContabilidadBundle\Entity\CuentaMayor $cuentaPago
     *
     * @return AsientoFactura
     */
    public function setCuentaPago(\ContabilidadBundle\Entity\CuentaMayor $cuentaPago=null)
    {
        $this->cuentaPago = $cuentaPago;

        return $this;
    }

    /**
     * Get pago
     *
     * @return \ContabilidadBundle\Entity\CuentaMayor
     */
    public function getCuentaPago()
    {
        return $this->cuentaPago;
    }

    /**
     * Set cuentaGasto
     *
     * @param \ContabilidadBundle\Entity\CuentaMayor $cuentaGasto
     *
     * @return AsientoFactura
     */
    public function setCuentaGasto(\ContabilidadBundle\Entity\CuentaMayor $cuentaGasto=null)
    {
        $this->cuentaGasto = $cuentaGasto;

        return $this;
    }

    /**
     * Get cuentaGasto
     *
     * @return string
     */
    public function getCuentaGasto()
    {
        return $this->cuentaGasto;
    }

    /**
     * Set proyecto
     *
     * @param \ContabilidadBundle\Entity\Proyecto $proyecto
     *
     * @return AsientoFactura
     */
    public function setProyecto(\ContabilidadBundle\Entity\Proyecto $proyecto=null)
    {
        $this->proyecto = $proyecto;

        return $this;
    }

    /**
     * Get proyecto
     *
     * @return \ContabilidadBundle\Entity\Proyecto
     */
    public function getProyecto()
    {
        return $this->proyecto;
    }
    /**
     * Set importeBase
     *
     * @param double
     *
     * @return AsientoFactura
     */
    public function setImporteBase($importeBase)
    {
        $this->importeBase= $importeBase;

        return $this;
    }

    /**
     * Get proyecto
     *
     * @return double
     */
    public function getImporteBase()
    {
        return $this->importeBase;
    }
    
    /**
     * Set importeBase
     *
     * @param double
     *
     * @return AsientoFactura
     */
    public function setImporte($importe)
    {
        $this->importe= $importe;

        return $this;
    }

    /**
     * Get proyecto
     *
     * @return double
     */
    public function getImporte()
    {
        return $this->importe;
    }
    
    /**
     * Set cuotaIva
     *
     * @param double
     *
     * @return AsientoFactura
     */
    public function setCuotaIva($cuotaIva)
    {
        $this->cuotaIva= $cuotaIva;

        return $this;
    }

    /**
     * Get cuotaIva
     *
     * @return double
     */
    public function getCuotaIva()
    {
        return $this->cuotaIva;
    }
    
    /**
     * Set importeFactura
     *
     * @param double
     *
     * @return AsientoFactura
     */
    public function  setImporteFactura($importeFactura)
    {
        $this->importeFactura= $importeFactura;

        return $this;
    }

    /**
     * Get importeFactura
     *
     * @return double
     */
    public function getImporteFactura()
    {
        return $this->importeFactura;
    }
}

