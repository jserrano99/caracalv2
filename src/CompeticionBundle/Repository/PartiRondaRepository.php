<?php

namespace CompeticionBundle\Repository;


/**
 * Description of CompeticionRepository
 *
 * @author jose
 */
class PartiRondaRepository extends \Doctrine\orm\EntityRepository {
	
	
	public function queryPartiRonda($ronda_id,$order=null) {
		$em = $this->getEntityManager();
		$db = $em->getConnection();
		
		$query = "select participantes_rondas.id as partiRonda_id,"
				." participantes.id as participante_id ,"
				." participantes.dorsal, "
				." modalidades.descripcion as modalidad , "
				." arqueros.id as arquero_id ,"
				." arqueros.licencia, "
				." personas.id as persona_id ,"
				." personas.nif, "
				." personas.nombre, "
				." personas.apellido1, "
				." personas.apellido2, "
				." concat(personas.apellido1,' ',personas.apellido2,', ',personas.nombre) as apenom ,"
				." concat(personas.nombre,' ',personas.apellido1,' ',personas.apellido2) as nomape ,"
				." club.descripcion as club , "
				." federaciones.descripcion as federacion, "
				." categorias.descripcion as categoria, "
				." participantes_rondas.inscrito , "
				." participantes_rondas.pagado , "
				." participantes_rondas.puntos , "
				." participantes_rondas.onces , "
				." participantes_rondas.dieces , "
				." participantes_rondas.presentado  "
				." from participantes_rondas, participantes, arqueros, personas, club, modalidades, federaciones, categorias"
				." where participantes_rondas.ronda_id = :ronda_id " 
				." and participantes.id  = participantes_rondas.participante_id "
				." and arqueros.id = participantes.arquero_id "
				." and personas.id = arqueros.persona_id "
				." and club.id = arqueros.club_id "
				." and federaciones.id = club.federacion_id "
				." and categorias.id = arqueros.categoria_id "
				." and modalidades.id = participantes.modalidad_id ";

		if ($order == 'A') {
			$query .= " order by apenom ";
		}
		
		$stmt = $db->prepare($query);
		$params = array(":ronda_id" => $ronda_id);
		$stmt->execute($params);
		$po = $stmt->fetchAll();
		
		return $po;
	}
	
	public function queryPartiRondas($participante_id) {
		$em = $this->getEntityManager();
		$db = $em->getConnection();
		
		$query = "select rondas.id  as ronda_id,"
				. "rondas.num as ronda_num ," 
				."participantes_rondas.id as partiRonda_id,"
				." participantes.id as participante_id ,"
				." participantes.dorsal, "
				." modalidades.descripcion as modalidad , "
				." modalidades.id as modalidad_id, "
				." arqueros.id as arquero_id ,"
				." arqueros.licencia, "
				." personas.id as persona_id ,"
				." personas.nif, "
				." personas.nombre, "
				." personas.apellido1, "
				." personas.apellido2, "
				." concat(personas.apellido1,' ',personas.apellido2,', ',personas.nombre) as apenom ,"
				." concat(personas.nombre,' ',personas.apellido1,' ',personas.apellido2) as nomape ,"
				." club.descripcion as club , "
				." federaciones.descripcion as federacion, "
				." categorias.descripcion as categoria, "
				." categorias.id as categoria_id,"
				." participantes_rondas.inscrito , "
				." participantes_rondas.pagado , "
				." participantes_rondas.puntos , "
				." participantes_rondas.onces , "
				." participantes_rondas.dieces , "
				." participantes_rondas.presentado  "
				." from rondas, participantes_rondas, participantes, arqueros, personas, club, modalidades, federaciones, categorias"
				." where rondas.id = participantes_rondas.ronda_id  " 
				." and participantes.id = participantes_rondas.participante_id "
				." and participantes_rondas.participante_id = :participante_id"
				." and arqueros.id = participantes.arquero_id "
				." and personas.id = arqueros.persona_id "
				." and club.id = arqueros.club_id "
				." and federaciones.id = club.federacion_id "
				." and categorias.id = arqueros.categoria_id "
				." and modalidades.id = participantes.modalidad_id ";
		
		$stmt = $db->prepare($query);
		$params = array(":participante_id" => $participante_id);
		$stmt->execute($params);
		$po = $stmt->fetchAll();
		
		return $po;
	}
	
	public function queryInscritosRonda($ronda_id,$order) {
		$em = $this->getEntityManager();
		$db = $em->getConnection();
		
		$query = "select participantes_rondas.id as partiRonda_id,"
				." participantes.id as participante_id ,"
				." participantes.dorsal, "
				." modalidades.descripcion as modalidad , "
                ." modalidades.id as modalidad_id ,"
				." arqueros.id as arquero_id ,"
				." arqueros.licencia, "
				." personas.id as persona_id ,"
				." personas.nif, "
				." personas.nombre, "
				." personas.apellido1, "
				." personas.apellido2, "
				." concat(personas.apellido1,' ',personas.apellido2,', ',personas.nombre) as apenom ,"
				." concat(personas.nombre,' ',personas.apellido1,' ',personas.apellido2) as nomape ,"
				." club.descripcion as club , "
				." federaciones.descripcion as federacion, "
				." categorias.descripcion as categoria, "
                ." categorias.id as categoria_id ,"
				." participantes_rondas.inscrito , "
				." participantes_rondas.pagado , "
				." participantes_rondas.puntos , "
				." participantes_rondas.onces , "
				." participantes_rondas.dieces , "
				." participantes_rondas.presentado  "
				." from participantes_rondas, participantes, arqueros, personas, club, modalidades, federaciones, categorias"
				." where participantes_rondas.ronda_id = :ronda_id " 
				." and participantes.id  = participantes_rondas.participante_id "
				." and arqueros.id = participantes.arquero_id "
				." and participantes_rondas.inscrito = 'S' "
				." and personas.id = arqueros.persona_id "
				." and club.id = arqueros.club_id "
				." and federaciones.id = club.federacion_id "
				." and categorias.id = arqueros.categoria_id "
				." and modalidades.id = participantes.modalidad_id ";
		
		if ($order == 'A') {
			$query .= " order by apenom ";
		}
		if ($order == 'D') {
			$query .= " order by dorsal ";
		}
		
		$stmt = $db->prepare($query);
		$params = array(":ronda_id" => $ronda_id);
		$stmt->execute($params);
		$po = $stmt->fetchAll();
		
		return $po;
	}
	
    public function queryByParticipante($participante_id, $ronda_id) {
        $em = $this->getEntityManager();
		$db = $em->getConnection();
		
		$query = " select participantes_rondas.id as id "
                ." from participantes_rondas, rondas "
                ." where participantes_rondas.participante_id = :participante_id "
                ."   and participantes_rondas.ronda_id = :ronda_id";
        
        $stmt = $db->prepare($query);
		$params = array(":participante_id" => $participante_id,
                        ":ronda_id" => $ronda_id);
		$stmt->execute($params);
		$po = $stmt->fetch();
		
		return $po;
                
    }   
}
