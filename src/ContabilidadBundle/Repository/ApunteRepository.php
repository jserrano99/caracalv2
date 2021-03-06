<?php

namespace ContabilidadBundle\Repository;

/**
 * AsientoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ApunteRepository extends \Doctrine\ORM\EntityRepository {

    public function siguienteApunte($asiento_id) {
        $em = $this->getEntityManager();
        $db = $em->getConnection();
        $query = " select max(numero)+1 as numero from apuntes where asiento_id = :asiento_id";
        $stmt = $db->prepare($query);
        $params = Array("asiento_id" => $asiento_id);
        $stmt->execute($params);
        $po = $stmt->fetch();
        if ($po["numero"]) {
            return $po{"numero"};
        } else {
            return 1;
        }
    }

    public function queryByAsiento($asiento_id) {
        $em = $this->getEntityManager();
        $db = $em->getConnection();

        $query = " select apuntes.id as id "
                . " ,apuntes.numero as numero"
                . " ,apuntes.descripcion as descripcion "
                . " ,apuntes.cuenta_debe_id as cuenta_debe_id "
                . " ,cuentas_mayor_debe.descripcion as cuentaDebe"
                . " ,apuntes.importe_debe as importeDebe "
                . " ,cuentas_mayor_haber.descripcion as cuentaHaber"
                . " ,apuntes.importe_haber as importeHaber "
                . " ,asientos.id as asiento_id "
                . " from apuntes "
                . " inner join asientos on asientos.id = apuntes.asiento_id "
                . " left join cuentas_mayor as cuentas_mayor_debe on apuntes.cuenta_debe_id = cuentas_mayor_debe.id "
                . " left join cuentas_mayor as cuentas_mayor_haber on apuntes.cuenta_haber_id = cuentas_mayor_haber.id "
                . " where apuntes.asiento_id = :asiento_id"
                . " order by asientos.numero "
        ;
        $stmt = $db->prepare($query);
        $params = array(":asiento_id" => $asiento_id);
        $stmt->execute($params);
        $po = $stmt->fetchAll();

        return $po;
    }

    public function queryLibroMayor($ejercicio_id) {
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
                . " where asientos.ejercicio_id = :ejercicio_id "
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
                . " ORDER by grupoCuenta, cuentaMayor_id, asientoNumero";

        $stmt = $db->prepare($query);
        $params = array(":ejercicio_id" => $ejercicio_id);
        $stmt->execute($params);
        $po = $stmt->fetchAll();

        return $po;
    }

    public function queryLibroDiario($ejercicio_id) {
        $em = $this->getEntityManager();
        $db = $em->getConnection();

        $query = " select apuntes.id as apunteId "
                . " ,apuntes.numero as apunteNumero"
                . " ,apuntes.descripcion as apunteDescripcion "
                . " ,apuntes.cuenta_debe_id as cuentaDebeId "
                . " ,concat(cuentas_mayor_debe.codigo,'--',cuentas_mayor_debe.descripcion) as cuentaDebe "
                . " ,apuntes.importe_debe as importeDebe "
                . " ,concat(cuentas_mayor_haber.codigo,'--',cuentas_mayor_haber.descripcion) as cuentaHaber "
                . " ,apuntes.importe_haber as importeHaber "
                . " ,asientos.id as asientoId "
                . " ,asientos.numero as asientoNumero "
                . " ,asientos.descripcion as asientoDescripcion "
                . " ,date_format(asientos.fecha ,'%d/%m/%Y') as asientoFecha "
                . " from asientos "
                . "    inner join apuntes on asientos.id = apuntes.asiento_id "
                . "    left join cuentas_mayor as cuentas_mayor_debe on apuntes.cuenta_debe_id = cuentas_mayor_debe.id "
                . "    left join cuentas_mayor as cuentas_mayor_haber on apuntes.cuenta_haber_id = cuentas_mayor_haber.id "
                . "    where asientos.ejercicio_id = :ejercicio_id "
                . " order by asientoNumero, apunteNumero "
        ;

        $stmt = $db->prepare($query);
        $params = array(":ejercicio_id" => $ejercicio_id);
        $stmt->execute($params);
        $po = $stmt->fetchAll();

        return $po;
    }

    public function queryBalance($ejercicio_id) {
        $em = $this->getEntityManager();
        $db = $em->getConnection();

        $query = "delete from balance where ejercicio_id  = :ejercicio_id ";

        $stmt = $db->prepare($query);
        $params = array(":ejercicio_id" => $ejercicio_id);
        $stmt->execute($params);

        $query = "insert into balance ( "
                . " select  asientos.ejercicio_id as ejercicio_id ,"
                . "		   niveles_balance_0.nivel_balance as nivel0 ,"
                . "          niveles_balance_1.nivel_balance as nivel1 ,"
                . "          niveles_balance_2.nivel_balance as nivel2 ,"
                . "          niveles_balance_3.nivel_balance as nivel3 ,"
                . "          niveles_balance_4.nivel_balance as nivel4 ,"
                . "          concat(cuentas_mayor.codigo,'-',cuentas_mayor.descripcion) as cuenta_mayor ,"
                . "          apuntes.importe_debe as importe_debe ,"
                . "          0 as importe_haber ,"
                . "			estr_balance.multiplicador as multiplicador "
                . "  from apuntes "
                . "  INNER JOIN estr_balance on estr_balance.cuenta_mayor_id = apuntes.cuenta_debe_id "
                . "  INNER JOIN cuentas_mayor on cuentas_mayor.id = apuntes.cuenta_debe_id "
                . "  INNER JOIN niveles_balance as niveles_balance_0 on niveles_balance_0.id = estr_balance.nivel0"
                . "  INNER JOIN niveles_balance as niveles_balance_1 on niveles_balance_1.id = estr_balance.nivel1"
                . "  INNER JOIN niveles_balance as niveles_balance_2 on niveles_balance_2.id = estr_balance.nivel2 "
                . "  INNER JOIN niveles_balance as niveles_balance_3 on niveles_balance_3.id = estr_balance.nivel3 "
                . "  INNER JOIN niveles_balance as niveles_balance_4 on niveles_balance_4.id = estr_balance.nivel4"
                . "  INNER JOIN asientos on asientos.id = apuntes.asiento_id"
                . "  where asientos.ejercicio_id = :ejercicio_id ) ";

        $stmt = $db->prepare($query);
        $params = array(":ejercicio_id" => $ejercicio_id);
        $stmt->execute($params);

        $query = "insert into balance ( "
                . " select  asientos.ejercicio_id as ejercicio_id ,"
                . "		   niveles_balance_0.nivel_balance as nivel0 ,"
                . "          niveles_balance_1.nivel_balance as nivel1 ,"
                . "          niveles_balance_2.nivel_balance as nivel2 ,"
                . "          niveles_balance_3.nivel_balance as nivel3 ,"
                . "          niveles_balance_4.nivel_balance as nivel4 ,"
                . "          concat(cuentas_mayor.codigo,'-',cuentas_mayor.descripcion) as cuenta_mayor ,"
                . "          0 as importe_debe ,"
                . "          apuntes.importe_haber as importe_haber ,"
                . "			estr_balance.multiplicador as multiplicador "
                . "  from apuntes "
                . "  INNER JOIN estr_balance on estr_balance.cuenta_mayor_id = apuntes.cuenta_haber_id "
                . "  INNER JOIN cuentas_mayor on cuentas_mayor.id = apuntes.cuenta_haber_id "
                . "  INNER JOIN niveles_balance as niveles_balance_0 on niveles_balance_0.id = estr_balance.nivel0"
                . "  INNER JOIN niveles_balance as niveles_balance_1 on niveles_balance_1.id = estr_balance.nivel1"
                . "  INNER JOIN niveles_balance as niveles_balance_2 on niveles_balance_2.id = estr_balance.nivel2 "
                . "  INNER JOIN niveles_balance as niveles_balance_3 on niveles_balance_3.id = estr_balance.nivel3 "
                . "  INNER JOIN niveles_balance as niveles_balance_4 on niveles_balance_4.id = estr_balance.nivel4"
                . "  INNER JOIN asientos on asientos.id = apuntes.asiento_id"
                . "  where asientos.ejercicio_id = :ejercicio_id ) ";

        $stmt = $db->prepare($query);
        $params = array(":ejercicio_id" => $ejercicio_id);
        $stmt->execute($params);

        $query = " select ejercicio_id "
                . " ,nivel0 "
                . " ,nivel1 "
                . " ,nivel2 "
                . " ,nivel3 "
                . " ,nivel4 "
                . " ,cuenta_mayor "
                . " ,sum(importe_debe - importe_haber) AS SALDO "
                . " from balance  "
                . " where ejercicio_id = :ejercicio_id "
                . " group by ejercicio_id,nivel0,nivel1,nivel2,nivel3,nivel4,cuenta_mayor,multiplicador";

        $stmt = $db->prepare($query);
        $params = array(":ejercicio_id" => $ejercicio_id);
        $stmt->execute($params);

        $po = $stmt->fetchAll();

        return $po;
    }

    public function queryCuentaResultados($ejercicio_id) {
        $em = $this->getEntityManager();
        $db = $em->getConnection();

        $query = "delete from cuenta_resultados where ejercicio_id  = :ejercicio_id ";

        $stmt = $db->prepare($query);
        $params = array(":ejercicio_id" => $ejercicio_id);
        $stmt->execute($params);

        $query = "insert into cuenta_resultados ( "
                . " select  asientos.ejercicio_id as ejercicio_id ,"
                . "		    estr_cuenta_resultados.nivel1 as nivel1 ,"
                . "          estr_cuenta_resultados.nivel2 as nivel2 ,"
                . "          estr_cuenta_resultados.nivel3 as nivel3 ,"
                . "          concat(cuentas_mayor.codigo,'-',cuentas_mayor.descripcion) as cuenta_mayor ,"
                . "          apuntes.importe_debe as importe_debe ,"
                . "          0 as importe_haber ,"
                . "			estr_cuenta_resultados.multiplicador as multiplicador "
                . "  from apuntes "
                . "  INNER JOIN estr_cuenta_resultados on estr_cuenta_resultados.cuenta_mayor_id = apuntes.cuenta_debe_id "
                . "  INNER JOIN cuentas_mayor on cuentas_mayor.id = apuntes.cuenta_debe_id "
                . "  INNER JOIN asientos on asientos.id = apuntes.asiento_id"
                . "  where asientos.ejercicio_id = :ejercicio_id ) ";

        $stmt = $db->prepare($query);
        $params = array(":ejercicio_id" => $ejercicio_id);
        $stmt->execute($params);

        $query = "insert into cuenta_resultados ( "
                . " select  asientos.ejercicio_id as ejercicio_id ,"
                . "		    estr_cuenta_resultados.nivel1 as nivel1 ,"
                . "          estr_cuenta_resultados.nivel2 as nivel2 ,"
                . "          estr_cuenta_resultados.nivel3 as nivel3 ,"
                . "          concat(cuentas_mayor.codigo,'-',cuentas_mayor.descripcion) as cuenta_mayor ,"
                . "          0 as importe_debe ,"
                . "          apuntes.importe_haber as importe_haber ,"
                . "			estr_cuenta_resultados.multiplicador as multiplicador "
                . "  from apuntes "
                . "  INNER JOIN estr_cuenta_resultados on estr_cuenta_resultados.cuenta_mayor_id = apuntes.cuenta_haber_id "
                . "  INNER JOIN cuentas_mayor on cuentas_mayor.id = apuntes.cuenta_haber_id "
                . "  INNER JOIN asientos on asientos.id = apuntes.asiento_id"
                . "  where asientos.ejercicio_id = :ejercicio_id ) ";

        $stmt = $db->prepare($query);
        $params = array(":ejercicio_id" => $ejercicio_id);
        $stmt->execute($params);

        $query = " select ejercicio_id "
                . " ,nivel1 "
                . " ,nivel2 "
                . " ,nivel3 "
                . " ,cuenta_mayor "
                . " ,sum(importe_haber - importe_debe ) AS SALDO "
                . " from cuenta_resultados  "
                . " where ejercicio_id = :ejercicio_id "
                . " group by ejercicio_id,nivel1,nivel2,nivel3,cuenta_mayor";

        $stmt = $db->prepare($query);
        $params = array(":ejercicio_id" => $ejercicio_id);
        $stmt->execute($params);

        $po = $stmt->fetchAll();

        return $po;
    }

    public function resultadoEjercicio($ejercicio_id) {
        $em = $this->getEntityManager();
        $db = $em->getConnection();

        $query = " select ejercicio_id "
                . " ,sum(importe_haber - importe_debe ) AS SALDO "
                . " from cuenta_resultados  "
                . " where ejercicio_id = :ejercicio_id "
                . " group by ejercicio_id";

        $stmt = $db->prepare($query);
        $params = array(":ejercicio_id" => $ejercicio_id);
        $stmt->execute($params);

        $po = $stmt->fetch();

        return $po["SALDO"];
    }

    public function sumaImporteDebe($ejercicio_id, $cuentaMayor_id) {
        $em = $this->getEntityManager();
        $db = $em->getConnection();

        $query = " select sum(apuntes.importe_debe) as importeDebe"
                . " from apuntes "
                . "    inner join asientos on asientos.id = apuntes.asiento_id   "
                . " where asientos.ejercicio_id = :ejercicio_id "
                . " and apuntes.cuenta_debe_id = :cuentaMayor_id ";
        $stmt = $db->prepare($query);
        $params = array(":ejercicio_id" => $ejercicio_id,
            ":cuentaMayor_id" => $cuentaMayor_id);
        $stmt->execute($params);
        $po = $stmt->fetch();
        return $po["importeDebe"];
    }

    public function sumaImporteHaber($ejercicio_id, $cuentaMayor_id) {
        $em = $this->getEntityManager();
        $db = $em->getConnection();

        $query = " select sum(apuntes.importe_haber) as importeHaber"
                . " from apuntes "
                . "    inner join asientos on asientos.id = apuntes.asiento_id   "
                . " where asientos.ejercicio_id = :ejercicio_id "
                . " and apuntes.cuenta_haber_id = :cuentaMayor_id ";
        $stmt = $db->prepare($query);
        $params = array(":ejercicio_id" => $ejercicio_id,
            ":cuentaMayor_id" => $cuentaMayor_id);
        $stmt->execute($params);
        $po = $stmt->fetch();
        return $po["importeHaber"];
    }

    public function saldosGastos($ejercicio_id) {
        $em = $this->getEntityManager();
        $db = $em->getConnection();

        $query = " select  cuentas_mayor.id as cuentaMayor_id "
                . "	,sum(apuntes.importe_debe) as importe "
                . "	from apuntes "
                . "	inner join asientos on asientos.id = apuntes.asiento_id"
                . "     inner join cuentas_mayor on cuentas_mayor.id = apuntes.cuenta_debe_id "
                . "	where asientos.ejercicio_id= :ejercicio_id "
                . "	and cuentas_mayor.grupo_cuentas_id = 6 " // CUENTAS DE GASTOS
                . "	and cuentas_mayor.id != 95" // COMPRA DE MERCDERIAS
                . "	GROUP by cuentaMayor_id";

        $stmt = $db->prepare($query);
        $params = array(":ejercicio_id" => $ejercicio_id);
        $stmt->execute($params);
        $po = $stmt->fetchAll();
        return $po;
    }

    public function saldosIngresos($ejercicio_id) {
        $em = $this->getEntityManager();
        $db = $em->getConnection();

        $query = " select  cuentas_mayor.id as cuentaMayor_id "
                . "	,sum(apuntes.importe_haber) as importe "
                . "	from apuntes "
                . "	inner join asientos on asientos.id = apuntes.asiento_id"
                . "  inner join cuentas_mayor on cuentas_mayor.id = apuntes.cuenta_haber_id "
                . "	where asientos.ejercicio_id= :ejercicio_id "
                . "	and cuentas_mayor.grupo_cuentas_id = 7 " // CEUNTAS DE ingresos
                . "	GROUP by cuentaMayor_id";

        $stmt = $db->prepare($query);
        $params = array(":ejercicio_id" => $ejercicio_id);
        $stmt->execute($params);
        $po = $stmt->fetchAll();
        return $po;
    }

}
