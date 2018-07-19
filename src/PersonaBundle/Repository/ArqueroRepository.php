<?php

namespace PersonaBundle\Repository;


/**
 * Description of CompeticionRepository
 *
 * @author jose
 */
class ArqueroRepository extends \Doctrine\orm\EntityRepository {
	
	public function createAlphabeticalQueryBuilder() {
		return $this->createQueryBuilder('id');
	}
	
	public function queryEmail() {
        $em = $this->getEntityManager();
		$db = $em->getConnection();
        $query = " select email  as eMail "
                ." ,concat(personas.nombre,' ',personas.apellido1,' ',personas.apellido2) as nombre,"
                ." ,arqueros.nmlicencia as numeroLicencia"
                ." from personas "
                ." inner join arqueros on arqueros.persona_id = personas.id "
                ." where email is not null and email != '' ";
        $stmt = $db->prepare($query);
		$params = [];
		$stmt->execute($params);
		$po = $stmt->fetchAll();
		return $po;
    }
}
