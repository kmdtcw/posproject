<?php
	function AutoID($tableName,$fieldName,$prefix,$noofLeadingZeros)// Product,ProductID,P-,6
	{
		$connection =mysqli_connect("localhost","root","","posdb");
		$value=1;
		$sql="SELECT " . $fieldName . " FROM " . $tableName . " ORDER BY " . $fieldName . " DESC";
		// $sql=Select ProductID from Product Order By ProductID DESC
		$result=mysqli_query($connection,$sql);
		$noofRow=mysqli_num_rows($result);
		$row=mysqli_fetch_array($result); // P-000005
		if($noofRow<1)
		{
			return $prefix . "000001";  // P-000001
		}
		else
		{ 
			$oldID=$row[$fieldName];	// P-000005	
			$oldID=str_replace($prefix,"",$oldID); //(P-,"",P-000005) , 000005
			// str_replace(OldChar,NewChar,Data)	
			$value=(int)$oldID;	// 5		
			$value++;	// 6					
			$newID=$prefix . NumberFormatter($value,$noofLeadingZeros); 
			// $newID= P-000006
			return $newID;
		}
	}
	function NumberFormatter($number,$n) // 6, 6
	{
		return str_pad((int) $number,$n,"0",STR_PAD_LEFT); // 000006
						
	}
?>