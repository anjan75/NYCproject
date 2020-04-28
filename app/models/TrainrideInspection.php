<?php

class TrainrideInspection {

	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function CreateInspection($data = null) {
		$data['creation_date'] = date('Y/m/d');
		
		$query = "BEGIN ECR2_PKG.Add_INSPECTIONS(:INSPECTION_ID, :INSPECTION_TYPE_ID, :TESTING_OFFICER, :RAILROAD_ID, :OBSERVED_EMPLOYEE, :CREW_NUMBER, :TRAIN_NUMBER, :DEPARTMENT_ID, :OCCUPATION_ID, :DESCRIPTION, :PLAN_ID, TO_DATE(:INSPETION_DATE, 'MM/DD/YYYY'), :ENTERED_BY, :CREATION_DATE ); END;"; //'YYYY-MM-DD HH24:MI:SS'
		$this->db->query($query);
		
		$this->db->bind(':INSPECTION_ID', $data['inspection_id']);
		$this->db->bind(':INSPECTION_TYPE_ID', $data['inspection_type_id']);
		$this->db->bind(':TESTING_OFFICER', $data['testing_officer']);
		$this->db->bind(':RAILROAD_ID', $data['railroad_id']);
		$this->db->bind(':OBSERVED_EMPLOYEE', $data['observed_employee']);
		$this->db->bind(':CREW_NUMBER', $data['crew_number']);
		$this->db->bind(':TRAIN_NUMBER', $data['train_number']);
		$this->db->bind(':DEPARTMENT_ID', $data['department_id']);
		$this->db->bind(':OCCUPATION_ID', $data['occupation_id']);
		$this->db->bind(':DESCRIPTION', $data['description']);
		$this->db->bind(':PLAN_ID', $data['plan_id']);
		$this->db->bind(':INSPETION_DATE', $data['inspection_date']);
		$this->db->bind(':ENTERED_BY', $data['entered_by']);
		$this->db->bind(':CREATION_DATE', '');

		if($this->db->execute()) {
			//$id = $this->db->lastInsertId();
			return true;
		} else {
			return false;
		}
	}

	public function CreateTrainrideInspectionObservation($data = null) {
		
		$query = "BEGIN ECR2_PKG.Add_INSPECTION_OBSERVATIONS(:INSPECTION_ID, :OBSERVATION_NUM, :LINE, :LOCATION_TYPE, :LOCATION, :MILEPOST, :OBSERVATION_TYPE, :MONTHLY_TEST_FLAG, :TASK, :RULES, :OUTCOMES, :NON_COMPLIANT, :OBS_SPEED, :POSTED_SPEED, :OBS_SPEED_SRC, TO_DATE(:OBSERVATION_DATE, 'MM/DD/YYYY'), :COMMENTS, :CREATED_BY, :CREATION_DATE, :TRACK_DESIGNATION_ID, :ENGINE_NUM  ); END;"; //'YYYY-MM-DD HH24:MI:SS'
		$this->db->query($query);
		
		$this->db->bind(':INSPECTION_ID', $data['inspection_id']);
		$this->db->bind(':OBSERVATION_NUM', $data['observation_num']);
		$this->db->bind(':LINE', $data['line']);
		$this->db->bind(':LOCATION_TYPE', $data['location_type']);
		$this->db->bind(':LOCATION', $data['location']);
		$this->db->bind(':MILEPOST', $data['milepost']);
		$this->db->bind(':OBSERVATION_TYPE', $data['observation_type']);
		$this->db->bind(':MONTHLY_TEST_FLAG', $data['monthly_test_flag']);
		$this->db->bind(':TASK', $data['task']);
		$this->db->bind(':RULES', $data['rules']);
		$this->db->bind(':OUTCOMES', $data['outcomes']);
		$this->db->bind(':NON_COMPLIANT', $data['non_compliant']);
		$this->db->bind(':OBS_SPEED', $data['obs_speed']);
		$this->db->bind(':POSTED_SPEED', $data['posted_speed']);
		$this->db->bind(':OBS_SPEED_SRC', $data['obs_speed_src']);
		$this->db->bind(':OBSERVATION_DATE', $data['observation_date']);
		$this->db->bind(':COMMENTS', $data['comments']);
		$this->db->bind(':CREATED_BY', $data['created_by']);
		$this->db->bind(':CREATION_DATE', '');
		$this->db->bind(':TRACK_DESIGNATION_ID', $data['track_designation_id']);
		$this->db->bind(':ENGINE_NUM', $data['engine_num']);
		/*echo "<pre>";
		print_r($data);
		echo "<pre>";
		exit();*/

		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}
}