<?php
	include('ConnectDB.php');
	include('AutoIDFunction.php');
	if(isset($_POST['btnsave']))
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
		if ($image)
		{
			$filename=$folder.$pid."_".$image;
			$copied=copy($_FILES['txtpath']['tmp_name'], $filename);
			if(!$copied)
			{
				exit("Problem occured.");
			}
		}


		$checkpoint="SELECT * FROM Product WHERE ProductID='$pid'";
		$ret=mysqli_query($connection,$checkpoint);
		$count=mysqli_num_rows($ret);
		if($count>0)
		{
			echo "<script>window.alert('ProductID is Already Exits');</script>";
			echo "<script>window.location='Add_Product.php';</script>";
		}
		else
		{
			$insertproduct="INSERT INTO Product VALUES('$pid','$description','$price','$color','$size','$filename','$quantity','$brand','$category')";
			$ret=mysqli_query($connection,$insertproduct);
			if($ret)
			{
				echo "<script>window.alert('Successfully Add Product!');</script>";
				echo "<script>window.location='Add_Product.php';</script>";
			}
			else
			{
				echo "<p>Error in Product Page:".mysqli_error($connection)."</p>";
			}
		}
	}
?>



<!DOCTYPE html>
<html>
	<head>
	<title>Product Entry</title>
	</head>
	<body>
		<fieldset>
			<legend>Product Information Here : </legend>
			<form action="Add_Product.php" method="post" enctype="multipart/form-data">
				<table align="center" cellpadding="5">
					<tr>
						<td>Product ID:</td>
						<td>
							<input type="text" name="txtproductid" value="<?php echo AutoID('Product','ProductID','P-',6); ?>" required>
						</td>
					</tr>
					<tr>
						<td>Description:</td>
						<td>
							<input type="text" name="txtdescription" placeholder="Enter Product Description" required>
						</td>
					</tr>
					<tr>
						<td>Price:</td>
						<td>
							<input type="text" name="txtprice" placeholder="Enter Product Price" required>
						</td>
					</tr>
					<tr>
						<td>Color:</td>
						<td>
							<input type="text" name="txtcolor" placeholder="Enter Product Color" required>
						</td>
					</tr>
					<tr>
						<td>Size:</td>
						<td>
							<input type="text" name="txtsize" placeholder="Enter Product Size" required>
						</td>
					</tr>
					<tr>
						<td>Path:</td>
						<td>
							<input type="file" name="txtpath" required>
						</td>
					</tr>
					<tr>
						<td>Quantity:</td>
						<td>
							<input type="text" name="txtquantity" placeholder="Enter Product Quantity" required>
						</td>
					</tr>
					<tr>
						<td>Brand:</td>
						<td>
							<select name="txtbrand">
								<option>-Select Brand-</option>
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
						<td>Category</td>
						<td>
							<select name="txtcategory">
								<option>-Select Category-</option>
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
								if(isset($_GET['Mode']))
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

				<fieldset>
					<legend>Product Listing</legend>
					<table width="100%" cellpadding="7">
						<tr>
							<td>
								<?php
									$query="SELECT * From Product ORDER BY ProductID";
									$ret=mysqli_query($connection,$query);
									$num_results=mysqli_num_rows($ret);
									if($num_results==0)
									{
										echo "<h2>No Record Found</h2>";
									}
									else
									{
										echo "<table align='center' width='100%' cellpadding='8'>";
										echo "<tr>";
										echo "<th align='left'>ProductID</th>";
										echo "<th align='left'>Description</th>";
										echo "<th align='left'>Price</th>";
										echo "<th align='left'>Color</th>";
										echo "<th align='left'>Size</th>";
										echo "<th align='left'>Path</th>";
										echo "<th align='left'>Quantity</th>";
										echo "<th align='left'>Brand</th>";
										echo "<th align='left'>Category</th>";
										echo "<th align='left'>Action</th>";
										echo "</tr>";

										for($i=0; $i<$num_results; $i++)
										{
											$row=mysqli_fetch_array($ret);
											$ProductID=$row['ProductID'];
											$ProductImage=$row['Path'];
											echo "<tr>";
											echo "<td>".$row['ProductID']."</td>";
											echo "<td>".$row['Description']."</td>";
											echo "<td>".$row['Price']."</td>";
											echo "<td>".$row['Color']."</td>";
											echo "<td>".$row['Size']."</td>";
											echo "<td><img src='$ProductImage' width='100px' height='100px'/></td>";
											echo "<td>".$row['Quantity']."</td>";
											echo "<td>".$row['Brand']."</td>";
											echo "<td>".$row['Category']."</td>";
											echo "<td><a href='Edit_Product.php?ProductID=$ProductID&Mode=Update'>Edit</a>|
											<a href='DeleteProduct.php?ProductID=$ProductID'>Delete</a></td>";
											echo "</tr>";
										}
										echo "</table>";
									}
								?>
							</td>
						</tr>
					</table>
				</fieldset>
			</form>
		</fieldset>
	</body>
</html>