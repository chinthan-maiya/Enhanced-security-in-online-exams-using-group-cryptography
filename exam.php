<html>
<head>

<?php
// Upon starting the section
session_start();
$_SESSION['TIMER'] = time() + 10; // Give the user Ten minutes
?>
<script type="text/javascript">
var TimeLimit = new Date('<?php echo date('r', $_SESSION['TIMER']) ?>');
</script>
<script type="text/javascript">
function countdownto()
{
	
	
	var date = Math.round((TimeLimit-new Date())/1000);
	var hours = Math.floor(date/3600);
	date = date - (hours*3600);
	var mins = Math.floor(date/60);
	date = date - (mins*60);
	var secs = date;
	if (hours<10) hours = '0'+hours;
	if (mins<10) mins = '0'+mins;
	if (secs<10) secs = '0'+secs;
	document.getElementById('txt').innerHTML = hours+':'+mins+':'+secs;
	
	setTimeout("countdownto()",1000);
	if(hours=="00" && mins=="00" && secs=="00")
	{
		document.forms[0].submit();
	}		
}
countdownto();
</script>

</head>

<body onload="countdownto()">
<div id="txt"></div>

<form method="post"  name="f" id="f">
Q1. <br>
	&emsp;&emsp;x+y=20<br>
	&emsp;&emsp;y-x=10<br>
	&emsp;&emsp;The value of x is<br>
&emsp;&emsp;<input type="radio" name="q1" value="a" />a. 3<br />
&emsp;&emsp;<input type="radio" name="q1" value="b" />b. 5<br />
&emsp;&emsp;<input type="radio" name="q1" value="c" />c. 15<br>
&emsp;&emsp;<input type="radio" name="q1" value="0" checked="checked" />
<br>

Q2. Three angles of a quadrilateral measure 80&deg;,70&deg; and 100&deg;. The fourth angle measures<br>

&emsp;&emsp;<input type="radio" name="q2" value="a" />a. 50&deg;<br>
&emsp;&emsp;<input type="radio" name="q2" value="b" />b. 10&deg;<br>
&emsp;&emsp;<input type="radio" name="q2" value="c" />c. 110&deg;<br>
&emsp;&emsp;<input type="radio" name="q2" value="0" checked="checked" /><br>

<br>
Q3. How many real roots does the equation x<sup>2</sup>+x+1=0 have?<br>

&emsp;&emsp;<input type="radio" name="q3" value="a" />a. 0<br />
&emsp;&emsp;<input type="radio" name="q3" value="b" />b. 1<br />
&emsp;&emsp;<input type="radio" name="q3" value="c" />c. 2<br>
&emsp;&emsp;<input type="radio" name="q3" value="0" checked="checked" /><br>
<br>

Q4. State exterior angle property<br>
&emsp;&emsp;<input type="text" name="q4" ></input>
<br>

Q5. For the equation ax<sup>2</sup>+bx+c=0 the discriminant is<br>
&emsp;&emsp;<input type="text" name="q5"></input>
<br>

<br>
<input type="submit" value="Submit"  name="subm" id="subm"></input>
</form>
</body>
</html>
<?php
session_start();
if(!isset($_SESSION['sid']))
{
    header('Location: examlogin.php');
    exit();
}
$conn = mysqli_connect("localhost","root","");
mysqli_select_db($conn,"sem");

if(isset($_POST['subm']) or $_SERVER['REQUEST_METHOD'] == "POST")
{
	$score=0;
	if ($_POST['q1'] == 'b')
	{
		$score=$score+2;
	}
	if ($_POST['q2'] == 'c')
	{
		$score=$score+2;
	}
	if ($_POST['q3'] == 'a')
	{
		$score=$score+2;
	}
	
	$q4 = strip_tags($_POST['q4']);
	$q4 = mysqli_real_escape_string($conn,$q4);
	$q5 = strip_tags($_POST['q5']);
	$q5 = mysqli_real_escape_string($conn,$q5);
	$id=$_GET['id'];
	$sql="insert into exam(examid,mcq,q4,q5) values('$id','$score','$q4','$q5')";
	$v=0;
	$ss="update examinee set start='$v' where examid='$id'";
	if($conn->query($ss))
	{}
	if ($conn->query($sql) === TRUE) {
    echo "<script>window.alert(\"The test has been submitted\")</script>";
	header("location:examlogin.php");
	}
}
?>
