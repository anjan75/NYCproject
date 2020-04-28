<?php

class Locations {

	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function CreateLocation($data = null) {
		$data['creation_date'] = date('Y/m/d');

		/*$this->db->query("INSERT INTO LOCATION (LOCATION_ID, DESCRIPTION, CREATED_BY, CREATION_DATE) VALUES (:LOCATION_ID, :DESCRIPTION, :CREATED_BY, TO_DATE(:CREATION_DATE, 'yyyy/mm/dd HH24:MI:SS'))");*/


		$query = 'BEGIN ECR2_PKG.Add_LOCATION(:LOCATION, :DESCRIPTION, :CREATED_BY, :CREATION_DATE); END;';
		$this->db->query($query);
		$this->db->bind(':LOCATION', $data['name']);
		$this->db->bind(':DESCRIPTION', $data['description']);
		$this->db->bind(':CREATED_BY', $data['created_by']);
		$this->db->bind(':CREATION_DATE', '');

		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function UpdateLocation($data = null) {
		$data['creation_date'] = date('Y/m/d');
		$this->db->query('UPDATE LOCATION SET LOCATION=:LOCATION, DESCRIPTION = :DESCRIPTION, CREATED_BY = :CREATED_BY WHERE LOCATION_ID = :LOCATION_ID');

		$this->db->bind(':LOCATION', $data['name']);
		$this->db->bind(':LOCATION_ID', $data['location_type_id']);
		$this->db->bind(':DESCRIPTION', $data['description']);
		//$this->db->bind(':BUSINESS_UNIT_ID', $data['business_unit_id']);
		$this->db->bind(':CREATED_BY', $data['created_by']);

		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}


	public function getLocationById($id='') {
		/*$this->db->query('SELECT * FROM LOCATION WHERE LOCATION_ID = :LOCATION_ID');
		$this->db->bind(':LOCATION_ID', $id);

		$row = $this->db->singleArray();

		return $row;*/
		/*$id = 70;*/
		$query = 'BEGIN ECR2_PKG.Get_LOCATION(:LOCATION_ID, :BUSINESS_UNIT_ID, :LOCATION); END;';
		$business_unit_id = $_SESSION['user_business_unit_id'];
		$row = $this->db->refcurExecFetchAll(
												$query, 
												"Get Location List",
												"LOCATION", 
												array(
													[":LOCATION_ID", $id, 0],
													[":BUSINESS_UNIT_ID", $business_unit_id, 0],
												)
											);
		
		return $row;
	} 
	public function getLocationByName($name) {
		$this->db->query('SELECT * FROM LOCATION WHERE NAME = :NAME');
		$this->db->bind(':NAME', $name);

		$row = $this->db->singleArray();

		return $row;
	} 
	
	//Show Users data in in USER ADMINISTRATOR
	public function getLocations($inputs = null) {
		$page = isset($inputs['page']) ? $inputs['page'] : 1;
		$per_page = isset($inputs['per_page']) ? $inputs['per_page'] : 3;
		$this->db->query('SELECT *
						FROM LOCATION						
						');

		$row = $this->db->resultArraySet();
		return $row;
	} 
	
	

	


}