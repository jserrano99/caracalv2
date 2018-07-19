<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CompeticionBundle\Repository;

/**
 * Description of RondaRepository
 *
 * @author jluis_local
 */
class RondaRepository  extends \Doctrine\orm\EntityRepository {
    
    public function queryByNumero($competicion_id, $ronda_num) {
        $em = $this->getEntityManager();
		$db = $em->getConnection();
	
        $query = "select rondas.id as ronda_id "
                ." from rondas "
                ." where rondas.competicion_id = :competicion_id "
                ." and rondas.num = :ronda_num";
        
        $stmt = $db->prepare($query);
		$params = array(":competicion_id" => $competicion_id,
                        ":ronda_num" => $ronda_num);
		$stmt->execute($params);
		$po = $stmt->fetch();
		
		return $po;
    }
}
