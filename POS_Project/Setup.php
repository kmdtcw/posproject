<?php 
	require('ConnectDB.php');
/*
	$user="Drop Table User";
	$retuser = mysqli_query($connection,$user);

	$user = "CREATE TABLE User
	(
		UserID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
		FirstName varchar (30) NOT NULL,
		LastName varchar (30) NOT NULL,
		Phone varchar (30) NOT NULL,
		UserEmail varchar (30) NOT NULL,
		Password varchar (30) NOT NULL,
		Address varchar (30) NOT NULL,
		DOB date NOT NULL,
		Gender varchar (30) NOT NULL
	)";
	$retuser = mysqli_query($connection,$user);

	if ($retuser)
	{
		echo "<p>User Table Created!</p>";
	}
	else
	{
		echo "<p>Something went wrong: " . mysqli_error($connection) . "</p>";
	}

	// Brand 

	$brand="Drop Table Brand";
	$retbrand = mysqli_query($connection,$brand);

	$brand = "CREATE TABLE Brand
	(
		BrandID int(11) NOT NULL PRIMARY KEY,
		BrandName varchar (30) NOT NULL
	)";
	$retbrand = mysqli_query($connection,$brand);

	if ($retbrand)
	{
		echo "<p>Brand Table Created!</p>";
	}
	else
	{
		echo "<p>Something went wrong: " . mysqli_error($connection) . "</p>";
	}

	//  Category
	$category="Drop Table Category";
	$retcategory = mysqli_query($connection,$category);

	$category= "CREATE TABLE Category
	(
		CategoryID int (11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
		CategoryName varchar(30) NOT NULL
	)";
	$retcategory = mysqli_query($connection,$category);

	if ($retcategory)
	{
		echo "<p>Category Table Created!</p>";
	}
	else
	{
		echo "<p>Something went wrong: " . mysqli_error($connection) . "</p>";
	}

	// Customer


	$customer="Drop Table Customer";
	$retcustomer = mysqli_query($connection,$customer);

	$customer = "CREATE TABLE Customer
	(
		CustomerID int(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
		CustomerName varchar (30) NOT NULL
	)";
	$retcustomer = mysqli_query($connection,$customer);

	if ($retcustomer)
	{
		echo "<p>Customer Table Created!</p>";
	}
	else
	{
		echo "<p>Something went wrong: " . mysqli_error($connection) . "</p>";
	}

	// Product

	$product="Drop Table Product";
	$retproduct = mysqli_query($connection,$product);
	$product = "CREATE TABLE Product
	(
		ProductID varchar(15) NOT NULL PRIMARY KEY,
		Description varchar (255) NOT NULL,
		Price int (15) NOT NULL,
		Color varchar (15) NOT NULL,
		Size varchar (15) NOT NULL,
		Path varchar (255) NOT NULL,
		Quantity int (11) NOT NULL,
		Brand varchar(30) NOT NULL,
		Category varchar (30) NOT NULL
	)";

	$retproduct = mysqli_query($connection,$product);

	if ($retproduct)
	{
		echo "<p>Product Table Created!</p>";
	}
	else
	{
		echo "<p>Something went wrong: " . mysqli_error($connection) . "</p>";
	}



		
	$order="Drop Table Orders";
	$retorder = mysqli_query($connection,$order);

	$order = "CREATE TABLE Orders
	(
		OrderID varchar(15) NOT NULL PRIMARY KEY,
		OrderDate date NOT NULL,
		CustomerID int (11) NOT NULL,
		CustomerName varchar (30) NOT NULL,
		Phone varchar (30) NOT NULL,
		Address varchar (255) NOT NULL,
		Extra varchar (30) NOT NULL,
		PayType varchar(30) NOT NULL,
		ShippingType varchar (30) NOT NULL,
		Status varchar (15) NOT NULL,
		BandCard varchar (30) NOT NULL
	)";

	$retorder = mysqli_query($connection,$order);

	if ($retorder)
	{
		echo "<p>Orders Table Created!</p>";
	}
	else
	{
		echo "<p>Something went wrong: " . mysqli_error($connection) . "</p>";
	}
*/


 ?>