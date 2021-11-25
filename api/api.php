<?php 

require_once './system/db.config.php';
require_once './system/system.config.php';

$data = json_decode(file_get_contents("php://input"), true);

if ($data['methods'] == 'post') {
	$login = XSS($data['login']);
	$password = XSS($data['password']);

	if ($login && $password) {
        $pass = md5(sha1(md5($password)));

		$query = $db -> query("INSERT INTO users (login, password) VALUES (?s, ?s)" , $login, $pass);

		if ($query) {
			$users = numUsers();
			header('Content-Type: application/json');
			print json_encode(["$login, $password, $pass, $users, success"]);	
		} else {
			header('HTTP/1.1 500 Internal Server Booboo');
        	header('Content-Type: application/json; charset=UTF-8');
        	die(json_encode(['code' => 500]));
		}

	}
}


?>