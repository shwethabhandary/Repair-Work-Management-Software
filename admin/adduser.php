<?php  
include 'conn.php';
include '../includes/PHPMailer/mail.php';
function rand_string( $length ) {  
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";  
    $size = strlen( $chars );  
    $str="";
    for( $i = 0; $i < $length; $i++ ) {  
    $str.= $chars[ rand( 0, $size - 1 ) ];  
    }
    return $str;  
}
function sendpassword($email,$pass,$mail)
{
   $mail->addAddress($email);  
    $mail->Subject = 'Repair Work Management Registration'; 
    $mail->Body='<table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
              <tbody><tr>
                <td>
                  <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                    <tbody><tr>
                      <td align="center" style="padding-bottom:20px;">
                     
                      </td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
              
              <tr>
                <td>
                  <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                    <tbody><tr>
                      <td bgcolor="#fafbfc" style="width:7px; font-size:1px;">&nbsp;</td>
                      <td bgcolor="#f5f6f7" style="width:1px; font-size:1px;">&nbsp;</td>
                      <td bgcolor="#f0f2f3" style="width:1px; font-size:1px;">&nbsp;</td>
                      <td bgcolor="#edeef1" style="width:1px; font-size:1px;">&nbsp;</td>
                      <td bgcolor="#ffffff">
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                          <tbody><tr>
                            <td style="text-align:center; padding:40px 40px 40px 40px; border-top:3px solid #69A3FA;">
                            
                              <div style="display:inline-block; width:100%; max-width:520px;">
                                <table border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; font-size:14px; line-height:24px; color:#525C65; text-align:left; width:100%;">
                                  <tbody><tr>
                                    <td>
                                      <p style="Margin:0; font-size:18px; line-height:23px; color:#102231; font-weight:bold;">
                                        <strong>
                                          Dear, 
                                         '.$email.'</strong><br><br>
                                      </p>
                                    </td>
                                  </tr>
                                  
<tr>
    <td style="font-size: 25px; font-weight: bold; color:#69A3FA; ">
		Welcome to Repair Work Management<br><br>
               
	</td>
</tr>
<tr>
    <td style="font-size: 20px; font-weight: bold; color:#69A3FA; ">
		You have been registered with Repair Work Management<br><br>
               
	</td>
</tr>
<tr>
    <td style="line-height: 35px; padding-bottom: 20px;">
       This is your Login Credentials :
       <br>
       Username : <strong>'.$email.'</strong>
       <br>
       Password : <strong>'.$pass.'</strong>
    </td>
</tr>
         <tr>
                                    <td style="font:14px/16px Arial, Helvetica, sans-serif; color:#363636; padding:0 0 14px;">
                                      Regards,
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="font:bold 14px/16px Arial, Helvetica, sans-serif; color:#363636; padding:0 0 7px;">
                                      Major Project Team 29
                                    </td>
                                  </tr>
                                  
                                </tbody></table>
                              </div>
                           
                            </td>
                          </tr>
                          <tr>
                            <td bgcolor="#e0e2e5" style="height:1px; width:100%; line-height:1px; font-size:0;">&nbsp;</td>
                          </tr>
                          <tr>
                            <td bgcolor="#e0e2e4" style="height:1px; width:100%; line-height:1px; font-size:0;">&nbsp;</td>
                          </tr>
                          <tr>
                            <td bgcolor="#e8ebed" style="height:1px; width:100%; line-height:1px; font-size:0;">&nbsp;</td>
                          </tr>
                          <tr>
                            <td bgcolor="#f1f3f6" style="height:1px; width:100%; line-height:1px; font-size:0;">&nbsp;</td>
                          </tr>
                        </tbody></table>
                      </td>
                      <td bgcolor="#edeef1" style="width:1px; font-size:1px;">&nbsp;</td>
                      <td bgcolor="#f0f2f3" style="width:1px; font-size:1px;">&nbsp;</td>
                      <td bgcolor="#f5f6f7" style="width:1px; font-size:1px;">&nbsp;</td>
                      <td bgcolor="#fafbfc" style="width:7px; font-size:1px;">&nbsp;</td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
             <tr>
                <td align="center" style="padding-bottom:30px; padding-top: 30px;">
                  <table border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; font-size:12px; line-height:18px;  text-align:center; width:auto;">
                    <tbody><tr>
                      <td style="color:#b7bdc1;">
                        
                        <p style="Margin:0;">Copyright &copy; Major Project Team 29 <br>This e-mail is autogenerated, may contain trade secrets or privileged, confidential information. If you have received this e-mail in error, Please ignore.</p>
                      </td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
            
            </tbody></table>';
    $mail->AltBody = '';
   $mail->send(); 
}
if(!isset($_SESSION['admin']))
{
    header('Location: logout.php');
    exit();
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Online</title>
   
        <link rel="stylesheet" href="css/bootstrap.min.css">
 <script src='https://kit.fontawesome.com/81235d51ef.js' crossorigin="anonymous"></script> 
      <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <header>
  <nav class="navbar  navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Online</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
  <li class="nav-item  pr-3">
   
      <a class="nav-link" href="index.php">Dashboard </a>
     
      </li>
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Complaint
        </a>
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
      
            <a class="dropdown-item text-white" href="request.php">New Complaint</a>
             <a class="dropdown-item text-white" href="approved.php">Approved Complaint</a>
      
            <a class="dropdown-item text-white" href="forward.php">Forwarded Complaint</a>
     
           <a class="dropdown-item text-white" href="reject.php">Rejected Complaint</a>
             <a class="dropdown-item text-white" href="closed.php">Completed Complaint</a>
      
            
        </div>
      </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          View
        </a>
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
      
            <a class="dropdown-item text-white" href="view_bill.php">View Bills</a>
            <a class="dropdown-item text-white" href="summary.php">View Bill Summary</a>
            <a class="dropdown-item text-white" href="work.php">View Work Details</a>
      
            <a class="dropdown-item text-white" href="estimation.php">View Estimation Details</a>
     
            <a class="dropdown-item text-white" href="view_user.php">View Users</a>
            <a class="dropdown-item text-white" href="view_staff.php">View Staffs</a>
      
            
        </div>
      </li>
        <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Add
        </a>
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
      
            <a class="dropdown-item text-white" href="#">Add Users</a>
            <a class="dropdown-item text-white" href="addstaff.php">Add Staff</a>
       
      
            
        </div>
      </li>
     
      <li class="nav-item pr-3">
     <a class="nav-link " href="profile.php">Profile</a>
      </li>
      <li class="nav-item pr-3">
        <a class="nav-link " href="logout.php">Logout</a>
      </li>
   
    </ul>
  </div>
</nav> 
</header>
    
       <section>
        <div class="jumbotron img123">
    <div class="container-fluid text-white text-center">
        <h1>Repair Work Management</h1>
        <p>An online Maintainance Department under Canara Engineering College</p>
    </div>

    </div>
            
        </section>
            

        <section id="admin">
            <div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Add User</h3>
            <?php  
            if(isset($_POST['add']))
{
  $name= mysqli_real_escape_string($conn,$_POST['name']); 
   $type= mysqli_real_escape_string($conn,$_POST['type']); 
    $email= mysqli_real_escape_string($conn,$_POST['email']); 
     $pass= rand_string(8);
     

$query="INSERT INTO users(name,email,password,auth) VALUES ('$name','$email','$pass','$type')";
mysqli_query($conn, $query);
if(mysqli_affected_rows($conn)>0)
{
    sendpassword($email,$pass,$mail);
      $result= mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $row= mysqli_fetch_assoc($result);
    $id=$row['id'];
  
    if($type=="hodcs")
    {
        mysqli_query($conn, "UPDATE dept SET head='$id' WHERE name='Computer Science'");
    }
    else if($type=="hodis")
    {
        mysqli_query($conn, "UPDATE dept SET head='$id' WHERE name='Information Science'");
    }
    else if($type=="hodec")
    {
        mysqli_query($conn, "UPDATE dept SET head='$id' WHERE name='Electronics and Communication'");
    }
    else  if($type=="hodme")
    {
        mysqli_query($conn, "UPDATE dept SET head='$id' WHERE name='Mechanical'");
    }
    else  if($type=="hos")
    {
        mysqli_query($conn, "UPDATE dept SET head='$id' WHERE name='Hostel'");
    }
    else if($type=="can")
    {
        mysqli_query($conn, "UPDATE dept SET head='$id' WHERE name='Canteen'");
    }
    else if($type=="principal")
    {
        mysqli_query($conn, "UPDATE dept SET head='$id' WHERE name='Principal'");
    }
        
        
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successful!</strong> User added Successfully.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
else
{
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Oops!</strong> Something went wrong.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
}      ?>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <label>Name</label>
                <div class="form-group">
                  
                    <input type="text" class="form-control" placeholder="Name" name="name" required>
                    
                </div>
                   <label>User Type</label>
                <div class="form-group">
                  
                    <select class="custom-select" name="type" required>
                        <option value="">-Select-</option>
                          <option value="hodcs">HOD (CS)</option>
                            <option value="hodis">HOD (IS)</option>
                            <option value="hodec">HOD (EC)</option>
                            <option value="hodme">HOD (ME)</option>
                             <option value="principal">Principal</option>
                                   <option value="hos">Hostel Incharge</option>
                            <option value="can">Canteen Incharge)</option>
                      
                    </select>
                </div>
                <div class="form-group">
                <label>Email</label>

                <input type="email" class="form-control" placeholder="Email" name="email" required>
          
                </div>
                 
             
                
                <div class="form-group text-center">
                    <button class="btn btn-outline-success" name="add">Add</button>
                </div>
                
            </form>
        </div>
    
    </div>
   
            </div>
        </section>
     
        <?php include 'footer.php';?>
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js" ></script>
    </body>
</html>
