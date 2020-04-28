<?php

session_start();

function flash($name = '', $message = '', $class = 'alert alert-success') {
	if(!empty($name)) {
		if(!empty($message) && empty($_SESSION[$name])) {
			if(!empty($_SESSION[$name])) {
				unset($_SESSION[$name]);
			}

			if(!empty($_SESSION[$name. '_class'])) {
				unset($_SESSION[$name. '_class']);
			}

			$_SESSION[$name] = $message;
			$_SESSION[$name. '_class'] = $class;
		} elseif(empty($message) && !empty($_SESSION[$name])) {
			$class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : '';
			echo '<div class="'.$class.'" id="msg-flash">'.$_SESSION[$name].'</div>';
			unset($_SESSION[$name]);
			unset($_SESSION[$name. '_class']);
		}
	}
}

function isLoggedIn() {
	if(isset($_SESSION['user_id'])) {
			return true;
	} else {
			return false;
	}
}

/*function hasPermission($key) {
	return true;
	if(isset($_SESSION['permission'])){
		$permissions = json_decode($_SESSION['permission'], true);
	    if($permissions[$key] == true) {
		    //var_dump('pass');
		    return true;
	    }
	    return false;
    }
}*/

function hasPermissionTest($key) {
	$permissions = json_decode($_SESSION['permission'], true);
	    if($permissions[$key] == true) {
		    //var_dump('pass');
		    return true;
	    }
	     return false;
}
///is_user_plan Training Reports
function isUserPlan($user_plan=''){
	if (!empty($user_plan)) {
		
		if(isset($_SESSION['user_plan_id'])){

				if ($_SESSION['user_plan_id'] == $user_plan) {
					return true;
				}
		}
	}
	return false;
}

///is_user_role admin/view reports
function isUserRole($role_code=''){
	if (!empty($role_code)) {
		if(isset($_SESSION['user_roles'])){
			foreach ($_SESSION['user_roles'] as $role) {
				if ($role['ROLE_CODE'] === $role_code) {
					return true;
				}
			}
		}
	}
	return false;
}



function hasPermission($roles=array(), $business_unit=null) {
	if(isset($_SESSION['user_roles'])){
		$s_roles = $_SESSION['user_roles'];
		if (is_array($roles) && count($roles) > 0) {
		    foreach ($roles as $role) {
		    	foreach ($s_roles as $s_role) {
		    		if ($role === $s_role['ROLE_CODE']) {
		    			
		    			if ($business_unit === null) {
								return true;
						}elseif(trim($business_unit) == trim($_SESSION['user_business_unit'])){
							return true;
						}
		    		}
		    	}
		    }
		}
    }
    return false;
}
