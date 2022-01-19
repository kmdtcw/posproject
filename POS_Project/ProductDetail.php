<?php
	session_start();
	include('ConnectDB.php');
	if (isset($_REQUEST['ProductID']))
	{
		$ProductID=$_REQUEST['ProductID'];
		$query="SELECT * FROM Product WHERE ProductID='$ProductID'";
		$ret=mysqli_query($connection,$query);
		$row=mysqli_fetch_array($ret);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welcome :
		<?php
			if(isset($_SESSION['UserID']))
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
	<form action="ShoppingCart.php" method="get">
		<input type="hidden" name="txtProductID" value="<?php echo $row['ProductID']; ?>">
		<input type="hidden" name="action" value="buy">
		<fieldset>
			<legend><?php echo $row['Description']; ?> Product Detail</legend>
			<table>
				<tr>
					<td>
						<img src="<?php echo $row['Path']; ?>" width="200" height='200'>
					</td>
					<td>
						<table>
							<tr>
								<td>Description:</td>
								<td><b><?php echo $row['Description'];?> </b></td>
							</tr>

							<tr>
								<td>Brand:</td>
								<td><b><?php echo $row['Brand'];?></b></td>
							</tr>

							<tr>
								<td>Category:</td>
								<td><b><?php echo $row['Category'];?></b></td>
							</tr>

							<tr>
								<td>Color</td>
								<td><b><?php echo $row['Color'];?></b></td>
							</tr>

							<tr>
								<td>Size</td>
								<td><b><?php echo $row['Size'];?></b></td>
							</tr>

							<tr>
								<td>Price</td>
								<td><b><?php echo $row['Price'];?></b></td>
							</tr>

							<tr>
								<td>Quantity</td>
								<td><?php if (
									$row['Quantity']<=0)
									{
										echo "<b>Out of Stock</b>";
									}
									else{
									?>
									<b>Inventory Qty" [<?php echo $row['Quantity']?>]</b><br>
									<input type="number" name="txtbuyqty" placeholder="Enter Buy Quantity" required>
									<?php
								}
								?>
								
									
									
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<?php
										if ($row['Quantity']<=0)
										{
										echo "<a href='ProductDisplay.php'>Back</a>";	
										}
										else
										{
											?>
											<input type="submit" name="btnADD" value="Add to Cart">
											<?php 
										}
										?>
								</td>
							</tr>

						</table>
						
					</td>
				</tr>
			</table>
		</fieldset>
	</form>
</body>
</html>