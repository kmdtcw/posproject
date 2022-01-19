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
		$ProductID=$_GET['txtProductID'];
		$Quantity=$_GET['txtbuyqty'];
		Insert($ProductID,$Quantity);
	}
	elseif($action=="remove")
	{
		$ProductID=$_GET['ProductID'];
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
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Shoppping Cart</title>
</head>
<body>

</body>
<fieldset>
<legend>POS Online</legend>
<table>
	<tr>
		<td>
			<h2>Your Shopping Cart</h2>
			<hr>
		<?php 
		if(!isset($_SESSION['ShoppingCart']))
		{
			echo "<p>Your Shopping Cart is Empty </p>";
			echo "<p>Total Amount : $0</P>";
			echo "<a href='ProductDisplay.php'>Product Display</a>";
		}
		?>
		</td>
	</tr>
</table>
	<table cellpadding="3" align="center" width="100%">
		<tr>
			<td>Image</td>
			<td>Product ID</td>
			<td>Description</td>
			<td>Price</td>
			<td>Color</td>
			<td>Size</td>
			<td>Quantity</td>
			<td>Bramd</td>
			<td>Category</td>
			<td>amount</td>
			<td>Action</td>
		</tr>

		<?php 
		if(isset($_SESSION['ShoppingCart'])){


			$Size=count($_SESSION['ShoppingCart']);
			for($i=0; $i<$Size; $i++)
			{
				?>
				<tr>
					<td align="center">
						<img src="<?php echo $_SESSION['ShoppingCart'][$i]['Path']; ?>" width="150">
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
						<?php echo $_SESSION['ShoppingCart'][$i]['Quantity']*$_SESSION['ShoppingCart'][$i]['Price'];?>
					</td>

					<td>
						<a href="ShoppingCart.php?action=remove&ProductID=<?php echo $_SESSION['ShoppingCart'][$i]['ProductID'] ?>"> Remove</a>
					</td>
				</tr>

				<?php 
			}
		}
			?>
			<tr>
				<td colspan="10" align="right">
					<table>
						<tr>
							<td>
								<br>
								<h1>Total Amount&nbsp;: $ <?php echo Get_TotalAmount() ?> </h1>
								<h1>Total Quantity&nbsp;: <?php echo Get_TotalQuantity(); ?>	pcs</h1>

							<a href="ProductDisplay.php">Product Display</a>&nbsp; |
							<a href="ShoppingCart.php? action=clear">Empty Cart</a>&nbsp; |
							<a href="CheckOut.php">Check Out</a>
							</td>
						</tr>
					</table>
					
				</td>
			</tr>
		</table>
	</fieldset>
</html>