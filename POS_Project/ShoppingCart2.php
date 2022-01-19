<?php
	session_start();
	include('ShoppingCartFunction.php');
	if(isset($_GET['action']))
	{
		$action=$_GET['action'];
	}
	else
	{
		$action="";
	}
	if ($action=="buy")
	{
	//	$ProductID=$_GET['ProductID'];
		$ProductID=$_GET['txtProductID'];
		$Quantity=$_GET['txtbuyqty'];
		Insert($ProductID,$Quantity);
	}
	elseif($action=="remove")
	{
		$ProductID=$_GET['ProductID'];
	//	$ProductID=$_GET['txtProductID'];
		Remove($ProductID);
	}
	elseif($action=="clear")
	{
		Clear();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Shopping Cart</title>
	</head>
	<body>
		<fieldset>
			<legend>POS Online</legend>
			<table cellpadding="3" align="center" width="100%"> 
			<?php
				if(!isset($_SESSION['ShoppingCart']))
				{
			?>
					<tr>
						<td>
						<h2>Your Shopping Cart</h2>
						<hr>
							<?php
							echo "<p>Your Shopping Cart is Empty</p>";
							echo "<p>Total Amount:$0</p>";
							echo "<a href='ProductDisplay.php'>Product Display</a>"; 
							?>
						</td>
					</tr>
					<?php
				}
				else
				{
					?>
				<tr>
					<th>Image</th>
					<th>ProductID</th>
					<th>Description</th>
					<th>Price</th>
					<th>Color</th>
					<th>Size</th>
					<th>Quantity</th>
					<th>Brand</th>
					<th>Category</th>
					<th>Amount</th>
					<th>Action</th>
				</tr>
			<?php
			$size=count($_SESSION['ShoppingCart']);
			for ($i=0; $i < $size; $i++)
			{
			?>
			<tr>
			<td align="center">
			<img src="<?php echo $_SESSION['ShoppingCart'][$i]['Path'];?>" width="150" heignt="150">
			</td>
			<td>
			<?php echo $_SESSION['ShoppingCart'][$i]['ProductID'];?>
			</td>
			<td>
			<?php echo $_SESSION['ShoppingCart'][$i]['Description'];?>
			</td>
			<td>
			<?php echo $_SESSION['ShoppingCart'][$i]['Price'];?>
			</td>
			<td>
			<?php echo $_SESSION['ShoppingCart'][$i]['Color'];?>
			</td>
			<td>
			<?php echo $_SESSION['ShoppingCart'][$i]['Size'];?>
			</td>
			<td>
			<?php echo $_SESSION['ShoppingCart'][$i]['Quantity'];?>
			</td>
			<td>
			<?php echo $_SESSION['ShoppingCart'][$i]['Brand'];?>
			</td>
			<td>
			<?php echo $_SESSION['ShoppingCart'][$i]['Category'];?>
			</td>
			<td>
			$<?php echo $_SESSION['ShoppingCart'][$i]['Quantity']*$_SESSION['ShoppingCart'][$i]['Price'];?>
			</td>
			<td>
			<a href="ShoppingCart.php? action=remove&ProductID=<?php echo $_SESSION['ShoppingCart'][$i]['ProductID'];?>">Remove</a>
			</td>
			</tr> <?php
			}
			?>
			<tr>
			<td colspan="10" align="right">
			<table>
				<tr>
					<td>
						<br>
						<h1>Total Amount&nbsp;&nbsp;:$<?php echo Get_TotalAmount()?></h1>
						<h1>Total Quantity&nbsp; :$<?php echo Get_TotalQuantity()?></h1>
						<hr>
						<a href="ProductDisplay.php?">Product Display</a>&nbsp; |
						<a href="ShoppingCart.php? action=clear">Empty Cart</a>&nbsp;|
						<a href="CheckOut.php?">Check Out</a>
					</td>
				</tr>
			</table>
			</td>
			</tr>
			<?php
			}
			?>
			</table>
		</fieldset>
	</body>
</html>

