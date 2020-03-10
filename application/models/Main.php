<?php 

namespace application\models;
use application\core\Model;

class Main extends Model
{

	public function getTasks($route, $sort_flag, $sort_type) {
		$max = 3;
		$start = (($route['page'] ?? 1) - 1) * $max;
		$result = $this->db->row('SELECT users.login, users.email, task_descr, task_id, task_if_done, task_if_changed FROM tasks INNER JOIN users ON tasks.task_creator_id = users.id');
		if ($sort_flag == 'email') {
			if ($sort_type == 'asc') {
				usort($result, array($this, "ascEmailcmp"));
			} else if ($sort_type == 'desc') {
				usort($result, array($this, "descEmailcmp"));
			}
		}
		if ($sort_flag == 'login') {
			if ($sort_type == 'asc') {
				usort($result, array($this, "ascLogincmp"));
			} else if ($sort_type == 'desc') {
				usort($result, array($this, "descLogincmp"));
			}
		}
		if ($sort_flag == 'status') {
			if ($sort_type == 'asc') {
				usort($result, array($this, "ascStatuscmp"));
			} else if ($sort_type == 'desc') {
				usort($result, array($this, "ascStatuscmp"));
			}
		}

		$new_result = array_slice($result, $start, $max);
		return $new_result;
	}

	public function descStatuscmp($a, $b)
	{
		return strcmp($b["task_if_done"], $a["task_if_done"]);
	}

	public function ascStatuscmp($a, $b)
	{
		return strcmp($a["task_if_done"], $b["task_if_done"]);
	}
	public function descEmailcmp($a, $b)
	{
		return strcmp($b["email"], $a["email"]);
	}

	public function ascEmailcmp($a, $b)
	{
		return strcmp($a["email"], $b["email"]);
	}
	public function descLogincmp($a, $b)
	{
		return strcmp($b["login"], $a["login"]);
	}

	public function ascLogincmp($a, $b)
	{
		return strcmp($a["login"], $b["login"]);
	}

	public function postsCount() {
		return $this->db->column('SELECT COUNT(task_id) FROM tasks');
	}

	public function addTask($post) {
		if (!isset($_SESSION['account'])) {
			$params = [
				'task_creator_id' => 9999,
				'task_descr' => $_POST['description'],
			];
		} else {
			$params = [
				'task_creator_id' => $_SESSION['account']['id'],
				'task_descr' => $_POST['description'],
			];
		}
		$this->db->query('INSERT INTO tasks (task_descr, task_creator_id) VALUES(:task_descr,:task_creator_id)', $params);
	}

	public function changeCheckStatus($id) {
		$params = [
			'id' => $id,
		];
		$this->db->query('UPDATE tasks SET task_if_done = 1 WHERE task_id =:id', $params);
	}
	public function changeChangeStatus($id) {
		$params = [
			'id' => $id,
		];
		$this->db->query('UPDATE tasks SET task_if_changed = 1 WHERE task_id =:id', $params);
	}

	public function onTextChange($vars) {
		$dbText = $this->db->column("SELECT task_descr FROM tasks WHERE task_id ='".$vars['id']."' ");
		if ($vars['onChange'] == $dbText) {
			return false;
		} 
		else {
			$this->db->query('UPDATE tasks SET task_descr = :onChange WHERE task_id =:id', $vars);
			return true;
		} 
	}
}