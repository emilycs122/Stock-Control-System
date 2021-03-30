<?php

	require_once("config.php");

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$username = mysqli_real_escape_string($db,$_POST['username']);
		$password = mysqli_real_escape_string($db,$_POST['password']);
		
		$pwd = md5($password);

		$user_sql = "SELECT * FROM user WHERE username = '$username'";
		$result = mysqli_query($db, $user_sql);	

		$r = array();
		$r['login'] = array();
		
		if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_array($result);
			if($pwd == $row['password']){
				$index['name'] = $row['userName'];
				array_push($r['login'], $index);
				
				$r['success'] = '1';
				$r['message'] = 'success';
				echo json_encode($r);
				
				mysqli_close($db);
			}else{
				$r['success'] = '2';
				$r['message'] = 'Password is wrong! Please try again.';
				echo json_encode($r);
				
				mysqli_close($db);
			}
		}else{
			$r['success'] = '0';
			$r['message'] = 'Username does not exist! Please try again.';
			echo json_encode($r);
				
			mysqli_close($db);
		}
	}
	
	

?>