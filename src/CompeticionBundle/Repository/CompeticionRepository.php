<?php

namespace CompeticionBundle\Repository;


/**
 * Description of CompeticionRepository
 *
 * @author jose
 */
class CompeticionRepository extends \Doctrine\orm\EntityRepository {
	
		public function queryRondas($competicion_id) {
		$em = $this->getEntityManager();
		$db = $em->getConnection();
		
		$query = "select * from rondas where competicion_id = :competicion_id";
		$stmt = $db->prepare($query);
		$params = array(":competicion_id" => $competicion_id);
		$stmt->execute($params);
		$po = $stmt->fetchAll();
		
		return $po;
		
	}
	
	public function siguienteDorsal($competicion_id){
		$em = $this->getEntityManager();
		$db = $em->getConnection();
		
		$query = "select max(dorsal)+1 as dorsal from participantes where competicion_id = :competicion_id";
		$stmt = $db->prepare($query);
		$params = array(":competicion_id" => $competicion_id);
		$stmt->execute($params);
		$po = $stmt->fetch();
		if ($po["dorsal"] == null) 
			return 1;
		else
		    return $po["dorsal"];
	}
	
	public function queryParticipantes($competicion_id) {
		$em = $this->getEntityManager();
		$db = $em->getConnection();
		
		$query = "select participantes.id as id ,"
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
				." categorias.descripcion as categoria,"
				. "categorias.id as categoria_id  "
				." from participantes, arqueros, personas, club, modalidades, federaciones, categorias"
				." where participantes.competicion_id = :competicion_id"
				." and arqueros.id = participantes.arquero_id "
				." and personas.id = arqueros.persona_id "
				." and club.id = arqueros.club_id "
				." and federaciones.id = club.federacion_id "
				." and categorias.id = arqueros.categoria_id "
				." and modalidades.id = participantes.modalidad_id ";
		
		$stmt = $db->prepare($query);
		$params = array(":competicion_id" => $competicion_id);
		$stmt->execute($params);
		$po = $stmt->fetchAll();
		
		return $po;
	}
	
	public function  filtroArqueros($competicion_id){
		$em = $this->getEntityManager();
		$db = $em->getConnection();
		
		$query = "select arqueros.id as arquero_id, "
				." arqueros.licencia, "
				." club.descripcion as club ,"
				." federaciones.descripcion as federacion, "
				." categorias.descripcion as categoria, "
				." personas.id as persona_id, "
				." personas.nif ,"
				." concat (personas.apellido1,' ',personas.apellido2,', ',personas.nombre) as apenom, "
				." concat (personas.nombre,' ',personas.apellido1,' ',personas.apellido2) as nomape "
				." from club, arqueros, federaciones, categorias, personas "
				." where club.id = arqueros.club_id "
				." and federaciones.id = club.federacion_id "
				." and categorias.id = arqueros.categoria_id "
				." and personas.id = arqueros.persona_id "
				." and arqueros.id not in ( select participantes.arquero_id from participantes where participantes.competicion_id = :competicion_id) ";
		
		$stmt = $db->prepare($query);
		$params = array(":competicion_id" => $competicion_id);
		$stmt->execute($params);
		$po = $stmt->fetchAll();
		
		return $po;
	}
}
