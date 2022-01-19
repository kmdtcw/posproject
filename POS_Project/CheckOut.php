<?php 
	session_start();
	include('AutoIDFunction.php');
	include('ShoppingCartFunction.php');
	include('ConnectDB.php');
	if (!isset($_SESSION['UserID'])) 
	{
		echo "<script>alert('Please Login First');</script>";
		echo "<script>window.location='CustomerLogin.php'</script>";
	}
	if (isset($_POST['btnCheckout'])) 
	{
		$OrderID=$_POST['txtOrderID'];
		$odate=$_POST['txtOrderDate'];
		$OrderDate=date('Y-m-d',strtotime($odate));
		$CustomerID=$_SESSION['UserID'];
		$CustomerName=$_POST['txtUserName'];
		$Phone=$_POST['txtPhone'];
		$Address=$_POST['txtAddress'];
		$ShippingType=$_POST['rdoShippingType'];
		$PayType=$_POST['rdoPayType'];
		$Status="Pending";
		if ($_POST['rdoShippingType']=='SameDay') 
		{
			$totalamount=$_POST['txtTotalAmount'];
			$extra=$totalamount+1000;
		}
		else
		{
			$extra=$_POST['txtTotalAmount'];
		}
		if ($_POST['txtbankcard']='') 
		{
			$bandcard='Not Paid With Card';
		}
		else
		{
			$bandcard=$_POST['txtbankcard'];
		}
		$OrderInsert="INSERT INTO Orders VALUES('$OrderID','$OrderDate','$CustomerID','$CustomerName','$Phone','$Address','$extra','$PayType','$ShippingType','$Status','$bandcard')";
		$ret=mysqli_query($connection,$OrderInsert);
		$size=count($_SESSION['ShoppingCart']);
		for ($i=0; $i < $size; $i++) 
		{ 
			$ProductID=$_SESSION['ShoppingCart'][$i]['ProductID'];
			$Quantity=$_SESSION['ShoppingCart'][$i]['Quantity'];
			$Price=$_SESSION['ShoppingCart'][$i]['Price'];
			$Amount=$_SESSION['ShoppingCart'][$i]['Quantity']*$_SESSION['ShoppingCart'][$i]['Price'];
			$OrderDetailInsert="INSERT INTO Order_Detail VALUES('$OrderID','$ProductID','$Quantity','$Price','$Amount')";
			$ret=mysqli_query($connection,$OrderDetailInsert);

			$UpdateQuantity="UPDATE Product SET
							Quantity=Quantity-'$Quantity'
							WHERE ProductID='$ProductID'";
			$ret1=mysqli_query($connection,$UpdateQuantity);
		}
		unset($_SESSION['ShoppingCart']);
		echo "<script>alert('Checkout Prcess Complete');</script>";
		//echo "<script>window.location='Print.php'</script>";
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Check Out</title>
	<script type="text/javascript">
		function show()
		{
			document.getElementById('bandcard').style.display='block';
		}
		function hide()
		{
			document.getElementById('bandcard').style.display='none';
		}
	</script>
</head>
<body>
	<fieldset>
		<legend>POS Online</legend>
		<form action="CheckOut.php" method="POST">
			<table align="center">
				<tr>
					<td>OrderID :</td>
					<td><input type="text" name="txtOrderID" value="<?php echo AutoID('Orders','OrderID','OR-',6) ?>"></td>
				</tr>
				<tr>
					<td>Order Date :</td>
					<td><input type="text" name="txtOrderDate" value="<?php echo date('d-M-Y'); ?>" readonly></td>
				</tr>
				<tr>
					<td>UserName :</td>
					<td><input type="text" name="txtUserName" value="<?php echo $_SESSION['FirstName'].' '.$_SESSION['LastName'] ?>"></td>
				</tr>
				<tr>
					<td>Total Amount</td>
					<td><input type="text" name="txtTotalAmount" value="<?php echo Get_TotalAmount() ?>"></td>
				</tr>
				<tr>
					<td>Total Quantity</td>
					<td><input type="text" name="txtTotalQuantity" value="<?php echo Get_TotalQuantity() ?>"></td>
				</tr>
				<tr>
					<td>Payment Option :</td>
					<td>
						<input type="radio" name="rdoPayType" value="CashOnDelivery" onClick="hide();"> Cash On Delivery <br>
						<input type="radio" name="rdoPayType" value="BankTransfer" onClick="hide();"> Bank Transfer <br>
						<input type="radio" name="rdoPayType" value="MyanPay" onClick="show();"> MyanPay <br>
						<input type="radio" name="rdoPayType" value="Visa/Master" onClick="show();"> Visa/Master Card <br>
						<input type="text" name="txtbankcard" id="bandcard" placeholder="Bank Card Info">
					</td>
				</tr>
				<tr>
					<td>Delivery Option :</td>
					<td><input type="radio" name="rdoShippingType" value="Free">Free Delivery(0 KS)
						<br>
						<input type="radio" name="rdoShippingType" value="SameDay">Same Day Delivery (1000KS)</td>
				</tr>
				<tr>
					<td>Delivery Address :</td>
					<td>
						<textarea name="txtAddress" placeholder="Enter Address"></textarea>
					</td>
				</tr>
				<tr>
					<td>Deliver Phone No :</td>
					<td><input type="text" name="txtPhone" placeholder="Enter Phone No"></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" name="btnCheckout" value="CheckOut">
						<input type="reset" value="Cancel Order">
					</td>
				</tr>
			</table>
		</form>
	</fieldset>
</body>
</html>