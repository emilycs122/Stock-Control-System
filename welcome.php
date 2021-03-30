<?php
   include('session.php');
   include('style.php');
   
   if($user_position == "Admin"){
		include('headerAdmin.php');
	}else{
		include('headerStaff.php');
	}
?>

<!DOCTYPE html>

<html>
   
   <head>
		<title>Home </title>
	  
   </head>
   
   <body>
       <h1 style="padding-left:30%; padding-top:20%">Ready to use.</h1>
   </body>
   
   
</html>