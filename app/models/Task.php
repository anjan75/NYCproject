<?php

class Task {

	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function getTaskById($id='') {
		$business_unit_id = $_SESSION['user_business_unit_id'];
		$this->db->query('SELECT *
						 FROM TASKS 
						 WHERE BUSINESS_UNIT_ID = :BUSINESS_UNIT_ID
						');
		$this->db->bind(':BUSINESS_UNIT_ID', $business_unit_id);
		$rows = $this->db->resultArraySet();

		return $rows;
	}
	public function getTaskRules($task_id=''){
		$business_unit_id = $_SESSION['user_business_unit_id'];
		$this->db->query('SELECT *
						 FROM TASK_RULE 
						 INNER JOIN RULES
						 ON RULES.RULE_ID = TASK_RULE.RULE_ID
						 WHERE RULES.BUSINESS_UNIT_ID = :BUSINESS_UNIT_ID
						 AND TASK_RULE.TASK_ID = :TASK_ID
						');
		$this->db->bind(':BUSINESS_UNIT_ID', $business_unit_id);
		$this->db->bind(':TASK_ID', $task_id);
		$rows = $this->db->resultArraySet();

		return $rows;
	}

}