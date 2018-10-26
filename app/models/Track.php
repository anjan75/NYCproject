<?php

class Track {

	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function CreateTrack($data = null) {
		

		/*$this->db->query("INSERT INTO LOCATION_TYPE (LOCATION_TYPE_ID, DESCRIPTION, CREATED_BY, CREATION_DATE) VALUES (:LOCATION_TYPE_ID, :DESCRIPTION, :CREATED_BY, TO_DATE(:CREATION_DATE, 'yyyy/mm/dd HH24:MI:SS'))");*/

		$query = 'BEGIN ECR2_PKG.Add_TRACK_DESIGNATION(:TRACK_DESIGNATION, :DESCRIPTION,:BUSINESS_UNIT_ID, :CREATED_BY, :CREATION_DATE); END;';
		$this->db->query($query);
		$this->db->bind(':TRACK_DESIGNATION', $data['trackcode']);
		$this->db->bind(':DESCRIPTION', $data['description']);
		$this->db->bind(':BUSINESS_UNIT_ID', $data['business_unit_id']);
		$this->db->bind(':CREATED_BY', $data['created_by']);
		$this->db->bind(':CREATION_DATE', '');

		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function UpdateTrack($data = null) {
		$query = 'BEGIN ECR2_PKG.Update_TRACK_DESIGNATION(:TRACK_DESIGNATION_ID, :TRACK_DESIGNATION, :DESCRIPTION,:BUSINESS_UNIT_ID, :CREATED_BY, :CREATION_DATE, :STATUS); END;';
		$this->db->query($query);
		$this->db->bind(':TRACK_DESIGNATION_ID', $data['track_id']);
		$this->db->bind(':TRACK_DESIGNATION', $data['trackcode']);
		$this->db->bind(':DESCRIPTION', $data['description']);
		$this->db->bind(':BUSINESS_UNIT_ID', $data['business_unit_id']);
		$this->db->bind(':CREATED_BY', $data['created_by']);
		$this->db->bind(':CREATION_DATE', '');
		$this->db->bind(':STATUS', $data['Status']);

		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}


	public function getTrackById($id='') {
	/*	$this->db->query('SELECT * FROM LOCATION_TYPE WHERE LOCATION_TYPE_ID = :LOCATION_TYPE_ID');
		$this->db->bind(':LOCATION_TYPE_ID', $id);

		$row = $this->db->singleArray();*/


		
		$query = 'BEGIN ECR2_PKG.Get_TRACK_DESIGNATION(:TRACK_DESIGNATION_ID, :BUSINESS_UNIT_ID, :TRACK_DESIGNATION); END;';
		$business_unit_id = $_SESSION['user_business_unit_id'];
		$row = $this->db->refcurExecFetchAll(
												$query, 
												"Get Location List",
												"TRACK_DESIGNATION", 
												array(
													[":TRACK_DESIGNATION_ID", $id, 0],
													[":BUSINESS_UNIT_ID", $business_unit_id, 0],
												)
											);
		


		return $row;
	} 
	public function getLocationTypeByName($name) {
		$this->db->query('SELECT * FROM LOCATION_TYPE WHERE NAME = :NAME');
		$this->db->bind(':NAME', $name);

		$row = $this->db->singleArray();

		return $row;
	} 
	
	//Show Users data in Track designation
	public function getTracks($inputs = null) {
		$page = isset($inputs['page']) ? $inputs['page'] : 1;
		$per_page = isset($inputs['per_page']) ? $inputs['per_page'] : 3;
		/*$this->db->query('SELECT *
						FROM TRACK_DESIGNATION						
						');

		$row = $this->db->resultArraySet();*/

		$id='';
		$query = 'BEGIN ECR2_PKG.Get_TRACK_DESIGNATION(:TRACK_DESIGNATION_ID, :TRACK_DESIGNATION); END;';
		$row = $this->db->refcurExecFetchAll($query, "Get track List","TRACK_DESIGNATION", array(array(":TRACK_DESIGNATION_ID", $id, 0)));

		return $row;
	} 
	
	

	


}