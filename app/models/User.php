<?php

class User {

	private $db;

	public function __construct() {
		$this->db = new Database;
	
  
	}

	public function register($data) {
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

	/*public function login($email, $password) {
		$this->db->query('SELECT * FROM users WHERE email = :email');
		$this->db->bind(':email', $email);

		$row = $this->db->singleArray();

		$hashed_password = $row->password;

		if(password_verify($password, $hashed_password)) {
			return $row;
		} else {
			return false;
		}
	}*/

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
	} 
	//Show Users data in in USER ADMINISTRATOR
	public function getUsers($inputs = null) {
		$page = isset($inputs['page']) ? $inputs['page'] : 1;
		$per_page = isset($inputs['per_page']) ? $inputs['per_page'] : 3;
		$table = 'EHOST_INFO';
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
		$this->db->query('SELECT EHOST_INFO.*, DEPARTMENTS.*, BUSINESS_UNIT.*, USER_PLANS.*, EHOST_INFO.BSC_EMPLID as BSC_EMPLID
						FROM EHOST_INFO 
						LEFT JOIN USER_PLANS
						ON EHOST_INFO.BSC_EMPLID = USER_PLANS.BSC_EMPLID 
						LEFT JOIN DEPARTMENTS
						ON DEPARTMENTS.DEPARTMENT_ID = USER_PLANS.DEPT_ID
						LEFT JOIN BUSINESS_UNIT
						ON BUSINESS_UNIT.BUSINESS_UNIT_ID = USER_PLANS.BUSINESS_UNIT_ID
						WHERE EHOST_INFO.BSC_EMPLID = :BSC_EMPLID
						');
		$this->db->bind(':BSC_EMPLID', $id);

		$row = $this->db->singleArray();
		//print_r($row);
		return $row;
	} 
	public function findUserByBSID($id) {
		$this->db->query('SELECT BSC_EMPLID FROM EHOST_INFO WHERE BSC_EMPLID = :BSC_EMPLID');
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

	public function getEHOSTDATA() {
		$this->db->query('SELECT *			             
		                  FROM EHOST_INFO
		                  ');

		$results = $this->db->resultArraySet();
		
		return $results;
	}
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
		return null;
	}
	public function getRoles(){
			$this->db->query('
					SELECT ROLE_ID, ROLE_CODE, MUTUALLY_EXCLUSIVE FROM ROLES
				');
			return $this->db->resultArraySet();
	}

	public function getMultipleRoles($roles) {
		$in  = str_repeat('?,', count($roles) - 1) . '?';
		$rows = $this->db->executeQuery('SELECT ROLE_ID, ROLE_CODE, MUTUALLY_EXCLUSIVE FROM ROLES WHERE ROLE_ID IN('.$in.')', $roles);
		return $rows;
	}
	
	public function getPermission($id) {
		$this->db->query('SELECT * FROM groups WHERE id = :id');
		$this->db->bind(':id', $id);
		$row = $this->db->singleArray();

		return $row;
	}
	

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

		$this->db->query('UPDATE EHOST_INFO SET FIRST_NAME = :FIRST_NAME, LAST_NAME = :LAST_NAME WHERE BSC_EMPLID = :BSC_EMPLID');

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
		$this->db->query('UPDATE USER_PLANS SET STATUS_VALIDITY = :STATUS_VALIDITY, STATUS = :STATUS WHERE BSC_EMPLID = :BSC_EMPLID');

		$this->db->bind(':BSC_EMPLID', $data['bscid']);
		$this->db->bind(':STATUS_VALIDITY', $data['status_validity']);
		$this->db->bind(':STATUS', $data['status']);

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


}