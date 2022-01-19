<?php 
	include('ConnectDB.php');

	if (isset($_POST['btnShowAll'])) 
	{
		$check="SELECT o.*,od.*,u.*,p.* 
			FROM user u, orders o, order_detail od, product p
			WHERE o.UserID=u.UserID
			AND o.OrderID=od.OrderID
			AND od.ProductID=p.ProductID
			AND o.Status='Pending'";
		$ret=mysqli_query($connection,$check);
		$count=mysqli_num_rows($ret);
	}
	elseif (isset($_POST['btnSearch'])) 
	{
		if ($_POST['rdoSearch']==1) {
			$OrderID=$_POST['cboOrder'];
			$check="SELECT o.*,od.*,u.*,p.* 
				FROM user u, orders o, order_detail od, product p
				WHERE o.UserID=u.UserID
				AND o.OrderID=od.OrderID
				AND od.ProductID=p.ProductID
				AND o.Status='Pending'
				AND o.OrderID='$OrderID'";
			$ret=mysqli_query($connection,$check);
			$count=mysqli_num_rows($ret);
		}
		elseif ($_POST['rdoSearch']==2) 
		{
			$From=$_POST['txtFrom'];
			$To=$_POST['txtTo'];
			$check="SELECT o.*,od.*,u.*,p.* 
				FROM user u, orders o, order_detail od, product p
				WHERE o.UserID=u.UserID
				AND o.OrderID=od.OrderID
				AND od.ProductID=p.ProductID
				AND o.Status='Pending'
				AND o.OrderDate BETWEEN '$From' AND '$To'";
			$ret=mysqli_query($connection,$check);
			$count=mysqli_num_rows($ret);
		}
	}
	else
	{
		$today=date('Y-m-d');
		$check="SELECT o.*,od.*,u.*,p.* 
				FROM user u, orders o, order_detail od, product p
				WHERE o.UserID=u.UserID
				AND o.OrderID=od.OrderID
				AND od.ProductID=p.ProductID
				AND o.OrderDate='$today'
				AND o.Status='Pending'";
		$ret=mysqli_query($connection,$check);
		$count=mysqli_num_rows($ret);
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<fieldset>
		<legend>Daily & Monthly Product Order Search & Report</legend>
		<form action="OrderSearch.php" method="post">
			<table>
				<tr>
					<td><input type="radio" name="rdoSearch" value="1" checked="checked">Search By OrderID | &nbsp; </td>
					<td><input type="radio" name="rdoSearch" value="2">Search By Order Date</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>
						Order ID: <br>
						<select name="cboOrder">
							<option>Choose OrderID</option>
							<?php 
								$order="SELECT DISTINCT OrderID FROM Orders ORDER BY OrderID DESC";
								$orderret=mysqli_query($connection,$order);
								$ordercount=mysqli_num_rows($orderret);
								for ($i=0; $i < $ordercount; $i++) { 
										$row1=mysqli_fetch_array($orderret);
										echo "<option>".$row1['OrderID']."</option>";
								}
							 ?>
						</select>
					</td>
					<td>
						From Date: <br>
						<input type="date" name="txtFrom">
					</td>
					<td>
						To Date: <br>
						<input type="date" name="txtTo">
					</td>
					<td>
						<br>
						<input type="submit" name="btnSearch" value="Search">
						<input type="submit" name="btnShowAll" value="Show All">
						<input type="reset" value="Clear">
					</td>
				</tr>
			</table>
		</form>
		<table align="center" width="100%">
			<tr>
				<td>
					<?php 
						if ($count==0) {
							echo "<h2>No Order Found!</h2>";
						}
						else{
					?>
							<table align="center">
								<tr>
									<th align="left">OrderID</th>
									<th align="left">Customer Name</th>
									<th align="left">Order Date</th>
									<th align="left">Product Name</th>
									<th align="left">Payment Type</th>
									<th align="left">Delivery Type</th>
									<th align="left">Status</th>
								</tr>
								<?php 
									for ($i=0; $i < $count; $i++) { 
										$row=mysqli_fetch_array($ret);
										echo "<tr>";
										echo "<td>".$row['OrderID']."</td>";
										echo "<td>".$row['CustomerName']."</td>";
										echo "<td>".$row['OrderDate']."</td>";
										echo "<td>".$row['Description']."</td>";
										echo "<td>".$row['PayType']."</td>";
										echo "<td>".$row['ShippingType']."</td>";
										echo "<td>".$row['Status']."</td>";
										echo "<td></td>";
										echo "</tr>";
									}
								 ?>
							</table>
					<?php		
						}
					 ?>
				</td>
			</tr>
		</table>
	</fieldset>
</body>
</html>