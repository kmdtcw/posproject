<?php 
	function Insert($ProductID,$Quantity) // P-000006 , 3
	{
		include('ConnectDB.php');
		$query="SELECT * FROM Product WHERE ProductID='$ProductID'";
		$result=mysqli_query($connection,$query);
		if (mysqli_num_rows($result)<1) 
		{
			return false;
		}
		$row=mysqli_fetch_array($result);
		$Description=$row['Description'];
		$Price=$row['Price'];
		$Color=$row['Color'];
		$Size=$row['Size'];
		$Path=$row['Path'];
		$TotalQuantity=$row['Quantity'];
		$Brand=$row['Brand'];
		$Category=$row['Category'];

		if ($Quantity>$TotalQuantity) 
		{
			echo "<script>alert('Please Enter Correct Quantity');</script>";
			echo "<script>window.location='ProductDetail.php?ProductID=".$ProductID."'</script>";
		}
		if ($Quantity==0) 
		{
			echo "<script>alert('Please Enter Correct Quantity');</script>";
			echo "<script>window.location='ProductDetail.php?ProductID=".$ProductID."'</script>";
		}
		
		if (isset($_SESSION['ShoppingCart'])) 
		{
			$index=IndexOf($ProductID);
			if ($index==-1) 
			{
				$size=count($_SESSION['ShoppingCart']);
				$_SESSION['ShoppingCart'][$size]['ProductID']=$ProductID;
				$_SESSION['ShoppingCart'][$size]['Description']=$Description;
				$_SESSION['ShoppingCart'][$size]['Price']=$Price;
				$_SESSION['ShoppingCart'][$size]['Color']=$Color;
				$_SESSION['ShoppingCart'][$size]['Size']=$Size;
				$_SESSION['ShoppingCart'][$size]['Path']=$Path;
				$_SESSION['ShoppingCart'][$size]['Quantity']=$Quantity;
				$_SESSION['ShoppingCart'][$size]['Brand']=$Brand;
				$_SESSION['ShoppingCart'][$size]['Category']=$Category;
			}
			else
			{
				$_SESSION['ShoppingCart'][$index]['Quantity']+=$Quantity;
			}
		}
		else
		{
			$_SESSION['ShoppingCart']=array();			
			$_SESSION['ShoppingCart'][0]['ProductID']=$ProductID;
			$_SESSION['ShoppingCart'][0]['Description']=$Description;
			$_SESSION['ShoppingCart'][0]['Price']=$Price;
			$_SESSION['ShoppingCart'][0]['Color']=$Color;
			$_SESSION['ShoppingCart'][0]['Size']=$Size;
			$_SESSION['ShoppingCart'][0]['Path']=$Path;
			$_SESSION['ShoppingCart'][0]['Quantity']=$Quantity;
			$_SESSION['ShoppingCart'][0]['Brand']=$Brand;
			$_SESSION['ShoppingCart'][0]['Category']=$Category;

		}
	}


	function IndexOf($ProductID)
	{
		if (!isset($_SESSION['ShoppingCart'])) 
		{
			return -1;
		}

		$size=count($_SESSION['ShoppingCart']);
		if ($size==0) 
		{
			return -1;
		}

		for ($i=0; $i < $size; $i++) 
		{ 
			if ($ProductID==$_SESSION['ShoppingCart'][$i]['ProductID']) 
			{
				return $i;
			}
		}
		return -1;
	}

	function Remove($ProductID)
	{
		$index=IndexOf($ProductID);
		if ($index>-1) 
		{
			unset($_SESSION['ShoppingCart'][$index]);
		}
		$_SESSION['ShoppingCart']=array_values($_SESSION['ShoppingCart']);
		echo "<script>window.location='ShoppingCart.php';</script>";
	}

	function Get_TotalAmount()
	{
		if (!isset($_SESSION['ShoppingCart'])) 
		{
			return 0;
		}
		$total=0;
		$size=count($_SESSION['ShoppingCart']);
		for ($i=0; $i < $size; $i++) 
		{ 
			$Quantity=$_SESSION['ShoppingCart'][$i]['Quantity'];
			$Price=$_SESSION['ShoppingCart'][$i]['Price'];
			$total=$total+($Quantity*$Price);
		}
		return $total;
	}

	function Get_TotalQuantity()
	{
		if (!isset($_SESSION['ShoppingCart'])) 
		{
			return 0;
		}
		$totalqty=0;
		$size=count($_SESSION['ShoppingCart']);
		for ($i=0; $i < $size; $i++) 
		{ 
			$Quantity=$_SESSION['ShoppingCart'][$i]['Quantity'];
			$totalqty=$totalqty+$Quantity;
		}
		return $totalqty;
	}


	function Clear()
	{
		unset($_SESSION['ShoppingCart']);
		echo "<script>window.location='ShoppingCart.php';</script>";
	}
 ?>