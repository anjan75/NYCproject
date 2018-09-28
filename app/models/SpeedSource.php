<?php 
class SpeedSource {

	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function CreateSpeedSource($data = null) {
		$data['creation_date'] = date('Y/m/d');

		/*$this->db->query("INSERT INTO LOCATION_TYPE (LOCATION_TYPE_ID, DESCRIPTION, CREATED_BY, CREATION_DATE) VALUES (:LOCATION_TYPE_ID, :DESCRIPTION, :CREATED_BY, TO_DATE(:CREATION_DATE, 'yyyy/mm/dd HH24:MI:SS'))");*/
		$r1 = 1;

		$query = 'BEGIN ECR2_PKG.Add_OBS_SPEED_SOURCE(:SPEED_SOURCE, :DESCRIPTION,:BUSINESS_UNIT_ID :CREATED_BY, :CREATION_DATE); END;';
		$this->db->query($query);
		$this->db->bind(':TRACK_DESIGNATION', $data['trackcode']);
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

	public function UpdateTrack($data = null) {
		$data['creation_date'] = date('Y/m/d');
		$this->db->query('UPDATE LOCATION_TYPE SET DESCRIPTION = :DESCRIPTION, CREATED_BY = :CREATED_BY WHERE LOCATION_TYPE_ID = :LOCATION_TYPE_ID');

		$this->db->bind(':LOCATION_TYPE_ID', $data['location_type_id']);
		$this->db->bind(':DESCRIPTION', $data['description']);
		$this->db->bind(':CREATED_BY', $data['created_by']);

		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}


	public function getTrackById($id) {
	/*	$this->db->query('SELECT * FROM LOCATION_TYPE WHERE LOCATION_TYPE_ID = :LOCATION_TYPE_ID');
		$this->db->bind(':LOCATION_TYPE_ID', $id);

		$row = $this->db->singleArray();*/


		$query = 'BEGIN ECR2_PKG.Get_OBS_SPEED_SOURCE(:OBS_SPEED_SOURCE_ID, :SPEED_SOURCE); END;';
		$row = $this->db->refcurExecFetchAll($query, "Get obs speed","SPEED_SOURCE", array(array(":OBS_SPEED_SOURCE_ID", $id, 1)));


		return $row;
	} 
	public function getLocationTypeByName($name) {
		$this->db->query('SELECT * FROM LOCATION_TYPE WHERE NAME = :NAME');
		$this->db->bind(':NAME', $name);

		$row = $this->db->singleArray();

		return $row;
	} 
	
	//Show Users data in Track designation
	public function getSpeed_source($inputs = null) {
		$page = isset($inputs['page']) ? $inputs['page'] : 1;
		$per_page = isset($inputs['per_page']) ? $inputs['per_page'] : 3;
		$this->db->query('SELECT *
						FROM OBS_SPEED_SOURCE						
						');

		$row = $this->db->resultArraySet();
		return $row;
	} 
	
	

	


}