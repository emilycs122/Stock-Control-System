<?php

	require_once("config.php");

		$view_sql = "SELECT * FROM stock ORDER BY itemName ASC";
		$res = mysqli_query($db, $view_sql);
		
		$result = array();
		
		while ($row = mysqli_fetch_assoc($res)) {
			
			array_push($result, array('itemName'=>$row["itemName"],
				'samount'=>$row["stockAmount"],
				'user'=>$row['updatedBy']
			));
				
		}
			
		echo json_decode(array("result"=>$result));
		
		mysqli_close($db);

?>