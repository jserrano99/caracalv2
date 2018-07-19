<?php

namespace SocioBundle\Repository;


/**
 * Description of SocioRepository
 *
 * @author jose
 */
class SocioRepository extends \Doctrine\orm\EntityRepository {
	
	public function createAlphabeticalQueryBuilder() {
		return $this->createQueryBuilder('id');
	}
	
	public function siguienteSocio() {
		$em = $this->getEntityManager();
		$db = $em->getConnection();
		
		$query = "select max(nmsocio)+1 as nmsocio from socios";
		$stmt = $db->prepare($query);
		$params = [];
			
		$stmt->execute($params);
		$po = $stmt->fetch();
		if ($po["nmsocio"] == null) 
			return 1;
		else
		    return $po["nmsocio"];
	}
	
    public function queryEmailActivos() {
        $em = $this->getEntityManager();
		$db = $em->getConnection();
        $query = " select email  as eMail "
                ." ,concat(personas.nombre,' ',personas.apellido1,' ',personas.apellido2) as nombre,"
                ." ,socios.numero as socioNumero"
                ." from personas "
                ." inner join socios on socios.persona_id = personas.id "
                ." where email is not null and email != '' "
                ." and socios.estado_id = 1";
        $stmt = $db->prepare($query);
		$params = [];
		$stmt->execute($params);
		$po = $stmt->fetchAll();
		return $po;
    }
    
     public function queryActivosConEmail() {
        $em = $this->getEntityManager();
		$db = $em->getConnection();
        $query = " select personas.id as persona_id "
                ." from personas "
                ." inner join socios on socios.persona_id = personas.id "
                ." where email is not null and email != '' "
                ." and socios.estado_id = 1";
        $stmt = $db->prepare($query);
		$params = [];
		$stmt->execute($params);
		$po = $stmt->fetchAll();
		return $po;
    }
}
