<?php
session_start();
 ?>

<html>
<head>
	 <title>Course Forum Page</title>
</head>
<body style="background-color:crimson;">
		<p style="text-align:right;padding-top:75px;padding-right:50px;"><image src="logo.png" class="img-responsive" alt="centered image"
				height="100", width="300"></p>
		<input type="button" value="Back to Select A Course Page" onclick="history.go(-1);"
						style="margin-left: 80%;font-family:impact;font-size:90%;width:15%;color:black;"><P>

<?php

	$answer_unvalid = $_SESSION['answer_unvalid'];
	?>
	<p style="text-align:left;margin-left:15%;font-family:impact;font-size:120%;color:black;">
	<?php
	echo strtoupper($_SESSION['c_name']);
	echo "&nbsp";
	echo $_SESSION['c_id'];
	echo "&nbspForum:"
	?>
</p>
	<iframe  scrolling="yes" src="forum_content.php" width="90%" height="60%" style="margin-left:5%;overflow: scroll;">

	</iframe>
<form action=student_question_tmp_page.php method=POST
      style="margin-left:25%;padding-top:20px;font-family:impact;font-size:120%;color:black;float:left;">
   Question: <input type=TEXT name="question"
      style="display:inline-block;vertical-align:middle;border: 1px solid black;padding: 3px 3px;width:80%;"
  required><BR>
  <input type=SUBMIT value="Post Question" style="font-family:impact;font-size:90%;width:80%;">
 </form>
 <form action=student_answer_tmp_page.php method=POST
      style="margin-right:25%;padding-top:20px;font-family:impact;font-size:120%;color:black;float:right;">
   Answer: <input type=TEXT name="answer"
      style="display:inline-block;vertical-align:middle;border: 1px solid black;padding: 3px 3px;width:80%;"
  required><BR>
    Question ID: <input type=TEXT name="q_id"
       style="display:inline-block;vertical-align:middle;border: 1px solid black;padding: 3px 3px;width:80%;"
   required><BR>
  <input type=SUBMIT value="Post Answer to the Question" style="font-family:impact;font-size:90%;width:80%;"><P>
 </form>

 <input type="button" value="Go back to homepage" onclick="location='process_form.php'"
 		style="margin-left: 40%;font-family:impact;font-size:90%;width:15%;"/><P>

<!--<?php
	if ($answer_unvalid == TRUE){
		$_SESSION['answer_unvalid'] = FALSE;
		echo "<script type='text/javascript'>alert('The question ID was not valid, please try again...')</script>";
	}
 ?>-->

</body>
</html>
