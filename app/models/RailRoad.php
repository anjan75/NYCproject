
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
		/*$r = 'Lorem ipsum';
		$r1 = 2;*/
		//$r2 = "TO_DATE(:CREATION_DATE, 'yyyy/mm/dd HH24:MI:SS'))";
		$query = 'BEGIN ECR2_PKG.Add_Railroad(:RAILROAD, :DESCRIPTION, :BUSINESS_UNIT_ID, :CREATED_BY, :CREATION_DATE, :STATUS); END;';
		$this->db->query($query);
		$this->db->bind(':RAILROAD', $data['railroad']);
		$this->db->bind(':DESCRIPTION', $data['description']);
		$this->db->bind(':BUSINESS_UNIT_ID', $data['business_unit_id']);
		$this->db->bind(':CREATED_BY', $data['created_by']);
		$this->db->bind(':CREATION_DATE', '');
		$this->db->bind(':STATUS', $data['status']);

		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function UpdateRailRoad($data = null) {
		$query = 'BEGIN ECR2_PKG.Update_Railroad(:RAILROAD_ID, :RAILROAD, :DESCRIPTION, :BUSINESS_UNIT_ID, :UPDATED_BY, :UPDATE_DATE, :STATUS); END;';
		$this->db->query($query);



		/*$this->db->bind(':')*/
		$this->db->bind(':RAILROAD_ID', $data['railroad_id']);
		$this->db->bind(':RAILROAD', $data['railroad']);
		$this->db->bind(':DESCRIPTION', $data['description']);
		$this->db->bind(':BUSINESS_UNIT_ID', $data['business_unit_id']);
		$this->db->bind(':UPDATED_BY', $data['updated_by']);
		$this->db->bind(':UPDATE_DATE', '');
		$this->db->bind(':STATUS', $data['status']);

		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}


	public function getRailRoadById($id='') {
		/*$id = 70;*/
		$query = 'BEGIN ECR2_PKG.Get_Railroad(:RAILROAD_ID, :BUSINESS_UNIT_ID, :START, :END, :RAILROAD); END;';
		$business_unit_id = $_SESSION['user_business_unit_id'];
		$row = $this->db->refcurExecFetchAll(
												$query, 
												"Get Rail Road List",
												"RAILROAD", 
												array(
													[":RAILROAD_ID", $id, 1],
													[":BUSINESS_UNIT_ID", $business_unit_id, 0],
													[":START", 0, 1],
													[":END", 10000, 0],
													
												)
											);
		
		return $row;
	} 
/*	public function getRailRoadByName($name) {
		$this->db->query('SELECT * FROM RAILROAD WHERE DESCRIPTION = :DESCRIPTION');
		$this->db->bind(':DESCRIPTION', $name);

		$row = $this->db->singleArray();
		//$row = $this->db->execute();

		return $row;
	} 
	*/
	public function isRailRoadExists($name, $desc) {
		$this->db->query('SELECT RAILROAD_ID FROM RAILROAD WHERE DESCRIPTION = :DESCRIPTION OR RAILROAD = :RAILROAD');
		$this->db->bind(':RAILROAD', $name);
		$this->db->bind(':DESCRIPTION', $desc);

		$row = $this->db->singleArray();

		if (isset($row['RAILROAD_ID']) && $row['RAILROAD_ID'] > 0) {
			return true;
		}
		return false;
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