<html>
  <head>
	<title>Password test, page 2</title>
  <head>

  <body>
	<?php 
		 $name  = $_POST['realname'];
		 $pass  = $_POST['mypassword']; 
		 
		// Trying the database part
		
		$servername = "localhost";
		$databasename = "cpsc471Project";
		$username = "dylan";
		$password = "password";
		
		$conn = new mysqli($servername, $username, $password, $databasename);
		
		if($conn->connect_error)
		{
			die("Connection_failed: " . $conn->connect_error);
		}
		
		echo "connected Successfully";
		print "<br>";
		//Check if user exists in database:
		
		$sql = "SELECT * from end_user";
		
		$result = $conn->query($sql);
		
		$founduser = false;
		
		if($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc()){
				if($row['user_email'] == $name)
				{
					if($pass == $row['password'])
					{
						print "<br>";
						echo "Logged In successfully using database!!!";
						print "<br>";
						print "<br>";
						echo "You are user: ";
						echo $name;
						print "<br>";
						$founduser = true;
					}
				}
			}
			
			if($founduser == false)
			{
				echo "Couldn't find your account!";
			}
			else
			{
				// Check if admin or student
				
				
				$sql2 = "Select * from admin where user_email = '".$name."'";
				
				$adminResult = $conn->query($sql2);
				
				if($adminResult->num_rows >0)
				{
					// is an admin
					
					$_SESSION['adminname'] = $name;
					
					?>
					<input type="button" value="Add Course" onclick="location='admin_add_course.php'" />
					<input type="button" value="Select Course" onclick="location='admin_select_course.php'" />
					<input type="button" value="View Notifications" onclick="location='admin_notifications.php'" />
					<?php
				}
				else
				{
					// is a student 
					?>
					<input type="button" value="Select Course" onclick="location='student_select_course.php'" />
					<?php
				}
				
				
				
			}
			
		}
		else{
			echo "someone didn't make any accounts yet LOL get TROLLLLEDDDD";
		}
		
		
		 print "<br>";

		 //compare the strings
		 //if( $name === $good_name && $pass === $good_pass){
		//	echo "That is the correct log-in information";
		 //}else{
			//echo "That is not the correct log-in information.";
		 //}
	  ?>	
	  
  </body>
</html>