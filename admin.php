<html>
<head>


</head>

<body onload="countdownto()">
<div id="txt"></div>
<form method="post" name="f" id="f">

 Enter examinee ID<br>
&emsp;&emsp;<input type="text" name="id" ></input>
<br>

 Enter examinee password<br>
&emsp;&emsp;<input type="text" name="pwd"></input>
<br>

<br>
<input type="submit" value="Add examinee"  name="submit" id="submit"/>
</form>

<form method="post" name="f2" id="f2">
<input type="submit" value="Exchange key with examiner"  name="submit2" id="submit2"/>
</form>
</body>
</html>
<?php
session_start();
$conn = mysqli_connect("localhost","root","");
mysqli_select_db($conn,"sem");
if(isset($_POST['submit']))
{	
	$id = strip_tags($_POST['id']);
	$id = mysqli_real_escape_string($conn,$id);
	$pwd = strip_tags($_POST['pwd']);
	$pwd = mysqli_real_escape_string($conn,$pwd);
	$sql="insert into examinee(examid,pwd) values('$id','$pwd')";
	if ($conn->query($sql) === TRUE) {
		echo "<script>window.alert('Examinee added successfully')</script>";
		header("location:admin.php");
	}
}
$key=0;
$p=7;
$q=3;

if(isset($_POST['submit2']))
{
	$p=7;
	$q=3;
	$_SESSION["a"]=rand(2,10);
	
	$g1=pow($q,$_SESSION["a"])%$p;
	$sql2="insert into aekey(admin) values('$g1')";
	if ($conn->query($sql2) === TRUE) {
		
	}
}
$sql3="select examiner from aekey";
$result=$conn->query($sql3);
$row = mysqli_fetch_assoc($result);
if($row["examiner"])
{
	echo "<form name=\"f3\" method=\"post\">";
	echo "<input type=\"text\" name=\"mes\"></input>";
	echo "<input type=\"submit\" name=\"s\" value=\"Send message to examiner\">";
	echo "</form>";
	$temp=$row["examiner"];
	
	$key=pow((int)($temp),$_SESSION["a"])%$p;
	
}
if(isset($_POST['s']))
{
	$mes=$_POST["mes"];
	$l=strlen($mes);
	
	for ($x = 0; $x<$l; $x++) 
	{
		$c=$mes[$x];
		for($y=0;$y<$key;$y++)
		{
			if($c==' ')
				continue;
			$c = ('z' === $c ? 'a' : ++$c);
			
		}
		$mes[$x]=$c;
	} 
	$sqll="insert into aemes(message,sender) values('$mes','admin')";
	$re=$conn->query($sqll);
	if($re)
	{
		
	}
}
?>
