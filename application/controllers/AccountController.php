<?php 

namespace application\controllers;
use application\core\Controller;

class AccountController extends Controller{

	public function __construct($route) {
		parent::__construct($route);
	}
	
	public function loginAction() {
		$this->view->render('Log In');
		if (!empty($_POST)) {
			if (!$this->model->checkData($_POST['login'])) {
				exit('Login or password are incorrect');
			} 
			else {
				$this->model->authorize($_POST['login']);
				$this->view->redirect('');
			}
		}
	}

	public function registerAction() {
		$this->view->render('Sign Up');
		if (!empty($_POST)) {
			if ($this->model->checkIfLoginExists($_POST['login'])) {
				exit('That login is already used'); 
			} 
			elseif ($this->model->checkIfEmailExists($_POST['email'])) {
				exit ('That email is already used');
			} 
			else {
				$this->model->register($_POST);
				$this->view->redirect('account/login');
			}
		}
	}

	public function logoutAction() {
		unset($_SESSION['account']);
		$this->view->redirect('');
	}
}