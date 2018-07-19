<?php

namespace ContabilidadBundle\Repository;

/**
 * AsientoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CuentaMayorRepository extends \Doctrine\ORM\EntityRepository {

    public function queryApuntes($cuentaMayor_id, $ejercicio_id) {
        $em = $this->getEntityManager();
        $db = $em->getConnection();

        $query = " select apuntes.id "
                . "    ,apuntes.numero "
                . "    ,apuntes.cuenta_debe_id as cuentaMayor_id "
                . "    ,concat(cuentas_mayor.codigo,'--',cuentas_mayor.descripcion) as cuentaMayor "
                . "    ,grupo_cuentas.descripcion as grupoCuenta "
                . "    ,apuntes.importe_debe as importeDebe "
                . "    ,null  as importeHaber  "
                . "    ,apuntes.descripcion  as apunteDescripcion "
                . "    ,apuntes.observaciones  as apunteObservaciones  "
                . "    ,apuntes.asiento_id as asiento_id "
                . "    ,asientos.numero as asientoNumero  "
                . "    ,date_format(asientos.fecha ,'%d/%m/%Y') as asientoFecha "
                . " from asientos "
                . "   inner join apuntes on asientos.id = apuntes.asiento_id "
                . "   inner join cuentas_mayor on cuentas_mayor.id = apuntes.cuenta_debe_id "
                . "   inner join grupo_cuentas on grupo_cuentas.id = cuentas_mayor.grupo_cuentas_id "
                . " where asientos.ejercicio_id = :ejercicio_id  "
                . "   and apuntes.cuenta_debe_id = :cuentaMayor_id "
                . "   union "
                . " select apuntes.id "
                . "    ,apuntes.numero "
                . "    ,apuntes.cuenta_haber_id as cuentaMayor_id "
                . "    ,concat(cuentas_mayor.codigo,'--',cuentas_mayor.descripcion) as cuentaMayor "
                . "    ,grupo_cuentas.descripcion as grupoCuentas "
                . "    ,null  as importeDebe "
                . "    ,apuntes.importe_haber  as importeHaber  "
                . "    ,apuntes.descripcion  as apunteDescripcion "
                . "    ,apuntes.observaciones  as apunteObservaciones  "
                . "    ,apuntes.asiento_id as asiento_id "
                . "    ,asientos.numero as asientoNumero  "
                . "    ,date_format(asientos.fecha ,'%d/%m/%Y') as asientoFecha "
                . " from asientos "
                . "   inner join apuntes on asientos.id = apuntes.asiento_id "
                . "   inner join cuentas_mayor on cuentas_mayor.id = apuntes.cuenta_haber_id "
                . "   inner join grupo_cuentas on grupo_cuentas.id = cuentas_mayor.grupo_cuentas_id "
                . " where asientos.ejercicio_id = :ejercicio_id "
                . "   and apuntes.cuenta_haber_id = :cuentaMayor_id "
                . " ORDER by asientoNumero";

        $stmt = $db->prepare($query);
        $params = array(":ejercicio_id" => $ejercicio_id, ":cuentaMayor_id" => $cuentaMayor_id);
        $stmt->execute($params);
        $po = $stmt->fetchAll();

        return $po;
    }

    public function querySaldos($ejercicio_id) {
        $em = $this->getEntityManager();
        $db = $em->getConnection();

        $query = " delete from saldos";
        $stmt = $db->prepare($query);
        $params = array();
        $stmt->execute($params);

        $query = " insert into saldos select asientos.ejercicio_id  "
                . " , cuentas_mayor.id as cuentaMayor_id "
                . " ,concat(cuentas_mayor.codigo,'--',cuentas_mayor.descripcion) as cuentaMayor "
                . "    ,sum(apuntes.importe_debe) as importeDebe "
                . "	  ,sum(0) as importeHaber"
                . " from apuntes "
                . "   inner join asientos on asientos.id = apuntes.asiento_id "
                . "   inner join cuentas_mayor on cuentas_mayor.id = apuntes.cuenta_debe_id "
                . " where asientos.ejercicio_id = :ejercicio_id "
                . " group by asientos.ejercicio_id, cuentas_mayor.id, cuentaMayor";


        $stmt = $db->prepare($query);
        $params = array(":ejercicio_id" => $ejercicio_id);
        $stmt->execute($params);

        $query = " insert into saldos select asientos.ejercicio_id "
                . " , cuentas_mayor.id as cuentaMayor_id "
                . " , concat(cuentas_mayor.codigo,'--',cuentas_mayor.descripcion) as cuentaMayor "
                . "    ,sum(0)  as importeDebe "
                . "    ,sum(apuntes.importe_haber)  as importeHaber  "
                . " from apuntes "
                . "   inner join asientos on asientos.id = apuntes.asiento_id "
                . "   inner join cuentas_mayor on cuentas_mayor.id = apuntes.cuenta_haber_id "
                . " where asientos.ejercicio_id = :ejercicio_id "
                . " group by asientos.ejercicio_id, cuentas_mayor.id, cuentaMayor";

        $stmt = $db->prepare($query);
        $params = array(":ejercicio_id" => $ejercicio_id);
        $stmt->execute($params); 

        $query = " select ejercicio_id "
                . "    , cuentamayor_id as cuentaMayor_id "
                . "    , cuenta_mayor as cuentaMayor"
                . "    , sum(importe_debe)  as importeDebe "
                . "    , sum(importe_Haber) as importeHaber  "
                . "    , sum(importe_debe)-sum(importe_haber)  as saldo "
                . " from saldos "
                . " group by ejercicio_id, cuentaMayor_id, cuentaMayor "
                . " order by cuentaMayor";

        $stmt = $db->prepare($query);
        $params = array();
        $stmt->execute($params);
        $po = $stmt->fetchAll();

        return $po;
    }

}