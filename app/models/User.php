<?php

class User {

	private $db;

	public function __construct() {
		$this->db = new Database;
	
  
	}

	/*public function register($data) {
		$this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');

		$this->db->bind(':name', $data['name']);
		$this->db->bind(':email', $data['email']);
		$this->db->bind(':password', $data['password']);

		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function login($email, $password) {
		$this->db->query('SELECT * FROM users WHERE email = :email');
		$this->db->bind(':email', $email);

		$row = $this->db->singleArray();

		$hashed_password = $row->password;

		if(password_verify($password, $hashed_password)) {
			return $row;
		} else {
			return false;
		}
	}

	public function login($email, $password) {
		$this->db->query('SELECT * FROM users WHERE email = :email');
		$this->db->bind(':email', $email);

		$row = $this->db->singleArray();
		return $row;
	}

	public function findUserByEmail($email) {
		$this->db->query('SELECT * FROM users WHERE email = :email');
		$this->db->bind(':email', $email);

		$row = $this->db->singleArray();

		//check row
		if($this->db->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getUserById($id) {
		$this->db->query('SELECT * FROM users WHERE id = :id');
		$this->db->bind(':id', $id);
		$row = $this->db->singleArray();
		return $row;
	}*/



	/***
		1) Retrive All users : Get_User_Plans_Sysad
		2) Filter All users exept it admin : Get_User_plans_Sysad_FILTER
		3) Retrives all users exept it admin : Get_User_Plans
		4) Filter All users exept it admin : Get_User_plans_FILTER
	***/
	

	// getUsers used to retrive all users so we will use Get_User_Plans_Sysad
	public function getUsers($id=''){
		$query = 'BEGIN ECR2_PKG.Get_User_Plans_Sysad(:BSC_EMPLID, :BUSINESS_UNIT_ID, :STATUS, :START, :END, :USERS); END;';

		$row = $this->db->refcurExecFetchAll(
												$query, 
												"Get Users List",
												"USERS", 
												array(
													[":BSC_EMPLID", $id, 0],
													[":BUSINESS_UNIT_ID", $id, 0],
													[":STATUS", '', 0],
													[":START", 0, 0],
													[":END", 100000, 0]
												)
											);
		return $row;
	}
	// nonITusers used to retrive all users except it admin so we will use Get_User_Plans procedure
	public function nonITusers($id=''){
		$query = 'BEGIN ECR2_PKG.Get_User_Plans(:BSC_EMPLID, :BUSINESS_UNIT_ID, :STATUS, :START, :END, :USERS); END;';

		
		$row = $this->db->refcurExecFetchAll(
												$query, 
												"Get Users List",
												"USERS", 
												array(
													[":BSC_EMPLID", $id, 0],
													[":BUSINESS_UNIT_ID", $id, 0],
													[":STATUS", '', 0],
													[":START", 0, 0],
													[":END", 100000, 0],
												)
											);
		return $row;
	}
	public function searchUsers($data, $id=''){
		/*$id = 2;
		*/
		$query = 'BEGIN ECR2_PKG.Get_User_plans_FILTER(:BSC_EMPLID, :BUSINESS_UNIT_ID, :FIRST_NAME, :LAST_NAME, :MGT_CENTER, :JOB_CODE, :STATUS, :START, :END, :USERS); END;';

		$row = $this->db->refcurExecFetchAll(
												$query, 
												"Get Users List",
												"USERS", 
												array(
													[":BSC_EMPLID", $data['f_bscid'], 0],
													[":BUSINESS_UNIT_ID", $id, 0],
													[":FIRST_NAME",$data['f_first_name'], 0],
													[":LAST_NAME",$data['f_last_name'], 0],
													[":MGT_CENTER",$data['f_mgmt_ctr_id'], 0],
													[":JOB_CODE",$data['f_job_code'], 0],
													[":STATUS", $data['f_status'], 0],
													[":START", 0, 0],
													[":END", 100000, 0],
												)
											);
		return $row;
	}



	//Show Users data in in USER ADMINISTRATOR
	public function getUsers_BACKUP($inputs = null) {
		$page = isset($inputs['page']) ? $inputs['page'] : 1;
		$per_page = isset($inputs['per_page']) ? $inputs['per_page'] : 3;
		$table = 'MDS_INFO';
	    $orderBy = isset($inputs['orderBy']) ? $inputs['orderBy'] : $table.'.BSC_EMPLID';
	    $orderType = isset($inputs['orderType']) ? $inputs['orderType'] : 'DESC';
	    $start  = isset($inputs['start']) ? $inputs['start'] : 1;
	    $length = isset($inputs['length']) ? $inputs['length'] : 5;
	    $columns  = isset($inputs['columns']) ? $inputs['columns'] : null;
	    $search  = isset($inputs['search']) ? $inputs['search'] : null;
	    $searchValue = '%'.$search['value'].'%';
	    $where = null;
		$query = 'SELECT *
				FROM MDS_INFO
				INNER JOIN USER_PLANS
				ON USER_PLANS.BSC_EMPLID = MDS_INFO.BSC_EMPLID
				INNER JOIN DEPARTMENTS
				ON USER_PLANS.DEPT_ID = DEPARTMENTS.DEPARTMENT_ID
				INNER JOIN BUSINESS_UNIT
				ON BUSINESS_UNIT.BUSINESS_UNIT_ID = USER_PLANS.BUSINESS_UNIT_ID
				';
	    if (!empty($search['value'])) {
	        $where[] = " MDS_INFO.BSC_EMPLID LIKE :SEARCH_VALUE ";
	        $where[] = " MDS_INFO.FIRST_NAME LIKE :SEARCH_VALUE ";
	        $where[] = " USER_PLANS.BUSINESS_UNIT_ID LIKE :SEARCH_VALUE ";
	        $where[] = " USER_PLANS.DEPT_ID LIKE :SEARCH_VALUE ";
	        $where[] = " MDS_INFO.JOBCODE LIKE :SEARCH_VALUE ";
	        $where[] = " MDS_INFO.JOBCODE_DESCR LIKE :SEARCH_VALUE ";
	        $where[] = " MDS_INFO.POSITION_NBR LIKE :SEARCH_VALUE ";
	        $where[] = " MDS_INFO.POSNUM_DESCR LIKE :SEARCH_VALUE ";
	        //$where[] = " MDS_INFO.POSITION_ROLE LIKE :SEARCH_VALUE ";
	        //$where[] = " MDS_INFO.STATUS LIKE :SEARCH_VALUE ";
	       $query .= " WHERE ".implode(" OR " , $where);
	    }
	    
	    // #TODO check orderBy column table 
	    $query .= ' ORDER BY MDS_INFO.'.$orderBy.' '.$orderType;
	    $count_query = $query;
	    $query .= ' OFFSET '.$start.' ROWS FETCH NEXT '.$length.' ROWS ONLY';
		
	/*	echo $query;
		exit();*/
		$this->db->query($query);
		$this->db->bind(':SEARCH_VALUE', $searchValue);
		$row['rows'] = $this->db->resultArraySet();

		$this->db->query($count_query); // TODO select only bscid 
		$this->db->bind(':SEARCH_VALUE', $searchValue);
		$toal_rows = $this->db->resultArraySet();
		$row['total_rows'] = count($toal_rows);

		return $row;
	} 

	public function getUserByBSID($id) {
		$this->db->query('SELECT MDS_INFO.*, DEPARTMENTS.*, BUSINESS_UNIT.*, USER_PLANS.*, MDS_INFO.BSC_EMPLID as BSC_EMPLID
						FROM MDS_INFO 
						LEFT JOIN USER_PLANS
						ON MDS_INFO.BSC_EMPLID = USER_PLANS.BSC_EMPLID 
						LEFT JOIN DEPARTMENTS
						ON DEPARTMENTS.DEPARTMENT_ID = USER_PLANS.DEPT_ID
						LEFT JOIN BUSINESS_UNIT
						ON BUSINESS_UNIT.BUSINESS_UNIT_ID = USER_PLANS.BUSINESS_UNIT_ID
						WHERE MDS_INFO.BSC_EMPLID = :BSC_EMPLID
						');
		$this->db->bind(':BSC_EMPLID', $id);

		$row = $this->db->singleArray();
		//print_r($row);
		return $row;
	} 
	public function findUserByBSID($id) {
		$this->db->query('SELECT BSC_EMPLID FROM MDS_INFO WHERE BSC_EMPLID = :BSC_EMPLID');
		$this->db->bind(':BSC_EMPLID', $id);

		$row = $this->db->singleArray();
		$row_array =  (array) $row;
		//print_r($row_array);
		//check row
		if(is_array($row_array) && count($row_array) > 0 && isset($row_array['BSC_EMPLID'])) 
		{
			return true;
		} else {
			return false;
		}
	}

	//User Admin Filter 
	public function getUserByFilter($id, $value) {
		
		switch ($value) {
			case '0':
			$fieldName = 'BSC_EMPLID';   
				break;
			case '1':
				$fieldName = 'FIRST_NAME';
				break;
			case  '2':
			   $fieldName = 'LAST_NAME';
			   break;
			case  '3':
			   $fieldName = 'JOBCODE';
               break;
            case  '4':
			   $fieldName = 'DEPTID';
               break;

			
		}
		$this->db->query("SELECT * FROM MDS_INFO WHERE UPPER($fieldName) LIKE UPPER(:BSC_EMPLID) AND WORK_FOR_AGENCY IN ('LIRRD' ,'MNCRR') ORDER BY BSC_EMPLID DESC FETCH FIRST 100 ROWS ONLY ");
		$searchText = $id. '%';
		$this->db->bind(':BSC_EMPLID', $searchText);
		//$this->db->execute();
		//while ($row = $this->db->fetch()){
			//print_r($row);exit();

		//}
		return $this->db->resultArraySet();
	}

	/*public function getEHOSTDATA() {
		$this->db->query('SELECT *			             
		                  FROM MDS_INFO
		                  ');

		$results = $this->db->resultArraySet();
		
		return $results;
	}*/
	public function getUserRoles($uid = null){
		if ($uid != null and $uid > 0) {
			$this->db->query('
					SELECT * FROM USER_PLAN_ROLES
					INNER JOIN ROLES
					ON ROLES.ROLE_ID = USER_PLAN_ROLES.ROLE_ID
					WHERE USER_PLAN_ROLES.BSC_EMPLID = :BSC_EMPLID
				');
			$this->db->bind(':BSC_EMPLID', $uid);
			return $this->db->resultArraySet();
		}
		return null;                    //LIRRD , MNCRR
	}
	public function getRoles(){
			if(isUserRole('IT Administrator')){
				$query = 'SELECT ROLE_ID, ROLE_CODE, MUTUALLY_EXCLUSIVE FROM ROLES';
    			$this->db->query($query);
    		}else if(isUserRole('User Administrator') && (isUserPlan('1') || isUserPlan('3'))){ // user admin with otp
    			$roles = [7, 8, 1];
    			$in  = str_repeat('?,', count($roles) - 1) . '?';
				$rows = $this->db->executeQuery('SELECT ROLE_ID, ROLE_CODE, MUTUALLY_EXCLUSIVE FROM ROLES WHERE ROLE_ID NOT IN('.$in.')', $roles);
    		}else if(isUserRole('User Administrator') && (isUserPlan('2') || isUserPlan('4'))){ //  user admin with training
    			$roles = [5, 1];
    			$in  = str_repeat('?,', count($roles) - 1) . '?';
				$rows = $this->db->executeQuery('SELECT ROLE_ID, ROLE_CODE, MUTUALLY_EXCLUSIVE FROM ROLES WHERE ROLE_ID NOT IN('.$in.')', $roles);
    		}else{ // get all roles if fails all above conditions
    			$query = 'SELECT ROLE_ID, ROLE_CODE, MUTUALLY_EXCLUSIVE FROM ROLES WHERE ROLE_CODE != :ROLE_CODE ';
				$this->db->query($query);
				$this->db->bind(':ROLE_CODE', 'IT Administrator');
    		}
			
			return $this->db->resultArraySet();
	}

	public function getMultipleRoles($roles) {
		$in  = str_repeat('?,', count($roles) - 1) . '?';
		$rows = $this->db->executeQuery('SELECT ROLE_ID, ROLE_CODE, MUTUALLY_EXCLUSIVE FROM ROLES WHERE ROLE_ID IN('.$in.')', $roles);
		return $rows;
	}
	
	/*public function getPermission($id) {
		$this->db->query('SELECT * FROM groups WHERE id = :id');
		$this->db->bind(':id', $id);
		$row = $this->db->singleArray();

		return $row;
	}
	*/

	public function create_TO($data) {
		$this->db->query('INSERT INTO posts (title, user_id, body) VALUES (:title, :user_id, :body)');

		$this->db->bind(':title', $data['title']);
		$this->db->bind(':user_id', $data['user_id']);
		$this->db->bind(':body', $data['body']);

		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}
	public function update_TO($data){
		$this->db->query('UPDATE MDS_INFO SET FIRST_NAME = :FIRST_NAME, LAST_NAME = :LAST_NAME WHERE BSC_EMPLID = :BSC_EMPLID');

		$this->db->bind(':BSC_EMPLID', $data['bscid']);
		$this->db->bind(':FIRST_NAME', $data['first_name']);
		$this->db->bind(':LAST_NAME', $data['last_name']);

		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function update_TO_User_Plans($data){
		$date = '';
		if ($data['end_date'] != null) {
			$date = date('Y/m/d', strtotime($data['end_date']));
			$this->db->query("UPDATE USER_PLANS SET STATUS_VALIDITY = :STATUS_VALIDITY, STATUS = :STATUS, END_DATE = TO_DATE(:END_DATE, 'yyyy/mm/dd HH24:MI:SS') WHERE BSC_EMPLID = :BSC_EMPLID");
		}else{
			$this->db->query("UPDATE USER_PLANS SET STATUS_VALIDITY = :STATUS_VALIDITY, STATUS = :STATUS WHERE BSC_EMPLID = :BSC_EMPLID");
		}
		
		
		//$date = date('Y/m/d');

		$this->db->bind(':BSC_EMPLID', $data['bscid']);
		$this->db->bind(':STATUS_VALIDITY', $data['status_validity']);
		$this->db->bind(':STATUS', $data['status']);
		$this->db->bind(':END_DATE', $date);

		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function delete_user_roles($id) {
		$this->db->query('DELETE FROM USER_PLAN_ROLES WHERE BSC_EMPLID = :BSC_EMPLID');

		$this->db->bind(':BSC_EMPLID', $id);

		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}
	public function add_user_roles($data) {
		$this->db->query("INSERT INTO USER_PLAN_ROLES (PLAN_ROLE_ID, BSC_EMPLID, ROLE_ID, ROLE_CODE, CREATED_BY, CREATION_DATE) VALUES (:PLAN_ROLE_ID, :BSC_EMPLID, :ROLE_ID, :ROLE_CODE, :CREATED_BY, TO_DATE(:CREATION_DATE, 'yyyy/mm/dd HH24:MI:SS'))");
		$date = date('Y/m/d');
		
		$this->db->bind(':PLAN_ROLE_ID', $data['plan_role_id']);
		$this->db->bind(':BSC_EMPLID', $data['bscid']);
		$this->db->bind(':ROLE_ID', $data['role_id']);
		$this->db->bind(':ROLE_CODE', $data['role_code']);
		$this->db->bind(':CREATED_BY', $data['user_id']);
		$this->db->bind(':CREATION_DATE', $date);

		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function getAllStatusValues(){
		
			$this->db->query('
					SELECT * FROM STATUS
				');
			
			return $this->db->resultArraySet();
		
	}

	public function getStatusByValue($value='Inactive'){
		
			$this->db->query('
					SELECT * FROM STATUS WHERE DESCRIPTION = :DESCRIPTION
				');
			$this->db->bind(':DESCRIPTION', $value);
			return $this->db->resultArraySet();
		
	}

}