<?php

namespace ContabilidadBundle\Repository;

/**
 * AsientoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AsientoRepository extends \Doctrine\ORM\EntityRepository {

    public function queryByEjercicio($ejercicio_id) {
        $em = $this->getEntityManager();
        $db = $em->getConnection();

        $query = " select asientos.id as id "
                . " ,asientos.numero as numero"
                . " ,asientos.fecha as fecha"
                . " ,asientos.descripcion as descripcion"
                . " ,asientos.proyecto_id as proyecto_id "
                . " ,proyectos.descripcion as proyecto"
                . " ,asientos.importe_debe as importeDebe"
                . " ,asientos.importe_haber as importeHaber"
                . " ,ejercicios.id as ejercicio_id"
                . " ,ejercicios.descripcion as ejercicio"
                . " from asientos "
                . " inner join ejercicios on asientos.ejercicio_id = ejercicios.id "
                . " left join proyectos on asientos.proyecto_id = proyectos.id"
                . " where asientos.ejercicio_id = :ejercicio_id "
                . " order by asientos.numero "
        ;
        $stmt = $db->prepare($query);
        $params = array(":ejercicio_id" => $ejercicio_id);
        $stmt->execute($params);
        $po = $stmt->fetchAll();

        return $po;
    }

    public function siguienteAsiento($ejercicio_id) {
        $em = $this->getEntityManager();
        $db = $em->getConnection();
        $query = " select max(numero)+1 as numero from asientos where ejercicio_id = :ejercicio_id";
        $stmt = $db->prepare($query);
        $params = Array(":ejercicio_id" => $ejercicio_id);
        $stmt->execute($params);
        $po = $stmt->fetch();
        if ($po["numero"] )  
            return $po{"numero"};
        else 
            return 1;
    }

    public function queryOrderByFecha($ejercicio_id) {
        $em = $this->getEntityManager();
        $db = $em->getConnection();

        $query = " select asientos.id as id "
                . " ,asientos.numero as numero"
                . " ,date_format(asientos.fecha ,'%d/%m/%Y') as fecha "
                . " ,asientos.descripcion as descripcion"
                . " ,asientos.proyecto_id as proyecto_id "
                . " ,proyectos.descripcion as proyecto"
                . " ,asientos.importe_debe as importeDebe"
                . " ,asientos.importe_haber as importeHaber"
                . " ,ejercicios.id as ejercicio_id"
                . " ,ejercicios.descripcion as ejercicio"
                . " from asientos "
                . " inner join ejercicios on asientos.ejercicio_id = ejercicios.id "
                . " left join proyectos on asientos.proyecto_id = proyectos.id"
                . " where asientos.ejercicio_id = :ejercicio_id "
                . " order by asientos.fecha "
        ;
        $stmt = $db->prepare($query);
        $params = array(":ejercicio_id" => $ejercicio_id);
        $stmt->execute($params);
        $po = $stmt->fetchAll();

        return $po;
    }

    public function queryByProyecto($proyecto_id) {
        $em = $this->getEntityManager();
        $db = $em->getConnection();

        $query = " select asientos.id as id "
                . " ,asientos.numero as numero"
                . " ,date_format(asientos.fecha ,'%d/%m/%Y') as fecha "
                . " ,asientos.descripcion as descripcion"
                . " ,asientos.proyecto_id as proyecto_id "
                . " ,proyectos.descripcion as proyecto"
                . " ,asientos.importe_debe as importeDebe"
                . " ,asientos.importe_haber as importeHaber"
                . " ,ejercicios.id as ejercicio_id"
                . " ,ejercicios.descripcion as ejercicio"
                . " from asientos "
                . " inner join ejercicios on asientos.ejercicio_id = ejercicios.id "
                . " left join proyectos on asientos.proyecto_id = proyectos.id"
                . " where asientos.proyecto_id= :proyecto_id "
                . " order by asientos.numero "
        ;
        $stmt = $db->prepare($query);
        $params = array(":proyecto_id" => $proyecto_id);
        $stmt->execute($params);
        $po = $stmt->fetchAll();

        return $po;
    }

}
