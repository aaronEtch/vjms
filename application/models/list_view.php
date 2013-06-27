<?php
class List_view extends CI_Model {
	function getList($currentUserId){

		$q = $this->db->query("
		SELECT wines.wineName, wines.wineId,wines.id, wines.quantity, wines.vintage,wines.container,varietals.varietalName,
		
		(SELECT wineActionsDesc.desc FROM `theMaking` natural join `wineActions` natural join `wineActionsDesc` WHERE theMaking.wineActionsId = wineActions.wineActionsId AND 
		
		wineActions.wineActionsDescId = wineActionsDesc.wineActionsDescId AND theMaking.wineId = wines.wineId AND date < now() order by date DESC limit 1) As lastAction,
		
		(SELECT theMaking.date FROM `theMaking` natural join `wineActions` natural join `wineActionsDesc` WHERE theMaking.wineActionsId = wineActions.wineActionsId AND 
		
		wineActions.wineActionsDescId = wineActionsDesc.wineActionsDescId AND wineActionsDesc.actionsKind='winePro' AND theMaking.wineId = wines.wineId AND date < now() order 
		
		by date DESC limit 1) As lastActionDate,
		
		(SELECT wineActionsDesc.desc FROM `theMaking` natural join `wineActions` natural join `wineActionsDesc` WHERE theMaking.wineActionsId = wineActions.wineActionsId AND 
		
		wineActions.wineActionsDescId = wineActionsDesc.wineActionsDescId AND theMaking.wineId = wines.wineId AND date > now() order by date ASC limit 1) As nextAction,
		
		(SELECT theMaking.date FROM `theMaking` natural join `wineActions` natural join `wineActionsDesc` WHERE theMaking.wineActionsId = wineActions.wineActionsId AND 
		
		wineActions.wineActionsDescId = wineActionsDesc.wineActionsDescId AND wineActionsDesc.actionsKind='winePro' AND theMaking.wineId = wines.wineId AND date > now() order 
		
		by date ASC limit 1) As nextActionDate,
		
		# s02
		
		(SELECT wineActionsValue.value FROM `theMaking` natural join `wineActions` natural join `wineActionsValue` WHERE theMaking.wineActionsId = wineActions.wineActionsId 
		
		AND wineActions.wineActionsValueId = wineActionsValue.wineActionsValueId  AND theMaking.wineId = wines.wineId AND wineActions.wineActionsDescId ='1' AND date < now() 
		
		order by date DESC limit 1) AS lastS02CheckVal,
		
		(SELECT theMaking.date FROM `theMaking` natural join `wineActions` natural join `wineActionsValue` WHERE theMaking.wineActionsId = wineActions.wineActionsId AND 
		
		wineActions.wineActionsValueId = wineActionsValue.wineActionsValueId AND theMaking.wineId = wines.wineId AND wineActions.wineActionsDescId ='1' AND date < now() 
		
		order by date DESC limit 1) AS lastS02CheckDate,
		
		(SELECT wineActionsValue.value FROM `theMaking` natural join `wineActions` natural join `wineActionsValue` WHERE theMaking.wineActionsId = wineActions.wineActionsId 
		
		AND wineActions.wineActionsValueId = wineActionsValue.wineActionsValueId AND theMaking.wineId = wines.wineId AND wineActions.wineActionsDescId ='2' AND date < now() 
		
		order by date DESC limit 1) AS lastS02AddVal,
		
		(SELECT theMaking.date FROM `theMaking` natural join `wineActions` natural join `wineActionsValue` WHERE theMaking.wineActionsId = wineActions.wineActionsId AND 
		
		wineActions.wineActionsValueId = wineActionsValue.wineActionsValueId AND theMaking.wineId = wines.wineId AND wineActions.wineActionsDescId ='2' AND date < now() 
		
		order by date DESC limit 1) AS lastS02AddDate,
		
		# PH
		
		(SELECT wineActionsValue.value FROM `theMaking` natural join `wineActions` natural join `wineActionsValue` WHERE theMaking.wineActionsId = wineActions.wineActionsId 
		
		AND wineActions.wineActionsValueId = wineActionsValue.wineActionsValueId  AND theMaking.wineId = wines.wineId AND wineActions.wineActionsDescId ='3' AND date < now() 
		
		order by date DESC limit 1) AS lastPHCheckVal,
		
		(SELECT theMaking.date FROM `theMaking` natural join `wineActions` natural join `wineActionsValue` WHERE theMaking.wineActionsId = wineActions.wineActionsId AND 
		
		wineActions.wineActionsValueId = wineActionsValue.wineActionsValueId AND theMaking.wineId = wines.wineId AND wineActions.wineActionsDescId ='3' AND date < now() 
		
		order by date DESC limit 1) AS lastPHCheckDate,
		
		(SELECT wineActionsDesc.desc FROM `theMaking` natural join `wineActions` natural join `wineActionsDesc` WHERE theMaking.wineActionsId = wineActions.wineActionsId  AND wineActions.wineActionsDescId = wineActionsDesc.wineActionsDescId  AND theMaking.wineId = wines.wineId AND wineActionsDesc.actionsKind ='ph' AND wineActionsDesc.actionsModType = 'add' AND date < now() order by date DESC limit 1) AS lastPHActionDesc,
		
		(SELECT theMaking.date FROM `theMaking` natural join `wineActions` natural join `wineActionsDesc` WHERE theMaking.wineActionsId = wineActions.wineActionsId  AND wineActions.wineActionsDescId = wineActionsDesc.wineActionsDescId  AND theMaking.wineId = wines.wineId AND wineActionsDesc.actionsKind ='ph' AND wineActionsDesc.actionsModType = 'add' AND date < now() order by date DESC limit 1) AS lastPHActionDate,
		
		(SELECT wineActionsValue.value FROM `theMaking` natural join `wineActions` natural join `wineActionsDesc` natural join `wineActionsValue` WHERE theMaking.wineActionsId = wineActions.wineActionsId  AND wineActions.wineActionsDescId = wineActionsDesc.wineActionsDescId  AND wineActions.wineActionsValueId = wineActionsValue.wineActionsValueId AND theMaking.wineId = wines.wineId AND wineActionsDesc.actionsKind ='ph' AND wineActionsDesc.actionsModType = 'add' AND date < now() order by date DESC limit 1) AS lastPHActionValue,
		
		# TA
		
		(SELECT wineActionsValue.value FROM `theMaking` natural join `wineActions` natural join `wineActionsValue` WHERE theMaking.wineActionsId = wineActions.wineActionsId 
		
		AND wineActions.wineActionsValueId = wineActionsValue.wineActionsValueId  AND theMaking.wineId = wines.wineId AND wineActions.wineActionsDescId ='6' AND date < now() 
		
		order by date DESC limit 1) AS lastTACheckVal,
		
		(SELECT theMaking.date FROM `theMaking` natural join `wineActions` natural join `wineActionsValue` WHERE theMaking.wineActionsId = wineActions.wineActionsId AND 
		
		wineActions.wineActionsValueId = wineActionsValue.wineActionsValueId AND theMaking.wineId = wines.wineId AND wineActions.wineActionsDescId ='6' AND date < now() 
		
		order by date DESC limit 1) AS lastTACheckDate,
		
		(SELECT wineActionsDesc.desc FROM `theMaking` natural join `wineActions` natural join `wineActionsDesc` WHERE theMaking.wineActionsId = wineActions.wineActionsId  AND wineActions.wineActionsDescId = wineActionsDesc.wineActionsDescId  AND theMaking.wineId = wines.wineId AND wineActionsDesc.actionsKind ='ta' AND wineActionsDesc.actionsModType = 'add' AND date < now() order by date DESC limit 1) AS lastTAActionDesc,
		
		(SELECT theMaking.date FROM `theMaking` natural join `wineActions` natural join `wineActionsDesc` WHERE theMaking.wineActionsId = wineActions.wineActionsId  AND wineActions.wineActionsDescId = wineActionsDesc.wineActionsDescId  AND theMaking.wineId = wines.wineId AND wineActionsDesc.actionsKind ='ta' AND wineActionsDesc.actionsModType = 'add' AND date < now() order by date DESC limit 1) AS lastTAActionDate,
		
		(SELECT wineActionsValue.value FROM `theMaking` natural join `wineActions` natural join `wineActionsDesc` natural join `wineActionsValue` WHERE theMaking.wineActionsId = wineActions.wineActionsId  AND wineActions.wineActionsDescId = wineActionsDesc.wineActionsDescId  AND wineActions.wineActionsValueId = wineActionsValue.wineActionsValueId AND theMaking.wineId = wines.wineId AND wineActionsDesc.actionsKind ='ta' AND wineActionsDesc.actionsModType = 'add' AND date < now() order by date DESC limit 1) AS lastTAActionValue,
		
		# Oak
		
		(SELECT wineActionsDesc.desc FROM `theMaking` natural join `wineActions` natural join `wineActionsDesc` WHERE theMaking.wineActionsId = wineActions.wineActionsId  AND wineActions.wineActionsDescId = wineActionsDesc.wineActionsDescId  AND theMaking.wineId = wines.wineId AND wineActionsDesc.actionsKind ='oak' AND wineActionsDesc.actionsModType = 'add' AND date < now() order by date DESC limit 1) AS lastOakAction,
		
		(SELECT theMaking.date FROM `theMaking` natural join `wineActions` natural join `wineActionsDesc` WHERE theMaking.wineActionsId = wineActions.wineActionsId  AND wineActions.wineActionsDescId = wineActionsDesc.wineActionsDescId  AND theMaking.wineId = wines.wineId AND wineActionsDesc.actionsKind ='oak' AND wineActionsDesc.actionsModType = 'add' AND date < now() order by date DESC limit 1) AS lastOakActionDate
		
		
		FROM `users`
		NATURAL JOIN `wines` NATURAL JOIN `varietals`
		WHERE users.id = '$currentUserId' ORDER BY wines.vintage DESC
		");
		
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		}
		function getVarietalIdNumber ($data){
			$query = $this->db->query("SELECT varietals.varietalId FROM `varietals` WHERE varietals.varietalName = '$data'");
			if($query->num_rows() == 0) {
		 	$sql = "INSERT INTO `vjms`.`varietals` (`varietalId`, `varietalName`) VALUES (NULL, '$data')";
			$this->db->query($sql);
		 	$query = $this->db->query("SELECT varietals.varietalId FROM `varietals` WHERE varietals.varietalName = '$data'");
		 	}
			return $query->row()->varietalId;
	
		}
		function addWineRecord($data){
		// adds wine record to database
		$this->db->insert('wines',$data);	
		}
		function updateWineRecord($data, $wineIdRecordToUpdate){
		// adds wine record to database
		$this->db->where('wineId', $wineIdRecordToUpdate);
		$this->db->update('wines',$data); 	
		}
		function deleteWineRecord($recordToDelete){
		$this->db->where('wineId',$recordToDelete);
		$this->db->delete('wines');
		}
		function getValietalList(){
		// get lab process desc options
		$q = $this->db->query("SELECT `varietalName` FROM `varietals`");
		
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		}
	}

?>