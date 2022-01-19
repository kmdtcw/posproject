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
		$check="SELECT * FROM admin WHERE AdminEmail = '$email'";
		$checkret = mysqli_query($connection,$check);
		$count=mysqli_num_rows($checkret);
		if ($count>0)
		{
			echo"<script>window.alert('Admin Email is Already Exits');</script>";
		}
		else
		{
			$insert="INSERT INTO admin(FirstName,LastName,Phone,AdminEmail,Password,Address,DOB,Gender)VALUES('$fname','$sname','$phone','$email','$password','$address','$dob','$gender')";
			$insertret=mysqli_query($connection,$insert);
			if ($insertret)
			{
				echo "<script>window.alert('Admin Account Created');</script>";
				echo"<script>window.location+'AdminRegister.php';</script>";
			}
			else
			{
				echo "<p>Error in Admin Registratin Page: ".mysqli_error($connection)."</p>";
			}
		}
	}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Admin Signup</title>
 </head>
 <body>
 		<form action="AdminRegister.php" method="post">
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

 			<fieldset>
                <legend>Admin Information</legend>
                <table>
                    <tr>
                        <td>
                            <?php
                            $query="SELECT * FROM Admin ORDER BY AdminID";
                            $ret=mysqli_query($connection,$query);
                            $num_results=mysqli_num_rows($ret);
                            if ($num_results==0) {
                                echo "<h2>No Record Found</h2>";
                            }
                            else{
                                echo "<table width='100%' cellpadding='8'>";
                                echo "<tr>";
                                echo "<th algin='left'>Admin ID</th>";
                                echo "<th algin='left'>First Name</th>";
                                echo "<th algin='left'>Last Name</th>";
                                echo "<th algin='left'>Phone</th>";
                                echo "<th algin='left'>Admin Email</th>";
                                echo "<th algin='left' width='50px'>Password</th>";
                                echo "<th algin='left'>Address</th>";
                                echo "<th algin='left'>DOB</th>";
                                echo "<th algin='left'>Gender</th>";
                                echo "</tr>";
                                for($i=0;$i<$num_results;$i++)
                                {
                                   $row=mysqli_fetch_array($ret);
                                   $AdminID=$row["AdminID"];
                                    echo "<tr>";
                                    echo "<td>".$row["AdminID"]."</td>";
                                    echo "<td>".$row["FirstName"]."</td>";
                                    echo "<td>".$row["LastName"]."</td>";
                                    echo "<td>".$row["Phone"]."</td>";
                                    echo "<td>".$row["AdminEmail"]."</td>";
                                   
                                    echo "<td>".$row["Password"]."</td>";
                                    echo "<td>".$row["Address"]."</td>";
                                    echo "<td>".$row["DOB"]."</td>";
                                    echo "<td>".$row["Gender"]."</td>";
                                   
                                    echo "<td><a href='EditAdmin.php?AdminID=$AdminID&Mode=Update'>Edit</a>|<a href='DeleteAdmin.php?AdminID=$AdminID'>Delete</a></td>";
                                    echo "</tr>";
                                }
                                echo "</table>";        }
                            ?>
                        </td>
                    </tr>
                </table>
            </fieldset>
 		</form>
 </body>
 </html>