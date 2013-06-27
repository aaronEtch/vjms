<?php
class Detail_view extends CI_Model {
	function getWineName($theWineId){
	$query = $this->db->query("SELECT wines.wineName FROM wines where wines.wineId = '$theWineId' LIMIT 1");
	$row = $query->row();
	return $row->wineName;
	}
	function getWineHist($currentWine){

		$q = $this->db->query("SELECT theMaking.calendarId, theMaking.wineId, theMaking.date, theMaking.notes, wineActionsDesc.desc as process, wineActionsDesc.actionsKind as actionKind, wineActionsValue.value as labValue, wineActionsValue.unit as labUnit 

FROM `theMaking` natural join `wineActions` natural join `wineActionsDesc` natural join `wineActionsValue` 

WHERE theMaking.wineActionsId = wineActions.wineActionsId AND wineActions.wineActionsDescId = wineActionsDesc.wineActionsDescId AND wineActions.wineActionsValueId = wineActionsValue.wineActionsValueId AND theMaking.wineId = '$currentWine' ORDER BY date DESC ");
		
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		}
	function getFormWineProcess(){
		// get wine process desc options
		$q = $this->db->query("SELECT wineActionsDesc.wineActionsDescId, wineActionsDesc.desc FROM `wineActionsDesc` WHERE wineActionsDesc.actionsKind = 'winePro'");
		
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		}	
	function getFormLabProcess(){
		// get lab process desc options
		$q = $this->db->query("SELECT wineActionsDesc.wineActionsDescId, wineActionsDesc.desc FROM `wineActionsDesc` 
								WHERE wineActionsDesc.actionsKind = 's02' OR wineActionsDesc.actionsKind = 'ph' 
								OR wineActionsDesc.actionsKind = 'ta' OR wineActionsDesc.actionsKind = 'oak'");
		
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		}
/*	function getMostRecentCalendarId(){

		$q = $this->db->query("SELECT theMaking.calendarId FROM `theMaking` order by theMaking.calendarId DESC limit 1");
		
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		}
 */
/* rebuidling this
	function addRecord($data, $data2, $dbName){
		// insert into the theMakings	
		$this->db->insert('theMaking',$data);
		// insert into either wProcess table or labActons table
		$this->db->insert($dbName,$data2);
		// create query to get the  new calendar id and put it on either wProcess or labActions
		$sql ="	UPDATE `$dbName`
				SET calendarId =
				(SELECT theMaking.calendarId FROM `theMaking` order by theMaking.calendarId DESC limit 1)
				WHERE 
				$dbName.calendarId = ''";
		$this->db->query($sql);
		}
 */
	function addWineProcessRecord($data, $descIdPost){
		// find action id number to insert into the making 	 
		$query = $this->db->query("SELECT wineActions.wineActionsId FROM `wineActions` WHERE  wineActions.wineActionsDescId = '$descIdPost' LIMIT 1");
		// add the single result into an array
		$row = $query->row_array();
		// add result to array to be inserting into theMaking
		$data['wineActionsId'] = $row['wineActionsId'];		
		// insert into the theMakings
		$this->db->insert('theMaking',$data);
		}	
	function updateWineProcessRecord($data, $descIdPost){
		// find action id number to insert into the making 	 
		$query = $this->db->query("SELECT wineActions.wineActionsId FROM `wineActions` WHERE  wineActions.wineActionsDescId = '$descIdPost' LIMIT 1");
		// add the single result into an array
		$row = $query->row_array();
		// add result to array to be inserting into theMaking
		$data['wineActionsId'] = $row['wineActionsId'];		
		// insert into the theMakings
		//echo "calendar id ". $data['calendarId'];
		$this->db->where('calendarId', $data['calendarId']);
		$this->db->update('theMaking',$data);
		}	
		
	function addLabProcessRecord($data, $dataLab){
		// find if wine Action value exist already	 
		$qValue = $dataLab['labValue'];
		$qUnit =  $dataLab['labUnit'];
		// run a query to see if a wine actions value already exists, if not add it
		do{
		$query = $this->db->query("SELECT wineActionsValue.wineActionsValueId FROM `wineActionsValue` 
									WHERE  wineActionsValue.value = '$qValue' AND wineActionsValue.unit = '$qUnit' LIMIT 1");
		// see if results
		if($query->num_rows() == 0) {
			// add new value record
			$sql = "INSERT INTO `wineActionsValue` (wineActionsValue.value, wineActionsValue.unit)
        	VALUES ('$qValue', '$qUnit')";	
			$this->db->query($sql);	
		}	
		} // end do while loop
		while ($query->num_rows() == 0);
		// add the single result into an array
		$row = $query->row_array();
		// this is our value id
		$qValueId = $row['wineActionsValueId'];	
//		echo $qValueId . "<br>";
		$qActionDesc = $dataLab['wineActionsDescId'];
//		echo $qActionDesc;
		// see if there is a match for value id and desc id
		// if one does not exist, create it
		do{
		$aQuery = $this->db->query("SELECT wineActions.wineActionsId FROM `wineActions` 
									WHERE  wineActions.wineActionsDescId = '$qActionDesc' AND wineActions.wineActionsValueId = '$qValueId' LIMIT 1");
		// see if results
		if($aQuery->num_rows() == 0) {
			// add new value record
			$sql = "INSERT INTO `wineActions` (wineActions.wineActionsDescId, wineActions.wineActionsValueId)
        	VALUES ('$qActionDesc', '$qValueId')";	
			$this->db->query($sql);	
		}	
		} // end do while loop
		while ($aQuery->num_rows() == 0);
		// add the single result into an array
		$aRow = $aQuery->row_array();
		// this is our value id
		$data['wineActionsId'] = $aRow['wineActionsId'];	
//		echo "<br> wine action id: ". $qWineActionId;		
		
//		 insert into the theMakings
		$this->db->insert('theMaking',$data);		
		// if yes, then check wineActions for match in desc Id
//		$qActionDesc = $dataLab['wineActionsDescId'];
		// add the single result into an array
//		$row = $query->row_array();
//		$qValueId = $row['wineActionsValueId'];	
//		$query2 = $this->db->query("SELECT wineActions.WineActionsId FROM `wineActions` 
//									WHERE  wineActions.wineActionsDescId = '$qActionDesc' AND wineActions.wineActionsValueId = '$qValueId' LIMIT 1");
		// see if results
		
		
		
		// add the single result into an array
//		$row = $query->row_array();
		// add result to array to be inserting into theMaking
//		$data['wineActionsId'] = $row['wineActionsId'];		
		// insert into the theMakings
//		$this->db->insert('theMaking',$data);
//		}			

		// insert into either wProcess table or labActons table
//		$this->db->insert($dbName,$data2);
		// create query to get the  new calendar id and put it on either wProcess or labActions
//		$sql ="	UPDATE `$dbName`
//				SET calendarId =
//				(SELECT theMaking.calendarId FROM `theMaking` order by theMaking.calendarId DESC limit 1)
//				WHERE 
//				$dbName.calendarId = ''";
//		$this->db->query($sql);
		}
function updateLabProcessRecord($data, $dataLab){
		// find if wine Action value exist already	 
		$qValue = $dataLab['labValue'];
		$qUnit =  $dataLab['labUnit'];
		// run a query to see if a wine actions value already exists, if not add it
		do{
		$query = $this->db->query("SELECT wineActionsValue.wineActionsValueId FROM `wineActionsValue` 
									WHERE  wineActionsValue.value = '$qValue' AND wineActionsValue.unit = '$qUnit' LIMIT 1");
		// see if results
		if($query->num_rows() == 0) {
			// add new value record
			$sql = "INSERT INTO `wineActionsValue` (wineActionsValue.value, wineActionsValue.unit)
        	VALUES ('$qValue', '$qUnit')";	
			$this->db->query($sql);	
		}	
		} // end do while loop
		while ($query->num_rows() == 0);
		// add the single result into an array
		$row = $query->row_array();
		// this is our value id
		$qValueId = $row['wineActionsValueId'];	
//		echo $qValueId . "<br>";
		$qActionDesc = $dataLab['wineActionsDescId'];
//		echo $qActionDesc;
		// see if there is a match for value id and desc id
		// if one does not exist, create it
		do{
		$aQuery = $this->db->query("SELECT wineActions.wineActionsId FROM `wineActions` 
									WHERE  wineActions.wineActionsDescId = '$qActionDesc' AND wineActions.wineActionsValueId = '$qValueId' LIMIT 1");
		// see if results
		if($aQuery->num_rows() == 0) {
			// add new value record
			$sql = "INSERT INTO `wineActions` (wineActions.wineActionsDescId, wineActions.wineActionsValueId)
        	VALUES ('$qActionDesc', '$qValueId')";	
			$this->db->query($sql);	
		}	
		} // end do while loop
		while ($aQuery->num_rows() == 0);
		// add the single result into an array
		$aRow = $aQuery->row_array();
		// this is our value id
		$data['wineActionsId'] = $aRow['wineActionsId'];	
//		echo "<br> wine action id: ". $qWineActionId;		
		
//		 insert into the theMakings
		//$this->db->insert('theMaking',$data);		
		
		echo "calendar id ". $data['calendarId'];
		$this->db->where('calendarId', $data['calendarId']);
		$this->db->update('theMaking',$data);
		
		// if yes, then check wineActions for match in desc Id
		
		}
	function updateRecord($data) {
		$this->db->where('id',14 );
		$this->db->update('theMaking',$data);
	}
	function deleteTheMakingRecord($recordToDelete){
		$this->db->where('calendarId',$recordToDelete);
		$this->db->delete('theMaking');
	}
	
	
	
	
	}
?>