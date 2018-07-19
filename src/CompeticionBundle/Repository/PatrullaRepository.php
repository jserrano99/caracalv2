<?php

namespace CompeticionBundle\Repository;


/**
 * Description of CompeticionRepository
 *
 * @author jose
 */
class PatrullaRepository extends \Doctrine\orm\EntityRepository {
	
	public function queryMiembrosPatrulla($patrulla_id) {
		$em = $this->getEntityManager();
		$db = $em->getConnection();
		
		$query = "select miembros_patrulla.id as id "
				." ,miembros_patrulla.parti_ronda_id as partiRonda_id"
				." ,patrullas.id as patrulla_id "
				." ,patrullas.numero as patrulla_numero"
				." ,participantes_rondas.id as partiRonda_id "
				." ,participantes.id as participante_id "
				." ,participantes.dorsal "
				." ,modalidades.descripcion as modalidad "
				." ,modalidades.id as modalidad_id"
				." ,arqueros.id as arquero_id"
				." ,arqueros.licencia"
				." ,personas.id as persona_id"
				." ,personas.nif"
				." ,personas.nombre"
				." ,personas.apellido1"
				." ,personas.apellido2"
				." ,concat(personas.apellido1,' ',personas.apellido2,', ',personas.nombre) as apenom"
				." ,concat(personas.nombre,' ',personas.apellido1,' ',personas.apellido2) as nomape"
				." ,club.descripcion as club"
				." ,categorias.descripcion as categoria"
				." ,categorias.id as categoria_id  "		
				." from miembros_patrulla, patrullas, participantes_rondas, participantes, arqueros, personas, club, categorias, modalidades "
				. "where miembros_patrulla.patrulla_id = :patrulla_id "
				." and patrullas.id = miembros_patrulla.patrulla_id "
				." and participantes_rondas.inscrito = 'S' "
				." and participantes_rondas.id = miembros_patrulla.parti_ronda_id "
				." and participantes.id = participantes_rondas.participante_id "
				." and modalidades.id = participantes.modalidad_id"
				." and arqueros.id = participantes.arquero_id "
				." and club.id = arqueros.club_id "
				." and categorias.id = arqueros.categoria_id"
				." and personas.id = arqueros.persona_id "
				." order by apenom";
		
	
		$stmt = $db->prepare($query);
		$params = array(":patrulla_id" => $patrulla_id);
		$stmt->execute($params);
		$po = $stmt->fetchAll();
		
		return $po;
		
	}
	
	public function queryMiembrosSINPatrulla($ronda_id) {
		$em = $this->getEntityManager();
		$db = $em->getConnection();
		
		$query = "select participantes_rondas.id as partiRonda_id "
				." ,participantes.id as participante_id "
				." ,participantes.dorsal "
				." ,modalidades.descripcion as modalidad "
				." ,modalidades.id as modalidad_id"
				." ,arqueros.id as arquero_id"
				." ,arqueros.licencia"
				." ,personas.id as persona_id"
				." ,personas.nif"
				." ,personas.nombre"
				." ,personas.apellido1"
				." ,personas.apellido2"
				." ,concat(personas.apellido1,' ',personas.apellido2,', ',personas.nombre) as apenom"
				." ,concat(personas.nombre,' ',personas.apellido1,' ',personas.apellido2) as nomape"
				." ,club.descripcion as club"
				." ,categorias.descripcion as categoria"
				." ,categorias.id as categoria_id  "		
				." from participantes_rondas, participantes, arqueros, personas, club, categorias, modalidades "
				. "where participantes_rondas.id not in "
				. "					(SELECT miembros_patrulla.parti_ronda_id from miembros_patrulla, patrullas "
				."							      where miembros_patrulla.patrulla_id = patrullas.id "
				."								 and patrullas.ronda_id = :ronda_id) "
				." and participantes.id = participantes_rondas.participante_id "
                ." and participantes_rondas.ronda_id = :ronda_id "
				." and participantes_rondas.inscrito = 'S' "
				." and modalidades.id = participantes.modalidad_id"
				." and arqueros.id = participantes.arquero_id "
				." and club.id = arqueros.club_id "
				." and categorias.id = arqueros.categoria_id"
				." and personas.id = arqueros.persona_id "
				." order by apenom";
		
		$stmt = $db->prepare($query);
		$params = array(":ronda_id" => $ronda_id);
		$stmt->execute($params);
		$po = $stmt->fetchAll();
		
		return $po;
		
	}
	
	public function queryMiembrosPatrullaRonda($ronda_id) {
		$em = $this->getEntityManager();
		$db = $em->getConnection();
		
		$query = "select miembros_patrulla.id as id "
				." ,miembros_patrulla.parti_ronda_id as partiRonda_id"
				." ,patrullas.id as patrulla_id "
				." ,patrullas.numero as patrulla_numero"
				." ,participantes_rondas.id as partiRonda_id "
				." ,participantes.id as participante_id "
				." ,participantes.dorsal "
				." ,modalidades.descripcion as modalidad "
				." ,modalidades.id as modalidad_id"
				." ,arqueros.id as arquero_id"
				." ,arqueros.licencia"
				." ,personas.id as persona_id"
				." ,personas.nif"
				." ,personas.nombre"
				." ,personas.apellido1"
				." ,personas.apellido2"
				." ,concat(personas.apellido1,' ',personas.apellido2,', ',personas.nombre) as apenom"
				." ,concat(personas.nombre,' ',personas.apellido1,' ',personas.apellido2) as nomape"
				." ,club.descripcion as club"
				." ,categorias.descripcion as categoria"
				." ,categorias.id as categoria_id  "		
				." from rondas, miembros_patrulla, patrullas, participantes_rondas, participantes, arqueros, personas, club, categorias, modalidades "
				. "where rondas.id = :ronda_id "
				." and patrullas.ronda_id = rondas.id "
				." and miembros_patrulla.patrulla_id = patrullas.id "
				." and participantes_rondas.inscrito = 'S' "
				." and participantes_rondas.id = miembros_patrulla.parti_ronda_id "
				." and participantes.id = participantes_rondas.participante_id "
				." and modalidades.id = participantes.modalidad_id"
				." and arqueros.id = participantes.arquero_id "
				." and club.id = arqueros.club_id "
				." and categorias.id = arqueros.categoria_id"
				." and personas.id = arqueros.persona_id "
				." order by patrulla_numero, apenom";
		
	
		$stmt = $db->prepare($query);
		$params = array(":ronda_id" => $ronda_id);
		$stmt->execute($params);
		$po = $stmt->fetchAll();
		
		return $po;
		
	}
	
	public function queryPatrullas($ronda_id) {
		$em = $this->getEntityManager();
		$db = $em->getConnection();
		
		$query = "select * from patrullas  where patrullas.ronda_id = :ronda_id";
		$stmt = $db->prepare($query);
		$params = array(":ronda_id" => $ronda_id);
		$stmt->execute($params);
		$po = $stmt->fetchAll();
		
		return $po;
		
	}
	
	public function eliminarPatrullas($ronda_id) {
		$em = $this->getEntityManager();
		$db = $em->getConnection();
		
		$query = "delete from patrullas where patrullas.ronda_id = :ronda_id";
		$stmt = $db->prepare($query);
		$params = array(":ronda_id" => $ronda_id);
		$stmt->execute($params);
	
		
		return TRUE;
	}
	
	public function siguientePatrulla($ronda_id){
		$em = $this->getEntityManager();
		$db = $em->getConnection();
		
		$query = "select max(numero)+1 as numero from patrullas where patrullas.ronda_id = :ronda_id";
		$stmt = $db->prepare($query);
		$params = array(":ronda_id" => $ronda_id);
		$stmt->execute($params);
		$po = $stmt->fetch();
		if ($po["numero"] == null) 
			return 1;
		else
		    return $po["numero"];
	}
	
}
