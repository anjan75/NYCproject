<?php

class RailRoad {

	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function CreateRailRoad($data = null) {
		$data['creation_date'] = date('Y/m/d');
		/*$this->db->query("INSERT INTO RAILROAD (DESCRIPTION, CREATED_BY, CREATION_DATE) VALUES (:DESCRIPTION, :CREATED_BY, TO_DATE(:CREATION_DATE, 'yyyy/mm/dd HH24:MI:SS'))");
*/
		
		/*$this->db->query("INSERT INTO RAILROAD (RAILROAD_ID, DESCRIPTION, CREATED_BY, CREATION_DATE) VALUES (:RAILROAD_ID, :DESCRIPTION, :CREATED_BY, TO_DATE(:CREATION_DATE, 'yyyy/mm/dd HH24:MI:SS'))");
		$this->db->bind(':RAILROAD_ID', 200);*/
		$r = 'Lorem ipsum';
		$r1 = 2;
		$r2 = "TO_DATE(:CREATION_DATE, 'yyyy/mm/dd HH24:MI:SS'))";
		$query = 'BEGIN ECR2_PKG.Add_Railroad(:RAILROAD, :DESCRIPTION, :BUSINESS_UNIT_ID, :CREATED_BY, :CREATION_DATE); END;';
		$this->db->query($query);
		$this->db->bind(':RAILROAD', $r);
		$this->db->bind(':DESCRIPTION', $data['description']);
		$this->db->bind(':BUSINESS_UNIT_ID', $r1);
		$this->db->bind(':CREATED_BY', $data['created_by']);
		$this->db->bind(':CREATION_DATE', '');

		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function UpdateRailRoad($data = null) {
		$data['creation_date'] = date('Y/m/d');
		$this->db->query('UPDATE RAILROAD SET DESCRIPTION = :DESCRIPTION, CREATED_BY = :CREATED_BY WHERE RAILROAD_ID = :RAILROAD_ID');

		$this->db->bind(':RAILROAD_ID', $data['railroad_id']);
		$this->db->bind(':DESCRIPTION', $data['description']);
		$this->db->bind(':CREATED_BY', $data['created_by']);

		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}


	public function getRailRoadById($id='') {
		/*$this->db->query('SELECT * FROM RAILROAD WHERE RAILROAD_ID = :RAILROAD_ID');
		$this->db->bind(':RAILROAD_ID', $id);*/
		//$data = '';
		//$this->db->query('BEGIN ECR2_PKG.Get_Railroad(:RAILROAD_ID); END;');

		$query = 'BEGIN ECR2_PKG.Get_Railroad(:RAILROAD_ID, :RAILROAD); END;';
		$row = $this->db->refcurExecFetchAll($query, "Get Rail Road List","RAILROAD", array(array(":RAILROAD_ID", $id, 1)));

		/*$this->db->bind(':RAILROAD_ID', $id, PDO::PARAM_INT);
		$this->db->bind(':RAILROAD', $data);*/

		// $row = $this->db->singleArray();
		//$row = $this->db->execute();

		return $row;
	} 
	public function getRailRoadByName($name) {
		$this->db->query('SELECT * FROM RAILROAD WHERE DESCRIPTION = :DESCRIPTION');
		$this->db->bind(':DESCRIPTION', $name);

		$row = $this->db->singleArray();
		//$row = $this->db->execute();

		return $row;
	} 
	
	//Show Users data in in USER ADMINISTRATOR
	public function getRailRoads($inputs = null) {
		$page = isset($inputs['page']) ? $inputs['page'] : 1;
		$per_page = isset($inputs['per_page']) ? $inputs['per_page'] : 3;
		$this->db->query('SELECT *
						FROM RAILROAD						
						');
		//$this->db->query('CALL Get_Railroad()');

		$row = $this->db->resultArraySet();
		return $row;
	} 
	
	

	


}