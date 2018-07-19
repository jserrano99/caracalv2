<?php

namespace PersonaBundle\Entity;
use Symfony\Component\Validator\Constraints\DateTime;

use CataBundle\Entity\CategoriaOficial;

class Persona {

    private $id;
    private $nif;
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $fcnac;
    private $email;
    private $domicilio;
    private $cdpostal;
    private $movil;
    private $telefono;
    private $provincia;
    private $localidad;
    private $apenom;
    private $nomape;
    private $edad;
    
    /*
     * @var CategoriaOficial 
     */
    private $categoriaOficial; 
    
    public function __toString() {
        return $this->getApenom();
    }

    public function getId() {
        return $this->id;
    }

    public function setNif($nif) {
        $this->nif = $nif;

        return $this;
    }

    public function getNif() {
        return $this->nif;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApenom() {
        $this->apenom = $this->apellido1 . ' ' . $this->apellido2 . ', ' . $this->nombre;

        return $this->apenom;
    }

    public function getNomape() {
        $this->nomape = $this->nombre . ' ' . $this->apellido1 . ' ' . $this->apellido2;

        return $this->nomape;
    }

    public function setApellido1($apellido1) {
        $this->apellido1 = $apellido1;

        return $this;
    }

    public function getApellido1() {
        return $this->apellido1;
    }

    public function setApellido2($apellido2) {
        $this->apellido2 = $apellido2;

        return $this;
    }

    public function getApellido2() {
        return $this->apellido2;
    }

    public function setFcnac($fcnac) {
        $this->fcnac = $fcnac;

        return $this;
    }

    public function getFcnac() {
        return $this->fcnac;
    }

    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setDomicilio($domicilio) {
        $this->domicilio = $domicilio;

        return $this;
    }

    public function getDomicilio() {
        return $this->domicilio;
    }

    public function setCdpostal($cdpostal) {
        $this->cdpostal = $cdpostal;

        return $this;
    }

    public function getCdpostal() {
        return $this->cdpostal;
    }

    public function setMovil($movil) {
        $this->movil = $movil;

        return $this;
    }

    public function getMovil() {
        return $this->movil;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;

        return $this;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setProvincia(\CataBundle\Entity\Provincia $provincia = null) {
        $this->provincia = $provincia;

        return $this;
    }

    public function getProvincia() {
        return $this->provincia;
    }

    public function setLocalidad(\CataBundle\Entity\Localidad $localidad = null) {
        $this->localidad = $localidad;

        return $this;
    }

    public function getLocalidad() {
        return $this->localidad;
    }

    public function getEdad() {
        $cumpleanos =$this->fcnac;
        $hoy = new \DateTime();
        $annos = $hoy->diff($cumpleanos);
        $this->edad = $annos->y;
        return $this->edad;
    }
    /*
     * @return int 
     */
    public function getCategoriaOficial() {
        
    }
    
}
