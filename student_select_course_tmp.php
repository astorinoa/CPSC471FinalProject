<?php
	ob_start();
	session_start();
 ?>

<html>


<?php
	$course_name  = $_POST['course_name'];
	$course_id  = $_POST['course_id'];
  $course_unvalid = $_SESSION['course_unvalid'];
	$_SESSION['c_name'] = $course_name;
  $_SESSION['c_id'] = $course_id;
  $student_name = $_SESSION['studentname'];


	$servername = $_SESSION['servername'];
	$databasename = $_SESSION['databasename'];
	$username = $_SESSION['username_db'];
	$password = $_SESSION['password_db'];

	$conn = new mysqli($servername, $username, $password, $databasename);

	$sql = "Select * from favourites where course_id = ".$course_id." AND course_name = '".$course_name."' AND user_email = '".$student_name."'";

	$query = $conn->query($sql);

	if($query->num_rows >0)
	{
    header("Location:student_course_page.php");
	}
  else{
    $_SESSION['course_unvalid'] = TRUE;
    header("Location:student_select_course.php");
  }
?>

</p>

</html>
