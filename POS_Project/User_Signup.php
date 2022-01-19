<?php 
	include('ConnectDB.php');
	if (isset($_POST['btnsubmit']))
	{
		$fname=$_POST['txtfname'];
		$sname=$_POST['txtsurname'];
		$gender=$_POST['rdogender'];
		$phone=$_POST['txtphone'];
		$dob=date ("Y-m-d",strtotime($_POST['txtdob']));
		$email=$_POST['txtemail'];
		$password=$_POST['txtpassword'];
		$address=$_POST['txtaddress'];
		$check="SELECT * FROM User WHERE UserEmail = '$email'";
		$checkret = mysqli_query($connection,$check);
		$count=mysqli_num_rows($checkret);
		if ($count>0)
		{
			echo"<script>window.alert('User Email is Already Exits');</script>";
		}
		else
		{
			$insert="INSERT INTO User(FirstName,LastName,Phone,UserEmail,Password,Address,DOB,Gender)VALUES('$fname','$sname','$phone','$email','$password','$address','$dob','$gender')";
			$insertret=mysqli_query($connection,$insert);
			if ($insertret)
			{
				echo "<script>window.alert('User Account Created');</script>";
				echo"<script>window.location='Sign_In.php';</script>";
			}
			else
			{
				echo "<p>Error in User Registratin Page: ".mysqli_error($connection)."</p>";
			}
		}
	}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>User Signup</title>
 </head>
 <body>
 		<form action="user_signup.php" method="post">
 			<fieldset>
 				<legend>Enter User Information : </legend>
 				<table align="center" cellspacing="3">
 					<tr>
 						<td>First Name</td>
 						<td>
 							<input type="text" name="txtfname" placeholder="Enter Name Here" required>
 						</td>
 					</tr>
 					<tr>
 						<td>Last Name</td>
 						<td>
 							<input type="text" name="txtsurname" placeholder="Enter SurName Here" required>
 						</td>
 					</tr>
 					<tr>
 					<td>Gender</td>
 					<td>
 						<input type="radio" name="rdogender" value="M">Male
 						<input type="radio" name="rdogender" value="F">Female
 					</td>
 					</tr>
 					<tr>
 						<td>Phone</td>
 						<td>
 							<input type="text" name="txtphone" placeholder="+95---------" required>
 						</td>
 					</tr>
 					<tr>
 						<td>Date of Birth</td>
 						<td>
 							<input type="date" name="txtdob"required>
 						</td>
 					</tr>
 					<tr>
 						<td>Email</td>
 						<td>
 							<input type="email" name="txtemail"placeholder="example@email.com" required>
 						</td>
 					</tr>
 					<tr>
 						<td>Password</td>
 						<td>
 							<input type="password" name="txtpassword" placeholder="XXXXXXXX" required>
 						</td>
 					</tr>
 					<tr>
 						<td>Address</td>
 						<td>
 							<input type="text" name="txtaddress" placeholder="[N0. / Street / Township]"required>
 						</td>
 					</tr>
 					<tr>
 						<td></td>
 						<td>
 							<input type="submit" name="btnsubmit">
 							<input type="reset" name="Clear">
 						</td>
 					</tr>
 				</table>
 			</fieldset>
 		</form>
 </body>
 </html>