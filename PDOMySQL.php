<?php
class PDOMySQL{
	const USERNAME="pi";
	const PASSWORD="ese";
	const HOST="127.0.0.1";
	const DB="eprojese2018db";

	private function getConnection(){
		$username = self::USERNAME;
		$password = self::PASSWORD;
		$host = self::HOST;
		$db = self::DB;
		$connection = new PDO("mysql:dbname=$db;host=$host", $username, $password);
		return $connection;
	}
	public function queryList($sql){
		$connection = $this->getConnection();
		$stmt = $connection->query($sql);
		return $stmt;
	}
	public function insertUser(
		$username,
		$password,
		$first_name,
		$last_name,
		$email,
		$website,
		$birth_date,
		$user_type,
		$interest)
	{
		$db = $this->getConnection();

		$stmt = $db->prepare(
			'INSERT INTO users (username,password)
			VALUES (:username,:password)'
		);
		$params = [
				'username' => $username,
				'password' => $password
		];
		$stmt->execute($params);
		$userid_query = $db->query("SELECT userid FROM users WHERE username='$username'");
		$userid = $userid_query->fetch(PDO::FETCH_ASSOC);
		$stmt = $db->prepare(
			'INSERT INTO users_info (
				userid,
				first_name,
				last_name,
				email,
				date_created,
				time_created,
				website,
				birth_date,
				user_type,
				interest
			)
			VALUES (
				:userid,
				:first_name,
				:last_name,
				:email,
				:date_created,
				:time_created,
				:website,
				:birth_date,
				:user_type,
				:interest
			)'
		);
		$curr_date_query = $db->query('SELECT CURRENT_DATE()');
		$curr_date = $curr_date_query->fetch(PDO::FETCH_ASSOC);
		$curr_time_query = $db->query('SELECT CURRENT_TIME()');
		$curr_time = $curr_time_query->fetch(PDO::FETCH_ASSOC);

		$params = [
			'userid' => $userid['userid'],
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email' => $email,
			'date_created' => $curr_date['CURRENT_DATE()'],
			'time_created' => $curr_time['CURRENT_TIME()'],
			'website' => $website,
			'birth_date' => $birth_date,
			'user_type' => $user_type,
			'interest' => $interest
		];

		$stmt->execute($params);
		return $stmt;
	}
	public function requestFloor($floornum)
	{
		$db = $this->getConnection();

		$curr_date_query = $db->query('SELECT CURRENT_DATE()');
		$curr_date = $curr_date_query->fetch(PDO::FETCH_ASSOC);
		$curr_time_query = $db->query('SELECT CURRENT_TIME()');
		$curr_time = $curr_time_query->fetch(PDO::FETCH_ASSOC);

		$stmt = $db->prepare(
			'INSERT INTO elv_req_log (nodeID,date,time,status,currentFloor,requestedFloor)
			VALUES (:nodeID,:date,:time,:status,:currentFloor,:requestedFloor)'
		);
		$params = [
			'nodeID' => 0x200,
			'date' => $curr_date,
			'time' => $curr_time,
			'status' => 0,
			'currentFloor' => 0,
			'requestedFloor' => $floornum
		];
		$stmt->execute($params);
		$reqId_query = $db->query("SELECT reqId FROM elv_req_log ORDER BY reqId DESC LIMIT 1");
		$reqId = $reqId_query->fetch(PDO::FETCH_ASSOC);
		$stmt = $db->prepare(
			'INSERT INTO elv_req_que (reqId)
			VALUES (:reqId)'
		);

		$params = [
			'reqId' => $reqId['reqId']
		];

		$stmt->execute($params);
		return $stmt;
	}
}
?>
