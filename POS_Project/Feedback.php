<?php 
	include('ConnectDB.php');
	if(isset($_POST['btnsubmit']))
	{
		$name=$_POST['txtname'];
		$phone=$_POST['txtphone'];
		$email=$_POST['txtemail'];
		$comment=$_POST['txtcomment'];


		$insert="INSERT INTO Feedback(Name,Phone,Email,Comment) Values('$name','$phone','$email','$comment')";
		$insertret=msqli_query($connection,$insert);
		if($insertret)
		{
			echo "<script>window.alert('Thank you for your Feedback!')</script>";
			echo "<script>window.location='Feedback.php'</script>";
		}
		else
		{
			echo "<p>Error in User Registration Page: ".msqli_error($connection)."</p>";
		}
	}

 ?>
 <!DOCTYPE html>
 <html>
	 <head>
	 	<title>Feedback</title>
	 </head>
	 <body>
	 	<form action="Feedback.php" method="POST">
	 		<fieldset>
	 			<legend>
	 				Enter Feedback Information : 
	 			</legend>
	 			<table>
	 				<tr>
	 					<td>Name</td>
	 					<td>
	 						<input type="text" name="txtname" placeholder="Enter Name Here" required>
	 					</td>
	 				</tr>
	 				<tr>
	 					<td>Phone</td>
	 					<td>
	 						<input type="text" name="txtphone" placeholder="+95---------" required>
	 					</td>
	 				</tr>
	 				<tr>
	 					<td>Email</td>
	 					<td>
	 						<input type="text" name="txtemail" placeholder="example@gmail.com" required>
	 					</td>
	 				</tr>
	 				<tr>
	 					<td>Comment</td>
	 					<td>
	 						<textarea name="txtcomment"></textarea>
	 					</td>
	 				</tr>
	 				<tr>
	 					<td></td>
	 					<td>
	 						<input type="submit" name="btnsubmit" value="Submit">
	 						<input type="reset" value="Clear">
	 					</td>
	 				</tr>
	 			</table>
	 		</fieldset>
	 	</form>
	 </body>
 </html>