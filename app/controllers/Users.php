<?php

class Users extends Controller {

	public function __construct() {
		if(isLoggedIn()) {
        redirect('dashboards');
        }
		$this->userModel = $this->model('User');
	}

	public function register() {
		//check for POST
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			//process form
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				'name' => trim($_POST['name']),
				'email' => trim($_POST['email']),
				'password' => trim($_POST['password']),
				'confirm_password' => trim($_POST['confirm_password']),
				'name_err' => '',
				'email_err' => '',
				'password_err' => '',
				'confirm_password_err' => ''
			];

			//validate 
			if(empty($data['email'])) {
				$data['email_err'] = 'Please enter email';
			}else {
				if($this->userModel->findUserByEmail($data['email'])) {
					$data['email_err'] = 'Email is taken';
				}
			}

			if(empty($data['name'])) {
				$data['name_err'] = 'Please enter name';
			}

			if(empty($data['password'])) {
				$data['password_err'] = 'Please enter password';
			} elseif(strlen($data['password']) < 6) {
				$data['password_err'] = 'Password must be at least 6 characters';
			}

			if(empty($data['confirm_password'])) {
				$data['confirm_password_err'] = 'Please confirm password';
			} else {
				if($data['password'] != $data['confirm_password']) {
					$data['confirm_password_err'] = 'Password do not match';
				}
			}

			//make sure errors are empty
			if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) &&empty($data['confirm_password_err'])) {
				//hash password
				$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

				//register user
				if($this->userModel->register($data)) {
					flash('register_success', 'You are registered and can log in');
					redirect('users/login');
				} else {
					die('Something went wrong');
				}

			} else {
				//load view with errors
				$this->view('users/register', $data);
			}

		} else {
			//init data
			$data = [
				'name' => '',
				'email' => '',
				'password' => '',
				'confirm_password' => '',
				'name_err' => '',
				'email_err' => '',
				'password_err' => '',
				'confirm_password_err' => ''
			];

			//load view
			$this->view('users/register', $data);
		}
	}

	public function login() {
		//check for POST
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			//process form
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				'email' => trim($_POST['email']),
				'password' => trim($_POST['password']),
				'email_err' => '',
				'password_err' => ''
			];

			if(empty($data['email'])) {
				$data['email_err'] = 'Please enter email';
			}

			if(empty($data['password'])) {
				$data['password_err'] = 'Please enter password';
			}

			if($this->userModel->findUserByEmail($data['email'])) {
			} else {
				$data['email_err'] = 'No user found';
			}

			if(empty($data['email_err']) && empty($data['password_err'])) {
				//check and set logged in user
				$loggedInUser = $this->userModel->login($data['email'], $data['password']);

				if($loggedInUser) {
					//create session
					$permission = $this->userModel->getPermission($loggedInUser->role_group);
					
					$this->createUserSession($loggedInUser, $permission);
				} else {
					$data['password_err'] = 'Password incorrect';

					$this->view('users/login', $data);
				}

			} else {
				//load view with errors
				$this->view('users/login', $data);
			}

		} else {
			//init data
			$data = [
				'email' => '',
				'password' => '',
				'email_err' => '',
				'password_err' => ''
			];

			//load view
			$this->view('users/login', $data);
		}
	}

	public function createUserSession($user, $permission) {
		$_SESSION['user_id'] = $user->id;
		$_SESSION['user_email'] = $user->email;
		$_SESSION['user_name'] = $user->name;
		$_SESSION['user_role'] = $user->role_group;
		$_SESSION['permission'] = $permission->permissions;

		//redirect('posts');
		redirect('dashboards/index');
	}

	public function logout() {
		unset($_SESSION['user_id']);
		unset($_SESSION['user_email']);
		unset($_SESSION['user_name']);
		session_destroy();

		redirect('users/login');
	} 
}