<?php
session_start();
	$course_name  = $_SESSION['c_name'];
	$course_id  = $_SESSION['c_id'];
?>

<html>
		<head>
			<title>
				Lecture Notes
			</title>
		</head>

		<body style="background-color:crimson;">
			<p style="text-align:right;padding-top:75px;padding-right:50px;"><image src="logo.png" class="img-responsive" alt="centered image"
						height="100", width="300"></p>
				<input type="button" value="Back to Content Page" onclick="location='student_select_content.php'"
						style="margin-left: 80%;font-family:impact;font-size:90%;width:13%;color:black;"><P>
		</body>

		<?php

	$servername = $_SESSION['servername'];
	$databasename = $_SESSION['databasename'];
	$username = $_SESSION['username_db'];
	$password = $_SESSION['password_db'];

		$conn = new mysqli($servername, $username, $password, $databasename);

		
		$sql = "select l.content_id, l.lecture_num, l.content_title, c.user_email, truncate(sum(r.rating_out_of_5)/count(r.content_id), 2) as rating FROM lecture_help as l, course_content as c";
		$sql = $sql." LEFT JOIN rating_feedback as r ON r.content_id = c.id AND r.content_title = c.title";
		$sql = $sql." Where l.content_id=c.id AND l.content_title=c.title AND c.course_id=".$course_id." AND c.course_name='".$course_name."' AND c.approval_status=1";
		$sql = $sql." GROUP BY lecture_num ORDER BY rating DESC;";
		//$sql = "Select l.content_id, l.lecture_num, l.content_title, c.user_email FROM lecture_help as l, course_content as c WHERE l.content_id=c.id";
		//$sql = $sql." AND l.content_title = c.title AND c.course_id=".$course_id." AND c.course_name='".$course_name."' AND approval_status = 1;";

		$query = $conn->query($sql);

		if($query->num_rows > 0)
		{
			?>
			<style>
					table {
							margin-left:10%;
					    font-family:impact;
							font-size:90%;
					    border-collapse: collapse;
					    width: 80%;
					}

					td, th {
					    border: 1px solid black;
					    text-align: left;
					    padding: 8px;
					}

					tr:nth-child(even) {
					    background-color: #B22222;
					}
				</style>

			<table>



				<thead>
				<tr style = "background-color: DarkRed">
					<th>Lecture Help ID</th>
					<th>Title</th>
					<th>Submitted By</th>
					<th>Rating</th>
				</tr>
				</thead>
			<tbody>
			<?php
			while($row = $query->fetch_assoc())
			{
				?>
				<tr text-align="center">
					<td><?php echo $row['lecture_num'] ?></td>
					<td><?php echo $row['content_title'] ?></td>
					<td><?php echo $row['user_email'] ?></td>
					<?php
					// Check is not rated
					if(!isSet($row['rating']))
						$rating = "Not Rated Yet";
					else
						$rating = $row['rating']."/5";
					?><td><?php echo $rating ?></td><?php
				 ?>
				</tr>

				<?php
			}
			?>
			 </tbody>
			</table>
			</p>

				<div style="text-align:center;font-family:impact;font-size:120%;color:black;">
					<u>
					View Lecture Notes
					</u>
				</div>
				<form action=student_view_lecture.php method=POST
								style="text-align:center;text-align:center;font-family:impact;font-size:100%;color:black;">
						 	Notes ID: <input type=TEXT name="lecture_num"
								style="vertical-align:left;border: 1px solid black;padding: 3px 3px;width:8%;"
								required><BR>
						<input type=SUBMIT value="View Notes" style="font-family:impact;font-size:90%;width:8%;"><P>
				 </form>

				<div style="text-align:center;font-family:impact;font-size:120%;color:black;">
					<u>
						Rate Lecture Notes
					</u>
				</div>
					 <form action=student_lecture_rating.php method=POST
								style="text-align:center;font-family:impact;font-size:100%;color:black;">
								Notes ID: <input type=TEXT name="lecture_num"
									style="display:inline-block;vertical-align:left;border: 1px solid black;padding: 3px 3px;width:8%;"
									required><BR>
								Rating out of 5: 	<input type=TEXT name="rating_out_of_5"
									style="display:inline-block;vertical-align:left;border: 1px solid black;padding: 3px 3px;width:8%;"
									required><BR>
						<input type=SUBMIT value="Rate Notes" style="font-family:impact;font-size:90%;width:8%;"><P>
					 </form>
					 <div style="padding-top:20;text-align:center;font-family:impact;font-size:120%;color:black;">
						<u>
							Report Lecture Notes
						</u>
					</div>
						 <form action=student_lecture_report.php method=POST
									style="text-align:center;font-family:impact;font-size:100%;color:black;">
									Notes ID: <input type=TEXT name="lecture_num"
										style="display:inline-block;vertical-align:left;border: 1px solid black;padding: 3px 3px;width:8%;"
										required><BR>
							<input type=SUBMIT value="Report Notes" style="font-family:impact;font-size:90%;width:8%;"><P>
						 </form>
			<?php
		}
		else
		{
			?>
			<html>
			<p style = "text-align:center;font-family:impact;font-size:120%;color:black;">
				There has been no Lecture Notes Help uploaded yet!
			</p>
			</html>
			<?php
		}

		?>

		<?php
			if($_SESSION['lecture_invalid'] == TRUE)
			{
				$_SESSION['lecture_invalid'] = FALSE;
				echo "<script type='text/javascript'>alert('That lecture ID does not exist, please try again!')
				window.location = 'student_lecture_notes.php';</script>";
			}
		 ?>
</html>
