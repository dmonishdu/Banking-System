<?php
require_once "db.php";
require_once "function.php";

class Event
{	
	public function userLogin($uname,$pwd){

		$db = new dataBase;
		$db->makeConnection();
		 $sql = "SELECT * FROM successaccount WHERE Email='".$uname."' AND Password='".$pwd."' limit 1";
		$result = $db->query($sql);
		$db->close();
		if(mysqli_num_rows($result)==1)
			{return true;}
	}

	public function addStaff($email,$name,$userName,$password,$dob,$doj,$image)
	{
	
		$db = new dataBase;
		$db->makeConnection();
		$sql = "INSERT INTO Staff(userName,password,name,email,dob,doj,image) values('$userName','$password','$name','$email','$dob','$doj' ,'$image' )";
		$result = $db->query($sql);
		$db->close();
		if ($result)
		return true;
	}
	public function getstaff()
	{
		$db = new dataBase;
		$db->makeConnection();
		$sql = "SELECT * FROM Staff ";
		$result = $db->query($sql);
		$db->close();	
		$events = array();
		$row = $result->fetch_assoc();
		while ($row) 
		{
			array_push($events, $row);
			$row = $result->fetch_assoc();
		}
		return $events;
	}
	public function GetStaffByuserName($UserName)
	{
		$db = new dataBase;
		$db->makeConnection();
		$sql = "SELECT * FROM staff WHERE userName='$UserName'";
		$result = $db->query($sql);
		$db->close();
				$events = array();
		$row = $result->fetch_assoc();
		while ($row) 
		{
			array_push($events, $row);
			$row = $result->fetch_assoc();
		}
		return $events;	
		
	}
	public function updateStaff($oldName,$email,$name,$password,$dob,$doj,$store){

		$db = new dataBase;
		$db->makeConnection();
		 $sql = "UPDATE staff SET email ='$email',name ='$name',password ='$password',dob ='$dob',doj ='$doj',image='$store' WHERE userName ='$oldName'";
		$result = $db->query($sql);
		$db->close();
		if ($result){return true;}
	}
	public function deleteStaff($userName)
	{
		$db = new dataBase;
		$db->makeConnection();
		$sql = "DELETE FROM Staff WHERE userName='$userName'";
		$result = $db->query($sql);
		$db->close();
		if ($result){return true;}
	}

	public function addCustomer($userName,$dob,$email,$password)
	{
		$db = new dataBase;
		$db->makeConnection();
		$sql = "INSERT INTO customer(userName,email,password,dob) values('$userName','$email','$password','$dob')";
		$result = $db->query($sql);
		$db->close();
		if ($result)
		return true;
	}
	public function getCustomer()
	{
		$db = new dataBase;
		$db->makeConnection();
		$sql = "SELECT * FROM customer ";
		$result = $db->query($sql);
		$db->close();	
		$events = array();
		$row = $result->fetch_assoc();
		while ($row) 
		{
			array_push($events, $row);
			$row = $result->fetch_assoc();
		}
		return $events;
	}
	public function GetCustomerByuserName($UserName)
	{
		$db = new dataBase;
		$db->makeConnection();
		$sql = "SELECT * FROM customer WHERE userName='$UserName'";
		$result = $db->query($sql);
		$db->close();
				$events = array();
		$row = $result->fetch_assoc();
		while ($row) 
		{
			array_push($events, $row);
			$row = $result->fetch_assoc();
		}
		return $events;	
		
	}
	public function updateCustomer($oldName,$dob,$email,$password){

		$db = new dataBase;
		$db->makeConnection();
		 $sql = "UPDATE customer SET email ='$email',password ='$password',dob ='$dob' WHERE userName ='$oldName'";
		$result = $db->query($sql);
		$db->close();
		if ($result){return true;}
	}
	public function deleteCustomer($userName)
	{
		$db = new dataBase;
		$db->makeConnection();
		$sql = "DELETE FROM customer WHERE userName='$userName'";
		$result = $db->query($sql);
		$db->close();
		if ($result){return true;}
	}
	public function StaffLogin($uname,$pwd){

		$db = new dataBase;
		$db->makeConnection();
		 $sql = "SELECT * FROM staff WHERE userName='".$uname."' AND Password='".$pwd."' limit 1";
		$result = $db->query($sql);
		$db->close();
		if ($result){return true;}
	}
	public function AccountRequest($name,$Fname,$Mname,$dob,$houseNo,$street,$pinCode,$postOffice,$district,$state,$panNo,$aadhaarNo,$mobNo,$faxNo,$email,$nameN,$aadhaarN,$dobN)
	{	$db = new dataBase;
		$db->makeConnection();
		$sql = "INSERT INTO account(Name,FatherName,MotherName,Dob,Street,PinCode,PostOffice,District,State,HouseNo,PanNo,MobileNo,FaxNo,Email,NomineeName,NomineeAadhaar,NomineeDob,AadhaarNo)
		 values('$name','$Fname','$Mname','$dob','$street','$pinCode','$postOffice',
		 '$district','$state','$houseNo','$panNo','$mobNo','$faxNo','$email','$nameN','$aadhaarN','$dobN','$aadhaarNo')";
		$result = $db->query($sql);
		$db->close();
		if ($result)
		return true;
	}
	public function GetAccountRequest()
	{
		$db = new dataBase;
		$db->makeConnection();
		$sql = "SELECT * FROM account";
		$result = $db->query($sql);
		$db->close();
		$events = array();
		$row = $result->fetch_assoc();
		while ($row) 
		{
			array_push($events, $row);
			$row = $result->fetch_assoc();
		}
		return $events;	
		
	}

public function DeleteAccountRequest($id)
	{
		$db = new dataBase;
		$db->makeConnection();
		$sql = "DELETE FROM account WHERE Email ='$id'";
		$result = $db->query($sql);
		$db->close();
		if ($result){return true;}
	}
	public function GetAccountRequestId($id)
	{
		$db = new dataBase;
		$db->makeConnection();
		$sql = "SELECT * FROM account WHERE Email ='$id'";
		$result = $db->query($sql);
		$db->close();
				$events = array();
		$row = $result->fetch_assoc();
		while ($row) 
		{
			array_push($events, $row);
			$row = $result->fetch_assoc();
		}
		return $events;	
		
	}
	public function OpenAccount($Password,$name,$Fname,$Mname,$dob,$houseNo,$street,$pinCode,$postOffice,$district,$state,$panNo,$aadhaarNo,$mobNo,$faxNo,$email,$nameN,$aadhaarN,$dobN,$accountNo)
	{	$db = new dataBase;
		$db->makeConnection();

		$sql = "INSERT INTO successaccount(Name,FatherName,MotherName,Dob,Street,PinCode,PostOffice,District,State,HouseNo,PanNo,MobileNo,FaxNo,Email,NomineeName,NomineeAadhaar,NomineeDob,AadhaarNo,Password,AccountNo)
		 values('$name','$Fname','$Mname','$dob','$street','$pinCode','$postOffice',
		 '$district','$state','$houseNo','$panNo','$mobNo','$faxNo','$email','$nameN','$aadhaarN','$dobN','$aadhaarNo','$Password','$accountNo')";
		$result = $db->query($sql);
		$db->close();
		if ($result)
		return true;
	}

	public function UserDetailById($email){

		$db = new dataBase;
		$db->makeConnection();
		$sql = "SELECT * FROM successaccount WHERE Email ='$email'";
		$result = $db->query($sql);
		$db->close();
				$events = array();
		$row = $result->fetch_assoc();
		while ($row) 
		{
			array_push($events, $row);
			$row = $result->fetch_assoc();
		}
		return $events;	
	}

}

?>