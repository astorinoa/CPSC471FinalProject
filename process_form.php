<?php
ob_start();
header("Cache-Control: no cache");
session_cache_limiter("private_no_expire");
session_start();
$_SESSION['servername'] = "127.0.0.1";
$_SESSION['databasename'] = "cpsc471project";
$_SESSION['username_db'] = "dylan";
$_SESSION['password_db'] = "password";
?>

<html>
  <head>
	<title>Homepage</title>
  <head>

    <body style="background-color:crimson;">
      <p style="text-align:right;padding-top:75px;padding-right:50px;"><image src="logo.png" class="img-responsive" alt="centered image"
          height="100", width="300"></p>
	<?php


	if(!isSet($_POST['user_email']))
	{
		$name = $_SESSION['user_email'];
		$pass = $_SESSION['password'];
	}
	else{
		 $name  = $_POST['user_email'];
		 $pass  = $_POST['password'];
     $_SESSION['user_email'] = $name;
 	 	 $_SESSION['password'] = $pass;
	}
		// Trying the database part

		$servername = $_SESSION['servername'];
		$databasename = $_SESSION['databasename'];
		$username = $_SESSION['username_db'];
		$password = $_SESSION['password_db'];

		$conn = new mysqli($servername, $username, $password, $databasename);


		if($conn->connect_error)
		{
			die("Connection_failed: " . $conn->connect_error);
		}

		print "<br>";
		//Check if user exists in database:

		$sql = "SELECT * from end_user";

		$result = $conn->query($sql);

		$founduser = false;
    $bannedUser = false;
		if($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc()){
				if($row['user_email'] == $name)
				{
          $sqlBan = "SELECT * from bans WHERE stud_email = '".$name."'";
      		$resultBanned = $conn->query($sqlBan);
          if ($resultBanned->num_rows > 0){
            $bannedUser = true;
          }
					if($pass == $row['password'] && $bannedUser == false )
					{
          ?>
            <p style="text-align:left;margin-left:15%;padding-bottom:20px;font-family:impact;font-size:120%;color:black;">
                  Logged in as:
          <?php
						echo $name;
						print "<br>";
						$founduser = true;
						?>
						</p>
						<?php
					}
				}
			}

			if($founduser == false  && $bannedUser == false)
			{
        echo "<script type='text/javascript'>alert('Account not found. Please check your email and password or create account!')
         window.location = 'login_page.php';</script>";
			}
      elseif($bannedUser == true){
        echo "<script type='text/javascript'>alert('Account has been banned. Contact administration to get your account reinstated.')
         window.location = 'login_page.php';</script>";
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
          $_SESSION['course_unvalid'] = FALSE;
          $_SESSION['unvalid_email'] = FALSE;
          $_SESSION['already_banned'] = FALSE;
          $_SESSION['not_banned'] = FALSE;
          $_SESSION['invalidID'] = FALSE;
        	$_SESSION['approved_already'] = FALSE;

					?>
          <input type="button" value="Add Course" onclick="location='admin_add_course.php'"
                style="margin-left: 40%;font-family:impact;font-size:90%;width:15%;"/><P>
					<input type="button" value="Select Course" onclick="location='admin_select_course.php'"
                style="margin-left: 40%;font-family:impact;font-size:90%;width:15%;"/><P>
					<input type="button" value="View Notifications" onclick="location='admin_notifications.php'"
                style="margin-left: 40%;font-family:impact;font-size:90%;width:15%;"/><P>
					<input type="button" value="Ban Students" onclick="location='admin_ban_student_page.php'"
                style="margin-left: 40%;font-family:impact;font-size:90%;width:15%;"/><P>
          <input type="button" value="Logout" onclick="location='login_page.php'"
                style="margin-left: 15%;font-family:impact;font-size:90%;width:15%;"/><P>
					<?php
				}
				else
				{
					// is a student

          $_SESSION['studentname'] = $name;
          $_SESSION['course_exists'] = FALSE;
          $_SESSION['favourite_exists'] = FALSE;
          $_SESSION['favourite_checker'] = FALSE;
          $_SESSION['answer_unvalid'] = FALSE;
          $_SESSION['course_unvalid'] = FALSE;
          $_SESSION['assignment_invalid'] = FALSE;
          $_SESSION['lecture_invalid'] = FALSE;
          $_SESSION['lab_invalid'] = FALSE;
          $_SESSION['practice_invalid'] = FALSE;

					?>
          <input type="button" value="Select Course" onclick="location='student_select_course.php'"
              style="margin-left: 40%;font-family:impact;font-size:90%;width:15%;"/><P>
          <input type="button" value="Favourite Course" onclick="location='student_favourite_course.php'"
              style="margin-left: 40%;font-family:impact;font-size:90%;width:15%;"/><P>
					<input type="button" value="View Notifications" onclick="location='student_notifications.php'"
              style="margin-left: 40%;font-family:impact;font-size:90%;width:15%;"/><P>
          <input type="button" value="Logout" onclick="location='login_page.php'"
              style="margin-left: 15%;font-family:impact;font-size:90%;width:15%;"/><P>

          <?php

				}

			}

		}
		else{
      	print "<br>";
		}



		 //compare the strings
		 //if( $name === $good_name && $pass === $good_pass){
		//	echo "That is the correct log-in information";
		 //}else{
			//echo "That is not the correct log-in information.";
		 //}
	  ?>

  </body>
</html>
