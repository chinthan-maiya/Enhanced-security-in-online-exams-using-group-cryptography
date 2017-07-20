<html>
<form method="post" name="f2" id="f2">
<input type="submit" value="Exchange key with admin"  name="submit" id="submit"/>
</form>
<form method="post" name="f3" id="f3">
<input type="submit" value="Start test" name="sub" id="sub"/>
</form>
</html>
<?php
session_start();
$conn = mysqli_connect("localhost","root","");
mysqli_select_db($conn,"sem");
$sql="select admin from aekey";
$result=$conn->query($sql);
$row = mysqli_fetch_assoc($result);
if($row["admin"])
	echo "Admin wants to communicate<br>";
$temp=$row["admin"];
$key=0;
$p=7;
$q=3;
if(isset($_POST['submit']))
{
	$p=7;
	$q=3;
	$_SESSION["b"]=rand(2,10);
	$g2=fmod(pow($q,$_SESSION["b"]),$p);
	$sql1="update aekey set examiner='$g2' where admin='$temp'";
	if($conn->query($sql1))
	{
		
	}
}
if(isset($_POST['sub']))
{
	$v=1;
	$ss="update examinee set start='$v' where 1";
	if($conn->query($ss))
	{}
}
$sql2="select message from aemes limit 1";
$result1=$conn->query($sql2);
$row1=mysqli_fetch_assoc($result1);
$mes=$row1["message"];
if($conn->query($sql2))
{}
if($mes )
{
	$key=pow($temp,$_SESSION["b"])%$p;
	$l=strlen($mes);
	for ($x = 0; $x<$l; $x++) 
	{
		$c=$mes[$x];
		for($y=0;$y<$key;$y++)
		{
			if($c==' ')
				continue;
			if($c==='a')
				$c='z';
			else
				$c=chr(ord($c) - 1);
		}
		$mes[$x]=$c;	
	} 
	echo "<br>The message you have received is:<br>".$mes;
}
?>