<?php 
	session_start();
	include('ConnectDB.php');
	if (isset($_POST['btnLogin'])) 
	{
		$UserEmail=$_POST['txtEmail'];
		$Password=$_POST['txtPassword'];
		$query="SELECT * FROM User WHERE UserEmail='$UserEmail' AND Password='$Password'";
		$result=mysqli_query($connection,$query);
		$count=mysqli_num_rows($result);
		if ($count>0) 
		{
			$arr=mysqli_fetch_array($result);
			$_SESSION['UserID']=$arr['UserID'];
			$_SESSION['FirstName']=$arr['FirstName'];
			$_SESSION['LastName']=$arr['LastName'];
			echo "<script>alert('Login Successful');</script>";
		}
		else
		{
			echo "<script>alert('Login Fail');</script>";
		}
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="CustomerLogin.php" method="POST">
		<fieldset>
			<legend>Customer LogIn</legend>
			<table align="center" cellpadding="10">
				<tr>
					<td>User Email</td>
					<td><input type="Email" name="txtEmail"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="Password" name="txtPassword"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="btnLogin" value="Log in"></td>
				</tr>
			</table>
		</fieldset>
		
	</form>
</body>
</html>