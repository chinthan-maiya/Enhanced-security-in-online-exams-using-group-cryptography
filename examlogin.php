<!DOCTYPE html>
<html>
<style>
form {
    border: 3px solid #f1f1f1;
}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>
<body>

<h2>Login Form</h2>

<form method="post">
  <div  align="left">
    <b>Read the following instructions carefully</b><br><br>
			-> The duration of the test is 15 minutes<br>
			-> The test consists of 5 questions of which the questions 1,2 and 3 are of MCQ type and questions 4 and 5 are of descriptive type<br>
			-> All the questions carry 2 marks each<br>
			-> The test can be submitted by clicking the Submit button<br>
			-> Good Luck!
  </div>

  <div class="container">
    <label><b>Exam ID</b></label>
    <input type="text" placeholder="Enter Exam ID" name="id" required>

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="pwd" required>
        
    <button type="submit" name="subm">Login</button>
    
  </div>

</form>

</body>
</html>
<?php
$conn = mysqli_connect("localhost","root","");
mysqli_select_db($conn,"sem");


	if(isset($_POST['subm']))
	{
		$id=$_POST['id'];
		$pwd=$_POST['pwd'];
		$ss="select start from examinee where examid='$id'";
		$rss=$conn->query($ss);
		$rowss=mysqli_fetch_assoc($rss);
		if($rowss["start"]==1)
		{
			$sql="select examid,pwd from examinee where examid='$id'";
			$result=$conn->query($sql);
			$row=mysqli_fetch_assoc($result);
			$q=$row["pwd"];
			$r=$row["examid"];
			if($pwd==$q)
			{
				session_start();
				$_SESSION['sid']=session_id();
				header("location:exam.php?id=$r");
			}
			else
			{
				echo "<script>window.alert('Invalid login credentials. Enter the correct exam ID and password assigned to you')</script>";
			}
		}
		else
		{
			echo "<script>window.alert('Please wait till the examiner instructs')";
			
			echo "<script>window.location=\"examlogin.php\"</script>";
		}
	}


?>