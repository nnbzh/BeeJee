<?php 

namespace application\controllers;
use application\core\Controller;
use application\lib\Pagination;

class MainController extends Controller{

	public $tasks = 0;
	public $sort_flag;
	public $sort_type;

	public function __construct($route) {
		parent::__construct($route);
	}
	
	public function indexAction() {
		$pagination = new Pagination($this->route, $this->model->postsCount());
		if (isset($_POST['sortby']) && isset($_POST['type'])) {
			setcookie('flag', $_POST['sortby']);
			setcookie('type', $_POST['type']);
		echo $_COOKIE['flag'];
		echo $_COOKIE['type'];
		}
		$tasks = $this->model->getTasks($this->route, $_COOKIE['flag'], $_COOKIE['type']);
		$vars = [
			'pagination' => $pagination->get(),
			'tasks'=> $tasks,
		];
		$this->view->render('Main Page', $vars);
	}

	public function addAction() {
		if (!empty($_POST['description'])) {
		$this->model->addTask($_POST);
		$this->view->redirect('');
		}
	}

	public function changeAction() {
		$vars = [
			'id' => $_POST['task_id'],
			'onChange'=>$_POST['changed'],
		];

		if (isset($_POST['checked'])) {
			$this->model->changeCheckStatus($vars['id']);
		}

		if ($this->model->onTextChange($vars)) {
			$this->model->changeChangeStatus($vars['id']);
		}
		$this->view->redirect('');
	}
	// public function sortAction() {
	// 	$params = [
	// 		'sort_flag' => $_POST['sortby'],
	// 		'sort_type' => $_POST['type'], 
	// 	]; 
	// 	$this->sort_flag = $params['sort_flag'];
	// 	$this->sort_type = $params['sort_type'];
	// 	$this->view->redirect('');	
	// }
	
}