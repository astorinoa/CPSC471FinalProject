<?php
	session_start();
 ?>

<html>
	<head>
		<title>
			Select A Course
		</title>
	</head>

	<body style="background-color:crimson;">
		<p style="text-align:right;padding-top:75px;padding-right:50px;"><image src="logo.png" class="img-responsive" alt="centered image"
					height="100", width="300"></p>
			<input type="button" value="Back to Home Page" onclick="location='process_form.php'"
					style="margin-left: 80%;font-family:impact;font-size:90%;width:12%;color:black;"><P>
						<p style="text-align:left;margin-left:20%;font-family:impact;font-size:120%;color:black;">
									Select A Course:
						</p>

	<?php
	$admin_name = $_SESSION['user_email'];
	$course_unvalid = $_SESSION['course_unvalid'];


	$sql = "Select * from course where user_email = '".$admin_name."'";


	$servername = $_SESSION['servername'];
	$databasename = $_SESSION['databasename'];
	$username = $_SESSION['username_db'];
	$password = $_SESSION['password_db'];

		$conn = new mysqli($servername, $username, $password, $databasename);

	$query = $conn->query($sql);
	if($query->num_rows >0)
	{
		$counter  = 0;
		while($row = $query->fetch_assoc())
		{
			?>
				<p style="text-align:left;border:2px solid black;border-radius: 5px;padding-left:20px;
					width:40%;margin-left:26%;font-family:impact;font-size:120%;color:black;">

			<?php
			echo "Course name: ";
			echo $row['course_name'];
			echo ", Course ID:&nbsp;&nbsp;".$row['id'];
			print "<BR>";
			$course_list[$counter] = $row['course_name'];
			$course_id_list[$counter] = $row['id'];
			$counter = $counter + 1;
		}
	}

	if ($course_unvalid == TRUE){
		$_SESSION['course_unvalid'] = FALSE;
		echo "<script type='text/javascript'>alert('You entered a course you are not authorized to manage, or does not exist, please try again.')
		window.location = 'admin_select_course.php';</script>";
	}
	?>

	<form action=admin_select_course_tmp.php method=POST
          style="text-align:center;font-family:impact;font-size:120%;color:black;">
  	   Course Name: <input type=TEXT name="course_name" minlength="4" maxlength="4"
          style="display:inline-block;vertical-align:middle;border: 1px solid black;padding: 3px 3px;width:15%;"
					required><BR>
  	   Course ID: <input type=TEXT name="course_id" minlength="3" maxlength="3"
          style="display:inline-block;vertical-align:middle;border: 1px solid black;padding: 3px 3px;width:10%;"
					required><P>
  	  <input type=SUBMIT value="Select Course" style="font-family:impact;font-size:90%;width:10%;"><P>

	   </form>

</html>
