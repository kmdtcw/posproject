<?php 
	include('ConnectDB.php');
	if (isset($_POST['btnupdate'])) 
	{
		$pid=$_POST['txtproductid'];
		$description=$_POST['txtdescription'];
		$price=$_POST['txtprice'];
		$color=$_POST['txtcolor'];
		$size=$_POST['txtsize'];
		$quantity=$_POST['txtquantity'];
		$brand=$_POST['txtbrand'];
		$category=$_POST['txtcategory'];
		
		$image=$_FILES['txtpath']['name'];
		$folder="Images/";
		if($image) 
		{
			$filename=$folder.$pid."_".$image; // Images/P-000002_Lenovo1.png
			$copied=copy($_FILES['txtpath']['tmp_name'], $filename);
			if (!$copied) 
			{
				exit("Problem occured.");
			}
		}

		$Update="UPDATE Product SET 
		         Description='$description',
		         Price='$price',
		         Color='$color',
		         Size='$size',
		         Quantity='$quantity',
		         Brand='$brand',
		         Category='$category'
		         WHERE ProductID='$pid'";
		$result=mysqli_query($connection,$Update);
		if ($result) 
		{
			echo "<script>window.alert('Product Update Successful');</script>";
			echo "<script>window.location='Add_Product.php';</script>";
		}
		else
		{
			echo "<script>window.alert('Product Cannot Update');</script>";
			echo "<script>window.location='Add_Product.php';</script>";
		}
	}


	if(isset($_GET['ProductID'])) 
	{
		$ProductID=$_GET['ProductID']; // P-000002
		$query="SELECT * FROM Product WHERE ProductID='$ProductID'";
		$ret=mysqli_query($connection,$query);
		$arr=mysqli_fetch_array($ret);
	}
	else
	{
		echo "<script>window.alert('Please Choose ProductID.');</script>";
		echo "<script>window.location='Add_Product.php';</script>";
	}
 ?>

<html>
	<head>
		<title>Edit Product</title>
	</head>
	<body>
		<form action="Edit_Product.php" method="POST">
			<table align="center" cellpadding="5">
					<tr>
						<td>Product ID</td>
						<td>
							<input type="text" name="txtproductid" value="<?php echo $arr['ProductID']; ?>" required>
						</td>
					</tr>
					<tr>
						<td>Description:</td>
						<td>
							<input type="text" name="txtdescription" value="<?php echo $arr['Description']; ?>" required>
						</td>
					</tr>
					<tr>
						<td>Price:</td>
						<td>
							<input type="text" name="txtprice" value="<?php echo $arr['Price']; ?>" required>
						</td>
					</tr>
					<tr>
						<td>Color:</td>
						<td>
							<input type="text" name="txtcolor" value="<?php echo $arr['Color']; ?>" required>
						</td>
					</tr>
					<tr>
						<td>Size:</td>
						<td>
							<input type="text" name="txtsize" value="<?php echo $arr['Size']; ?>" required>
						</td>
					</tr>
					<tr>
						<td>Path:</td>
						<td><input type="file" name="txtpath" required></td>
					</tr>
					<tr>
						<td>Quantity:</td>
						<td><input type="text" name="txtquantity" value="<?php echo $arr['Quantity']; ?>" required></td>
					</tr>
					<tr>
						<td>Brand:</td>
						<td>
							<select name="txtbrand">
								<option><?php echo $arr['Brand']; ?></option>
								<?php 
									$brandselect="SELECT DISTINCT BrandName From Brand";
									$brandret=mysqli_query($connection,$brandselect);
									$brandcount=mysqli_num_rows($brandret);
									for ($i=0; $i < $brandcount; $i++) 
									{ 
										$row=mysqli_fetch_array($brandret);
										$brandname=$row['BrandName'];
										echo "<option>$brandname</option>";
									}
								 ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Category:</td>
						<td>
							<select name="txtcategory">
								<option><?php echo $arr['Category']; ?></option>
								<?php 
									$categoryselect="SELECT DISTINCT CategoryName From Category";
									$categoryret=mysqli_query($connection,$categoryselect);
									$categorycount=mysqli_num_rows($categoryret);
									for ($i=0; $i < $categorycount; $i++)
									{ 
										$row=mysqli_fetch_array($categoryret);
										$categoryname=$row['CategoryName'];
										echo "<option>$categoryname</option>";
									}
								 ?>
							</select>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<?php 
								if (isset($_GET['Mode'])) 
								{
									echo "<input type='submit' name='btnupdate' value='Update'>";
								}
								else
								{
									echo "<input type='submit' name='btnsave' value='Save'>";
								}
							 ?>
							 <input type="reset" name="btncancel" value="Cancel">
						</td>
					</tr>
				</table>
		</form>
	</body>
</html>