<html>
<head>
</head>
<body>
</body>
</html>
<?php
$conn = mysqli_connect("localhost","root","");
mysqli_select_db($conn,"sem");
$id=$_GET['id'];
$sql="select mcq,q4,q5,total from exam where examid='$id'";
$res=$conn->query($sql);
$row=mysqli_fetch_assoc($res);
if($row["total"]==Null)
{
	echo "Yet to be corrected";
}
else
{
	echo "MCQ-".$row["mcq"]."marks<br>";
	$sub=$row["total"]-$row["mcq"];
	echo "Subjective-".$sub."marks<br>";
	echo "Total-".$row["total"]."marks<br>";
	if($row["total"]==10)
		echo "Congrats on scoring 100%<br>";
}

?>
