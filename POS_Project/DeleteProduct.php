<?php 
	include('ConnectDB.php');
	if (isset($_REQUEST['ProductID'])) 
	{
		$PID=$_REQUEST['ProductID'];
		$query="DELETE FROM Product WHERE ProductID='$PID'";
		$result=mysqli_query($connection,$query);
		if ($result) 
		{
			echo "<script>window.alert('Product Delete Successful');</script>";
			echo "<script>window.location='Add_Product.php';</script>";
		}
		else
		{
			echo "<script>window.alert('Product cannot delete');</script>";
			echo "<script>window.location='Add_Product.php';</script>";
		}
	}
	else
	{
		echo "<script>window.location='Add_Product.php';</script>";
	}
 ?>