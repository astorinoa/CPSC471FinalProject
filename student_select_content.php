<?php
	session_start();
	$course_name = $_SESSION['c_name'];
	$course_id = $_SESSION['c_id'];
?>

<html>
	<body>
		<title>
			KickstartU Select Content
		</title>
	</body>

		<body style="background-color:crimson;">
			<p style="text-align:right;padding-top:75px;padding-right:50px;"><image src="logo.png" class="img-responsive" alt="centered image"
						height="100", width="300"></p>
				<input type="button" value="Back to Course Page" onclick="location='student_course_page.php'"
						style="margin-left: 75%;font-family:impact;font-size:90%;width:12%;color:black;"><P>
		</bosy>

		<p style="text-align:left;margin-left:20%;font-family:impact;font-size:120%;color:black;">
	<?php
	echo strtoupper($course_name." ");
	echo $course_id;
	echo "&nbsp;Available Content";
	?>
</p>

	<body>

	<input type="button" value="Assignment Help" onclick="location='student_assignment_help.php'"
			style="margin-left: 40%;font-family:impact;font-size:90%;width:15%;"/><P>
	<input type="button" value="Lab Help" onclick="location='student_lab_help.php'"
			style="margin-left: 40%;font-family:impact;font-size:90%;width:15%;"/><P>
	<input type="button" value="Lecture Notes" onclick="location='student_lecture_notes.php'"
			style="margin-left: 40%;font-family:impact;font-size:90%;width:15%;"/><P>
	<input type="button" value="Practice Problems" onclick="location='student_practice_problems.php'"
			style="margin-left: 40%;font-family:impact;font-size:90%;width:15%;"/><P>



	</body>
</html>
