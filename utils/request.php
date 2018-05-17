 <?php
use PHPMailer\PHPMailer\PHPMailer;
require '../vendor/autoload.php';
require_once "db.php";
require_once "function.php";
require_once "event.php";

if (isset($_POST['sendMail'])) 
{
 	$userMail=$_POST['email'];
 	$userName=$_POST['userName'];
 	$Message=$_POST['query'];
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->isHTML(false);
	$mail->SMTPDebug = 0;
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	$mail->Username = "mohdmonishksg@gmail.com";
	$mail->Password = "monish123@";
	$mail->setFrom('mohdmonishksg@gmail.com');
	$mail->addAddress($userMail,$userName);
	$mail->Subject = 'Email Coming From Php Project';
	$mail->Body = 'Name : ' . $userName . " \n";
	$mail->Body = $mail->Body . 'Email : ' . $userMail . " \n\n";
	$mail->Body = $mail->Body . 'Message : ' . $Message;
	if (!$mail->send()) 
	{
	    echo "<h1> Error Message: " . $mail->ErrorInfo."</h1>";
	    header("refresh:5; url=/");
	}
	else
	{
	  //  echo "<h1>Email hes been succesfully sent! we will contact soon. Thanku! </h1>	";
	    header("Location: /");
	}
}elseif (isset($_POST['userLogin'])) {
	$userName = $_POST['userName'];
	$Password = $_POST['Password'];
	$event = new Event;
	if($event->userLogin($userName,$Password))
	{
	$event = null;
	header("Location: /userLogin/?email=$userName");
		exit;
	}else{
		echo "Invalid Username or password";
	}

	
}

elseif (isset($_POST['adminLogin'])) {
	$userName = $_POST['userName'];
	$Password = $_POST['Password'];
	if ($userName=="admin" and $Password=="admin") {
		header("Location: /adminPanel/");
		exit;
		# code...
	}else{
		echo "Invalid Username or password";
	}
	
}elseif (isset($_POST['staffLogin'])) {

$uname = $_POST['userName'];
$pwd = $_POST['Password'];
	$event = new Event;
	if($event->StaffLogin($uname,$pwd))
	{
	$event = null;
	header("Location: /staffDash");
		exit;
	}
 
}
	

elseif(isset($_POST['addStaff']))
{

	if (!empty($_POST['userName'])) 
	{
		$userName=filterData($_POST['userName']);
	}
	if (!empty($_POST['name'])) 
	{
		$name=filterData($_POST['name']);
	}
	if (!empty($_POST['email'])) 
	{
		$email=filterData($_POST['email']);
	}
	if (!empty($_POST['password'])) 
	{
		$password=filterData($_POST['password']);
	}
	if (!empty($_POST['dob'])) 
	{
		$dob=filterData($_POST['dob']);
	}
	if (!empty($_POST['doj'])) 
	{
		$doj=filterData($_POST['doj']);
	}
	if (!empty($_POST['staffImage'])) 
	{
		$staffImage=$_FILES['staffImage']['name'];
		$f_tmp=$_FILES['staffImage']['tmp_name'];
		$f_size=$_FILES['staffImage']['size'];
		$f_extension=explode('.', $staffImage);
		$f_extension=strtolower(end($f_extension));
		$f_filename=uniqid().'.'.$f_extension;
		$store="uploads/".$f_filename;
		if ($f_extension=='jpg' || $f_extension=='png' || $f_extension=='gif') 
		{
		  	if ($f_size>=5000000)
		  	{
		    	echo "File Size Should Be 1 MB. !";
		  	}
		  	else
		  	{ if (move_uploaded_file($f_tmp, $store)) {} }
		}
		else{ echo "image must be jpg,png or gif only !";}
	}

	$event = new Event;
	if($event->addStaff($email,$name,$userName,$password,$dob,$doj,$store))
	{
	$event = null;
	header("Location: /adminPanel/staffPanel");
		exit;
	}
}elseif(isset($_POST['updateStaff']))
	{
		$oldName=$_POST['oldName'];

	if (!empty($_POST['name'])) 
	{
		$name=filterData($_POST['name']);
	}
	if (!empty($_POST['email'])) 
	{
		$email=filterData($_POST['email']);
	}
	if (!empty($_POST['password'])) 
	{
		$password=filterData($_POST['password']);
	}
	if (!empty($_POST['dob'])) 
	{
		$dob=filterData($_POST['dob']);
	}
	if (!empty($_POST['doj'])) 
	{
		$doj=filterData($_POST['doj']);
	}
	if (!empty($_POST['staffImage'])) 
	{
		$staffImage=$_FILES['staffImage']['name'];
		$f_tmp=$_FILES['staffImage']['tmp_name'];
		$f_size=$_FILES['staffImage']['size'];
		$f_extension=explode('.', $staffImage);
		$f_extension=strtolower(end($f_extension));
		$f_filename=uniqid().'.'.$f_extension;
		$store="uploads/".$f_filename;
		if ($f_extension=='jpg' || $f_extension=='png' || $f_extension=='gif') 
		{
		  	if ($f_size>=5000000)
		  	{
		    	echo "File Size Should Be 1 MB. !";
		  	}
		  	else
		  	{ if (move_uploaded_file($f_tmp, $store)) {} }
		}
		else{ echo "image must be jpg,png or gif only !";}
	}

	$event = new Event;
	if($event->updateStaff($oldName,$email,$name,$password,$dob,$doj,$store))
	{
	$event = null;
	header("Location: /adminPanel/staffPanel/editStaff");
		exit;
	}
}elseif(isset($_POST['addCustomer']))
	{

	if (!empty($_POST['userName'])) 
	{
		$userName=filterData($_POST['userName']);
	}
	if (!empty($_POST['email'])) 
	{
		$email=filterData($_POST['email']);
	}
	if (!empty($_POST['password'])) 
	{
		$password=filterData($_POST['password']);
	}
	if (!empty($_POST['dob'])) 
	{
		$dob=filterData($_POST['dob']);
	}

	$event = new Event;
	if($event->addCustomer($userName,$dob,$email,$password))
	{
	$event = null;
	header("Location: /adminPanel/customerPanel");
		exit;
	}
}
elseif(isset($_POST['updateCustomer']))
	{
		$oldName=$_POST['oldName'];

	if (!empty($_POST['email'])) 
	{
		$email=filterData($_POST['email']);
	}
	if (!empty($_POST['password'])) 
	{
		$password=filterData($_POST['password']);
	}
	if (!empty($_POST['dob'])) 
	{
		$dob=filterData($_POST['dob']);
	}

	$event = new Event;
	if($event->updateCustomer($oldName,$dob,$email,$password))
	{
	$event = null;
	header("Location: /adminPanel/customerPanel/editCustomer");
		exit;
	}
}	
elseif (isset($_POST['newAccount'])){
	if (!empty($_POST['name'])) 
	{
		$name=filterData($_POST['name']);
	}if (!empty($_POST['Fname'])) 
	{
		$Fname=filterData($_POST['Fname']);
	}if (!empty($_POST['Mname'])) 
	{
		$Mname=filterData($_POST['Mname']);
	}if (!empty($_POST['dob'])) 
	{		
		$dob=filterData($_POST['dob']);
	}if (!empty($_POST['street'])) 
	{
		$street=filterData($_POST['street']);
	}if (!empty($_POST['pinCode'])) 
	{
		$pinCode=filterData($_POST['pinCode']);
	}if (!empty($_POST['postOffice'])) 
	{
		$postOffice=filterData($_POST['postOffice']);
	}if (!empty($_POST['district'])) 
	{
		$district=filterData($_POST['district']);
	}if (!empty($_POST['state'])) 
	{
		$state=filterData($_POST['state']);
	}if (!empty($_POST['houseNo'])) 
	{
		$houseNo=filterData($_POST['houseNo']);
	}if (!empty($_POST['panNo'])) 
	{
		$panNo=filterData($_POST['panNo']);
	}if (!empty($_POST['aadhaarNo'])) 
	{
		$aadhaarNo=filterData($_POST['aadhaarNo']);

	}
	if (!empty($_POST['mobNo'])) 
	{	
		$mobNo=filterData($_POST['mobNo']);
	}if (!empty($_POST['faxNo'])) 
	{
		$faxNo=filterData($_POST['faxNo']);
	}if (!empty($_POST['email'])) 
	{
		$email=filterData($_POST['email']);
	}if (!empty($_POST['nameN'])) 
	{
		$nameN=filterData($_POST['nameN']);
	}if (!empty($_POST['aadhaarN'])) 
	{
		$aadhaarN=filterData($_POST['aadhaarN']);
	}if (!empty($_POST['dobN'])) 
	{
		$dobN=filterData($_POST['dobN']);
	}
		
	$event = new Event;

	if($event->AccountRequest($name,$Fname,$Mname,$dob,$houseNo,$street,$pinCode,$postOffice,$district,$state,$panNo,$aadhaarNo,$mobNo,$faxNo,$email,$nameN,$aadhaarN,$dobN))
	{		
			$event=null;
			header("Location: /");
			exit();

	}



}
elseif (isset($_POST['succesAccount'])){
	if (!empty($_POST['name'])) 
	{
		$name=filterData($_POST['name']);
	}if (!empty($_POST['Fname'])) 
	{
		$Fname=filterData($_POST['Fname']);
	}if (!empty($_POST['Mname'])) 
	{
		$Mname=filterData($_POST['Mname']);
	}if (!empty($_POST['dob'])) 
	{		
		$dob=filterData($_POST['dob']);
	}if (!empty($_POST['street'])) 
	{
		$street=filterData($_POST['street']);
	}if (!empty($_POST['pinCode'])) 
	{
		$pinCode=filterData($_POST['pinCode']);
	}if (!empty($_POST['postOffice'])) 
	{
		$postOffice=filterData($_POST['postOffice']);
	}if (!empty($_POST['district'])) 
	{
		$district=filterData($_POST['district']);
	}if (!empty($_POST['state'])) 
	{
		$state=filterData($_POST['state']);
	}if (!empty($_POST['houseNo'])) 
	{
		$houseNo=filterData($_POST['houseNo']);
	}if (!empty($_POST['panNo'])) 
	{
		$panNo=filterData($_POST['panNo']);
	}if (!empty($_POST['aadhaarNo'])) 
	{
		$aadhaarNo=filterData($_POST['aadhaarNo']);

	}
	if (!empty($_POST['mobNo'])) 
	{	
		$mobNo=filterData($_POST['mobNo']);
	}if (!empty($_POST['faxNo'])) 
	{
		$faxNo=filterData($_POST['faxNo']);
	}if (!empty($_POST['email'])) 
	{
		$email=filterData($_POST['email']);
	}if (!empty($_POST['nameN'])) 
	{
		$nameN=filterData($_POST['nameN']);
	}if (!empty($_POST['aadhaarN'])) 
	{
		$aadhaarN=filterData($_POST['aadhaarN']);
	}if (!empty($_POST['dobN'])) 
	{
		$dobN=filterData($_POST['dobN']);
	}
	if (!empty($_POST['userName'])) 
	{
		$userName=filterData($_POST['userName']);
	}if (!empty($_POST['Password'])) 
	{
		$Password=filterData($_POST['Password']);
	
	}
	$id=$_POST['id'];
	$event = new Event;
	$accountNo=mt_rand(100000000,999999999);
	if($event->OpenAccount($Password,$name,$Fname,$Mname,$dob,$houseNo,$street,$pinCode,$postOffice,$district,$state,$panNo,$aadhaarNo,$mobNo,$faxNo,$email,$nameN,$aadhaarN,$dobN,$accountNo))
	{

		if ($event->DeleteAccountRequest($email)) {
		$event = null;
		header("Location: /staffDash/accountRequest");
			exit;
			}
	}



}























































?>
