<?php

class LocationTypes {

	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function CreateLocationType($data = null) {
		$data['creation_date'] = date('Y/m/d');
		//$this->db->query("INSERT INTO LOCATION_TYPE (DESCRIPTION, CREATED_BY, CREATION_DATE) VALUES (:DESCRIPTION, :CREATED_BY, TO_DATE(:CREATION_DATE, 'yyyy/mm/dd HH24:MI:SS'))");

		
		$this->db->query("INSERT INTO LOCATION_TYPE (LOCATION_TYPE_ID, DESCRIPTION, CREATED_BY, CREATION_DATE) VALUES (:LOCATION_TYPE_ID, :DESCRIPTION, :CREATED_BY, TO_DATE(:CREATION_DATE, 'yyyy/mm/dd HH24:MI:SS'))");
		$this->db->bind(':LOCATION_TYPE_ID', 300);
		

		$this->db->bind(':DESCRIPTION', $data['description']);
		$this->db->bind(':CREATED_BY', $data['created_by']);
		$this->db->bind(':CREATION_DATE', $data['creation_date']);

		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function UpdateLocationType($data = null) {
		$data['creation_date'] = date('Y/m/d');
		$this->db->query('UPDATE LOCATION_TYPE SET DESCRIPTION = :DESCRIPTION, CREATED_BY = :CREATED_BY WHERE LOCATION_TYPE_ID = :LOCATION_TYPE_ID');

		$this->db->bind(':LOCATION_TYPE_ID', $data['location_type_id']);
		$this->db->bind(':DESCRIPTION', $data['decription']);
		$this->db->bind(':CREATED_BY', $data['created_by']);

		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}


	public function getLocationTypeById($id) {
		$this->db->query('SELECT * FROM LOCATION_TYPE WHERE LOCATION_TYPE_ID = :LOCATION_TYPE_ID');
		$this->db->bind(':LOCATION_TYPE_ID', $id);

		$row = $this->db->singleArray();

		return $row;
	} 
	public function getLocationTypeByName($name) {
		$this->db->query('SELECT * FROM LOCATION_TYPE WHERE NAME = :NAME');
		$this->db->bind(':NAME', $name);

		$row = $this->db->singleArray();

		return $row;
	} 
	
	//Show Users data in in USER ADMINISTRATOR
	public function getLocationTypes($inputs = null) {
		$page = isset($inputs['page']) ? $inputs['page'] : 1;
		$per_page = isset($inputs['per_page']) ? $inputs['per_page'] : 3;
		$this->db->query('SELECT *
						FROM LOCATION_TYPE						
						');

		$row = $this->db->resultArraySet();
		return $row;
	} 
	
	

	


}