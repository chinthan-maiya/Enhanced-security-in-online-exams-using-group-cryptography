<!--
	Author: W3layouts
	Author URL: http://w3layouts.com
	License: Creative Commons Attribution 3.0 Unported
	License URL: http://creativecommons.org/licenses/by/3.0/
-->

<!DOCTYPE html>
<html>
<head>

</head>

<body>

	<div>


	</div>
</body>
</html>

<?php
	session_start();
	if(!isset($_SESSION['sid']))
	{
    header('Location: markerlogin.php');
    exit();
	}
	if($_SESSION['sid']==session_id())
	{
		echo "Welcome to you<br>";
		echo "<a href='markerlogin.php'>Logout</a><br><br>";
	}
	else
	{
		session_destroy();
		header("location:markerlogin.php");
	}
	$conn = mysqli_connect("localhost","root","");
	mysqli_select_db($conn,"sem");
	$sql="select examid,q4,q5,mcq from exam where total is NULL order by examid limit 1";
	$result=$conn->query($sql);
	$mcq=0;
	if (mysqli_num_rows($result) > 0)
	{
    	$row = mysqli_fetch_assoc($result);
		$examid=$row["examid"];
		$q4=$row["q4"];
		$q5=$row["q5"];
		$mcq=$row["mcq"];
		echo "Exam ID:";
		echo $examid;
		echo "<form method=\"post\" name=\"s\">";
		echo"<p>Question: State exterior angle property<br>";
		echo "Answer:".$q4."<br>";
		echo "<input type=\"text\" name=\"ans1\"></input><br>";
		echo "<p>Question: For the equation ax<sup>2</sup>+bx+c=0 the discriminant is<br>";
		echo "Answer:".$q5."<br>";
		echo "<input type=\"text\" name=\"ans2\"></input><br><button type=\"submit\"  name=\"subm\">Next</button></form>";
	}


	else
	{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
							window.alert('No unmarked examinee')
							window.location.href='markerlogin.php'
							</SCRIPT>");
	}
	if(isset($_POST['subm']))
	{
		$a1=$_POST['ans1'];
		$a2=$_POST['ans2'];
		$t=(int)$a1+(int)$a2+$mcq;
		$sql2="update exam set total='$t' where examid='$examid'";
		if ($conn->query($sql2) === TRUE)
		{
			echo "";
		}
		else
		{
			echo "Error updating record: " . $conn->error;
		}
		header('Location: '.$_SERVER['PHP_SELF']);
		die;
	}

?>
