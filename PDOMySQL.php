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
		$nodeID = 0x200;
		$status = 0;
		$db = $this->getConnection();

		$curr_date_query = $db->query('SELECT CURRENT_DATE()');
		$curr_date = $curr_date_query->fetch(PDO::FETCH_ASSOC);
		$curr_time_query = $db->query('SELECT CURRENT_TIME()');
		$curr_time = $curr_time_query->fetch(PDO::FETCH_ASSOC);
		$currentFloor_query = $db->query("SELECT currentFloor FROM elevator WHERE nodeID = 512");
		$currentFloor = $currentFloor_query->fetch(PDO::FETCH_ASSOC);

		$stmt = $db->prepare(
			'INSERT INTO elv_req_log(nodeID,date,time,status,currentFloor,requestedFloor)
			VALUES (:nodeID,:date,:time,:status,:currentFloor,:requestedFloor)'
		);
		$params = [
			'nodeID' => $nodeID,
			'date' => $curr_date['CURRENT_DATE()'],
			'time' => $curr_time['CURRENT_TIME()'],
			'status' => $status,
			'currentFloor' => $currentFloor['currentFloor'],
			'requestedFloor' => $floornum
		];
		$stmt->execute($params);
		$reqId_query = $db->query("SELECT reqId FROM elv_req_log ORDER BY reqId DESC LIMIT 1");
		$reqId = $reqId_query->fetch(PDO::FETCH_ASSOC);
		$stmt = $db->prepare(
			'INSERT INTO elv_req_que(reqId)
			VALUES (:reqId)'
		);

		$params = [
			'reqId' => $reqId['reqId']
		];

		$stmt->execute($params);
		return $stmt;
	}
	public function getLatestReqs($numqueries)
	{
		$db = $this->getConnection();
		$recentreq_query = $db->query("SELECT * FROM elv_req_log ORDER BY reqId DESC LIMIT 10");


		$i = 0;
		$rtn = "";
		while ($latestReq = $recentreq_query->fetch(PDO::FETCH_ASSOC)) {
			$rtn .= "<tr>";
			$rtn .=  "<td>". $latestReq['reqId'] ."</td>";
			$rtn .=  "<td>". $latestReq['nodeID'] ."</td>";
			$rtn .=  "<td>". $latestReq['date'] ."</td>";
			$rtn .=  "<td>". $latestReq['time'] ."</td>";
			$rtn .=  "<td>". $latestReq['status'] ."</td>";
			$rtn .=  "<td>". $latestReq['currentFloor'] ."</td>";
			$rtn .=  "<td>". $latestReq['requestedFloor'] ."</td>";
			$rtn .=  "<td>". $latestReq['source'] ."</td>";
			$rtn .=  "</tr>";

		}

		return $rtn;
	}
	public function getQue($numqueries)
	{
		$db = $this->getConnection();
		$que_query = $db->query("SELECT * FROM elv_req_que LIMIT 10");


		$i = 0;
		$rtn = "";
		while ($latestReq = $que_query->fetch(PDO::FETCH_ASSOC)) {
			$rtn .= "<tr>";
			$rtn .=  "<td>". $latestReq['reqId'] ."</td>";
			$rtn .=  "</tr>";

		}

		return $rtn;
	}
	public function getCurrentFloor()
	{
		$db = $this->getConnection();
		$crrfloor_query = $db->query("SELECT currentFloor FROM elevator WHERE nodeID = 512");
		$currfloor = $crrfloor_query->fetch(PDO::FETCH_ASSOC);
		$rtn = $currfloor['currentFloor'];
		return $rtn;
	}
}
?>
