<?php
	include 'session.php';
	include('headerAdmin.php');
	include('style.php');
	
	$item = $_GET['itemName'];
	$dlt_sql = "DELETE FROM stock WHERE itemName='$item'";
	
	$result = mysqli_query($db,$dlt_sql);
		
	if($result) {
		echo "<script type='text/javascript'>alert('Success deleted!! ');</script>";
		header("location: deleteInventory.php");
	}else {
		echo "<script type='text/javascript'>alert('ERROR!! ');</script>";
	}
?>