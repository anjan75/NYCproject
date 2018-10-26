<?php

class Milepost {

	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function CreateMilepost($data = null) {
		
		$query = 'BEGIN ECR2_PKG.Add_MILEPOSTS(:MILEPOST_CODE, :DESCRIPTION, :BUSINESS_UNIT_ID, :CREATED_BY, :CREATION_DATE, :STATUS); END;';
		$this->db->query($query);
		$this->db->bind(':MILEPOST_CODE', $data['milepostcode']); // check
		$this->db->bind(':DESCRIPTION', $data['description']);
		$this->db->bind(':BUSINESS_UNIT_ID', $data['business_unit_id']);
		$this->db->bind(':CREATED_BY', $data['created_by']);
		$this->db->bind(':CREATION_DATE', '');
		$this->db->bind(':STATUS',  $data['status']);

		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function UpdateMilepost($data = null) {
		$data['creation_date'] = date('Y/m/d');

		$query = 'BEGIN ECR2_PKG.Update_MILEPOSTS(:MILEPOST_ID, :MILEPOST_CODE, :DESCRIPTION, :UPDATED_BY, :UPDATE_DATE, :STATUS); END;';
		$this->db->query($query);
		$this->db->bind(':MILEPOST_ID', $data['milepost_id']);
		$this->db->bind(':MILEPOST_CODE', $data['milepostcode']); // check
		$this->db->bind(':DESCRIPTION', $data['description']);
		
		$this->db->bind(':UPDATED_BY', $data['updated_by']);
		$this->db->bind(':UPDATE_DATE', '');
		$this->db->bind(':STATUS',  $data['status']);

		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}


	public function getMilepostById($id='') {
		
		$business_unit_id = $_SESSION['user_business_unit_id'];
		$this->db->query('SELECT *
						 FROM MILEPOST 
						 WHERE BUSINESS_UNIT_ID = :BUSINESS_UNIT_ID
						');
		$this->db->bind(':BUSINESS_UNIT_ID', $business_unit_id);
		$rows = $this->db->resultArraySet();

		return $rows;
	} 





/*	public function getMilepostByName($name) {
		$this->db->query('SELECT * FROM MILEPOST_CODE WHERE DESCRIPTION = :DESCRIPTION');
		$this->db->bind(':DESCRIPTION', $name);

		$row = $this->db->singleArray();
		//$row = $this->db->execute();

		return $row;
	} */
	public function isMilepostExists($name, $desc) {
		$this->db->query('SELECT MILEPOST_ID FROM MILEPOSTS WHERE DESCRIPTION = :DESCRIPTION OR MILEPOST_CODE = :MILEPOST_CODE');
		$this->db->bind(':MILEPOST_CODE', $name);
		$this->db->bind(':DESCRIPTION', $desc);

		$row = $this->db->singleArray();

		if (isset($row['MILEPOST_ID']) && $row['MILEPOST_ID'] > 0) {
			return true;
		}
		return false;
	} 

	//Show Users data in in USER ADMINISTRATOR
	public function getMileposts($inputs = null) {
		$page = isset($inputs['page']) ? $inputs['page'] : 1;
		$per_page = isset($inputs['per_page']) ? $inputs['per_page'] : 3;
		$this->db->query('SELECT *
						FROM MILEPOST_CODE						
						');
		//$this->db->query('CALL Get_MILEPOST()');

		$row = $this->db->resultArraySet();
		return $row;
	} 
	
	

	


}