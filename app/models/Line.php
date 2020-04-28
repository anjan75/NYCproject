<?php

class Line {

	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function CreateLine($data = null) {
		
		$query = 'BEGIN ECR2_PKG.Add_LINES(:LINE_CODE, :DESCRIPTION, :BUSINESS_UNIT_ID, :CREATED_BY, :CREATION_DATE, :STATUS); END;';
		$this->db->query($query);
		$this->db->bind(':LINE_CODE', $data['linecode']); // check
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

	public function UpdateLine($data = null) {
		$data['creation_date'] = date('Y/m/d');

		$query = 'BEGIN ECR2_PKG.Update_LINES(:LINE_ID, :LINE_CODE, :DESCRIPTION, :UPDATED_BY, :UPDATE_DATE, :STATUS); END;';
		$this->db->query($query);
		$this->db->bind(':LINE_ID', $data['line_id']);
		$this->db->bind(':LINE_CODE', $data['linecode']); // check
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


	public function getLineById($id='') {
		
		/*$query = 'BEGIN ECR2_PKG.Get_LINES(:LINE_ID, :LINES); END;';
		$row = $this->db->refcurExecFetchAll($query, "Get line List","LINES", array(array(":LINE_ID", $id, 1)));*/


		$query = 'BEGIN ECR2_PKG.Get_LINES(:LINE_ID, :BUSINESS_UNIT_ID, :START, :END, :LINES); END;';
		$row = $this->db->refcurExecFetchAll(
												$query, 
												"Get Rail Road List",
												"LINES", 
												array(
													[":LINE_ID", $id, 1],
													[":BUSINESS_UNIT_ID", $id, 0],
													[":START", 0, 1],
													[":END", 10000, 0]
													
												)
											);



		return $row;
	} 





/*	public function getLineByName($name) {
		$this->db->query('SELECT * FROM LINE_CODE WHERE DESCRIPTION = :DESCRIPTION');
		$this->db->bind(':DESCRIPTION', $name);

		$row = $this->db->singleArray();
		//$row = $this->db->execute();

		return $row;
	} */
	public function isLineExists($name, $desc) {
		$this->db->query('SELECT LINE_ID FROM LINES WHERE DESCRIPTION = :DESCRIPTION OR LINE_CODE = :LINE_CODE');
		$this->db->bind(':LINE_CODE', $name);
		$this->db->bind(':DESCRIPTION', $desc);

		$row = $this->db->singleArray();

		if (isset($row['LINE_ID']) && $row['LINE_ID'] > 0) {
			return true;
		}
		return false;
	} 

	//Show Users data in in USER ADMINISTRATOR
	public function getLines($inputs = null) {
		$page = isset($inputs['page']) ? $inputs['page'] : 1;
		$per_page = isset($inputs['per_page']) ? $inputs['per_page'] : 3;
		$this->db->query('SELECT *
						FROM LINE_CODE						
						');
		//$this->db->query('CALL Get_LINE()');

		$row = $this->db->resultArraySet();
		return $row;
	} 
	
	

	


}