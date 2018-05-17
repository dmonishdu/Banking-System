<?php
require_once "utils/function.php";
require_once "utils/event.php";
require_once 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('resource');
$twig = new Twig_Environment($loader);
$uri = $_SERVER['REQUEST_URI'];
$uri = explode('/', $uri);
$pageFound=false;
$errorMsg="";
if(empty($uri[1]))
{   $pageFound=true;
  echo $twig->render('home.html', array('title' => 'HomePage'));
}elseif(strstr($uri[1], 'userLogin'))
{ $email=$_GET['email'];
  $pageFound=true;
   $events=new Event;
  $events=$events->UserDetailById($email);
  //print_r($events);
 echo $twig->render('/userPanel/dash.html', array('title' => 'UserPanel','events'=>$events));

}
elseif($uri[1]=='adminLogin')
{
  $pageFound=true;
  echo $twig->render('/form/adminlogin.html', array('title' => 'adminLogin'));

}elseif($uri[1]=='staffLogin')
{
  $pageFound=true;
  echo $twig->render('/form/stafflogin.html', array('title' => 'staffLogin'));

}
elseif($uri[1]=='contact')
{
  $pageFound=true;
  echo $twig->render('/form/contact.html', array('title' => 'Contact Us'));

}
elseif($uri[1]=='newAccount')
{ if(empty($uri[2]))
  {
  $pageFound=true;
  echo $twig->render('/accountFiles/newAccount.html', array('title' => 'Personal Details'));
}elseif ($uri[2]=='address') {
   $pageFound=true;
   $name=$_POST['name'];$Fname=$_POST['fatherName'];$Mname=$_POST['motherName'];$dob=$_POST['dob'];
  
  echo $twig->render('/accountFiles/address.html', array('title' => 'Addres','name'=>$name,'Fname'=>$Fname,'Mname'=>$Mname,'dob'=>$dob));
}
elseif ($uri[2]=='document') {
  $name=$_POST['name'];$Fname=$_POST['Fname'];$Mname=$_POST['Mname'];$dob=$_POST['dob'];
   $img=$_POST['img'];
  $pageFound=true;
 $houseNo=$_POST['houseNo'];$street=$_POST['street'];$pinCode=$_POST['pinCode'];$postOffice=$_POST['postOffice'];$district=$_POST['district'];$state=$_POST['state'];
  echo $twig->render('/accountFiles/document.html', array('title' => 'Documents','name'=>$name,'Fname'=>$Fname,'Mname'=>$Mname,'dob'=>$dob,'img'=>$img,'houseNo'=>$houseNo,'street'=>$street,'pinCode'=>$pinCode,'postOffice'=>$postOffice,'district'=>$district,'state'=>$state));
}
elseif ($uri[2]=='communication') {
   $name=$_POST['name'];$Fname=$_POST['Fname'];$Mname=$_POST['Mname'];$dob=$_POST['dob'];
  $houseNo=$_POST['houseNo'];$street=$_POST['street'];$pinCode=$_POST['pinCode'];$postOffice=$_POST['postOffice'];$district=$_POST['district'];$state=$_POST['state'];
  $pageFound=true;
    $panNo=$_POST['panNo'];$aadhaarNo=$_POST['aadhaarNo'];

  echo $twig->render('/accountFiles/communication.html', array('title' => 'Communication Details','name'=>$name,'Fname'=>$Fname,'Mname'=>$Mname,'dob'=>$dob,'houseNo'=>$houseNo,'street'=>$street,'pinCode'=>$pinCode,'postOffice'=>$postOffice,'district'=>$district,'state'=>$state,'panNo'=>$panNo,'aadhaarNo'=>$aadhaarNo,));
}
elseif ($uri[2]=='nominee') {
  $name=$_POST['name'];$Fname=$_POST['Fname'];$Mname=$_POST['Mname'];$dob=$_POST['dob'];
  $houseNo=$_POST['houseNo'];$street=$_POST['street'];$pinCode=$_POST['pinCode'];$postOffice=$_POST['postOffice'];$district=$_POST['district'];$state=$_POST['state'];
 $panNo=$_POST['panNo'];$aadhaarNo=$_POST['aadhaarNo'];

  $pageFound=true;
  $mobNo=$_POST['mobNo'];$faxNo=$_POST['faxNo'];$email=$_POST['email'];
  echo $twig->render('/accountFiles/nominee.html', array('title' => 'Nominee Details','name'=>$name,'Fname'=>$Fname,'Mname'=>$Mname,'dob'=>$dob,'houseNo'=>$houseNo,'street'=>$street,'pinCode'=>$pinCode,'postOffice'=>$postOffice,'district'=>$district,'state'=>$state,'panNo'=>$panNo,'aadhaarNo'=>$aadhaarNo,'mobNo'=>$mobNo,'faxNo'=>$faxNo,'email'=>$email,));
}

}elseif ($uri[1]=='staffDash') {
   if(empty($uri[2]))
  {
  $pageFound=true;
  echo $twig->render('/StaffBoard/dash.html', array('title' => 'StaffPanel'));
  }elseif($uri[2]=='accountRequest')
  { 
    if(empty($uri[3]))
    {
    $pageFound=true;
      $events=new Event;
      $events=$events->GetAccountRequest();
    echo $twig->render('/StaffBoard/accountRequest.html', array('title' => 'accountRequest','events'=>$events));
    }elseif(strstr($uri[3], 'Verify'))
    { $pageFound = true;
      $id = $_GET['id'];
      $events = new Event;

     $events= $events->GetAccountRequestId($id);
        // print_r($events);
      echo $twig->render('/StaffBoard/confrim.html', array('title' => 'accountRequest','events'=>$events));
      
    }
  }elseif ($uri[2]=='atmRequest') {
    $pageFound=true;
    echo $twig->render('/StaffBoard/atmRequest.html', array('title' => 'atmRequest'));
  }elseif ($uri[2]=='others') {
    $pageFound=true;
    echo $twig->render('/StaffBoard/others.html', array('title' => 'others'));
  }
}
elseif($uri[1]=='adminPanel')
{ 
  //if (!auth_user()) {
  //  $errorMsg = 'Invalid Credentials';
  //  goto notFound;
  //}
  if(empty($uri[2]))
  {
  $pageFound=true;
  echo $twig->render('/dashboard/dash.html', array('title' => 'adminPanel'));
  }
  elseif($uri[2]=='staffPanel')
  { 
    if(empty($uri[3]))
    {
    $pageFound=true;
    echo $twig->render('/dashboard/staffPanel.html', array('title' => 'StaffPanel'));
    }elseif($uri[3]=='deleteStaff'){

     if(empty($uri[4]))
      {
      $pageFound=true;
      $events=new Event;
      $events=$events->getstaff();
      echo $twig->render('/dashboard/deleteStaff.html', array('title' => 'deleteStaff','events'=>$events));
      }elseif(strstr($uri[4], 'delete'))
    { $pageFound = true;
      $userName = $_GET['userName'];
      $event = new Event;
      if($event->deleteStaff($userName));
      {
     header("Location: /adminPanel/staffPanel/deleteStaff");
      $event = null;
      exit;
      }
    }
    }elseif($uri[3]=='editStaff')
    {   
      if(empty($uri[4]))
      {
      $pageFound=true;
      $events=new Event;
      $events=$events->getstaff();
      echo $twig->render('/dashboard/editStaff.html', array('title' => 'editStaff','events'=>$events));
    }elseif(strstr($uri[4], 'editDetails'))
    { $userName = $_GET['userName'];
      $pageFound=true;

      $events=new Event;
      $events=$events->GetStaffByuserName($userName);
     echo $twig->render('/dashboard/editDetails.html', array('title' => 'editDetails','userName'=>$userName,'events'=>$events));
    }
  }
  }
  elseif($uri[2]=='customerPanel')
  {  if(empty($uri[3]))
    {
    $pageFound=true;
    echo $twig->render('/dashboard/customerPanel.html', array('title' => 'customerPanel'));
    }
    elseif($uri[3]=='editCustomer')
    { if(empty($uri[4]))
      {
      $pageFound=true;
      $events=new Event;
      $events=$events-> getCustomer();
      echo $twig->render('/dashboard/editCustomer.html', array('title' => 'editCustomer','events'=>$events));
    }elseif(strstr($uri[4], 'editDetails'))
    { $userName = $_GET['userName'];
      $pageFound=true;

      $events=new Event;
      $events=$events->GetCustomerByuserName($userName);
     echo $twig->render('/dashboard/editDetailsCustomer.html', array('title' => 'editDetails','userName'=>$userName,'events'=>$events));
    }
  }elseif($uri[3]=='deleteCustomer')
    {  if(empty($uri[4]))
    {
      $pageFound=true;
      $events=new Event;
      $events=$events-> getCustomer();
      echo $twig->render('/dashboard/deleteCustomer.html', array('title' => 'deleteCustomer','events'=>$events));

     } elseif(strstr($uri[4], 'delete'))
    { $pageFound = true;
      $userName = $_GET['userName'];
      $event = new Event;
      if($event->deleteCustomer($userName));
      {
     header("Location: /adminPanel/customerPanel/deleteCustomer");
      $event = null;
      exit;
      }
    }
    }
  }
}

notFound:if(!$pageFound){
	echo $twig->render('error.html', array('title' => '404 Error' ,'error' => $errorMsg));
}
?>