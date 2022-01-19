<?php 
	session_start();
	include('ConnectDB.php');
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome :
		<?php 
			if (isset($_SESSION['UserID'])) 
			{
				echo $_SESSION['FirstName'];
			}
			else
			{
				echo "Guest";
			}
		 ?>
	</title>
</head>
<body>
	<form action="ProductDisplay.php" method="POST">
		<input type="text" name="txtsearch" placeholder="Search Name/Brand/Price...">
		<input type="submit" name="btnsearch" value="Search">
		
	</form>
	<fieldset>
		<legend>Product List:</legend>
		<table align="center" width="100%">
			<?php 
				if (isset($_POST['btnsearch']))
				{
					$data=$_POST['txtsearch'];

					$searchdata="SELECT * FROM Product 
					WHERE Description = '$data'
					OR Price = '$data'
					OR Brand = '$data'
					OR Category = '$data'
					ORDER BY Description";
					$ret=mysqli_query($connection,$searchdata);
					$num_result=mysqli_num_rows($ret);
					if ($num_result==0) 
					{
						echo "<p>No Match Found</p>";
					}
					else
					{
						for ($a=0; $a < $num_result; $a+=4) 
						{ 
							$num_result1=mysqli_num_rows($ret);
							echo "<tr>";
							for ($b=0; $b < $num_result1; $b++) 
							{ 
								$row=mysqli_fetch_array($ret);
							?>
								<td>
									<img src="<?php echo $row['Path']; ?>" width='200' height='200'>
									<br>
									<b><?php echo $row['Description']; ?></b>
									<br>
									<b><?php echo $row['Price']; ?></b>
									<br>
									<a href="ProductDetail.php?ProductID=<?php echo $row['ProductID']; ?>">Detial</a>
								</td>

							<?php
							}
							echo "</tr>";
						}
					}
				}
				else
				{
					$searchdata1="SELECT * FROM Product ORDER BY Description";
					$ret1=mysqli_query($connection,$searchdata1);
					$num_result1=mysqli_num_rows($ret1); // 8

					// start=0; end<8; in 4
					for ($c=0; $c < $num_result1; $c+=4) 
					{ 
						$product1="SELECT * FROM Product ORDER BY Description LIMIT $c,4";
						// 0,4  4,4   8,4
						$retp1=mysqli_query($connection,$product1);
						$num_result2=mysqli_num_rows($retp1);// 4
						echo "<tr>";
							for ($d=0; $d < $num_result2; $d++) 
							{ 
								$row1=mysqli_fetch_array($retp1);
							?>
								<td>
									<img src="<?php echo $row1['Path']; ?>" width='200' height='200'>
									<br>
									<b><?php echo $row1['Description']; ?></b>
									<br>
									<b><?php echo $row1['Price']; ?></b>
									<br>
									<a href="ProductDetail.php?ProductID=<?php echo $row1['ProductID']; ?>">Detial</a>
								</td>

							<?php
							}
						echo "</tr>";
					}
				}
				

			 ?>
		</table>
	</fieldset>
</body>
</html>