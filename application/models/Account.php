<?php 

namespace application\models;
use application\core\Model;

class Account extends Model
{
	public function register($post) {
		$params = [
			'id'=>'',
			'login'=>$_POST['login'],
			'email'=>$_POST['email'],
			'password'=>$_POST['password'],
			'status'=>'user',
		];

		$this->db->query('INSERT INTO users VALUES(:id, :login, :email, :password, :status)',$params);
	}

	public function authorize($login) {
		$params = [
			'login' => $_POST['login'],
		];
		$data = $this->db->row('SELECT * FROM users WHERE login = :login', $params);
		$_SESSION['account'] = $data[0];	
	}

	public function checkData($login) {
		$login = $this->db->column("SELECT login FROM users WHERE login ='".$login."'");
		$password = $this->db->column("SELECT password FROM users WHERE login ='".$login."'");

		if ($_POST['login'] == $login && $_POST['password'] == $password) {
			return true;
		} else return false;
	}

	public function checkIfLoginExists($login) {
		$login = $this->db->column("SELECT login FROM users WHERE login ='".$login."'");
		if (!empty($login)) {
			return true;
		} else {
			return false;
		}
	}

	public function checkIfEmailExists($email) {
		$email = $this->db->column("SELECT email FROM users WHERE email ='".$email."'");
		if (!empty($email)) {
			return true;
		} else {
			return false;
		}
	}

}