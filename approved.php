<?php  
include 'conn.php';
include 'includes/PHPMailer/mail.php';
function sendmail($compid,$mail,$conn)
{
    $result= mysqli_query($conn, "SELECT * FROM complaint WHERE id='$compid'");
    $row= mysqli_fetch_assoc($result);
    $due=date('d-m-Y',strtotime($row['due']));
    $complaint="COMP".sprintf("%03d",$compid);
    $sub=$row['sub'];
    $desc=$row['descp'];
    $id=$row['filedby'];
    $result= mysqli_query($conn, "SELECT * FROM staff WHERE id='$id'");
    $row= mysqli_fetch_assoc($result);
    $name=$row['name'];
    $email=$row['email'];
   $mail->addAddress($email);  
    $mail->Subject = 'Repair Work Management | Complaint Due Date'; 
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
                                         '.$name.'</strong><br><br>
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
		Your Complaint will be solved by '.$due.'<br><br>
               
	</td>
</tr>
<tr>
    <td style="line-height: 35px; padding-bottom: 20px;">
       This is your Complaint Details :
       <br>
       Complaint ID : <strong>'.$complaint.'</strong>
       <br>
       Subject : <strong>'.$sub.'</strong>
       <br>
       Description : <strong>'.$desc.'</strong>
       <br>
       Due Date : <strong>'.$due.'</strong>
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
if(isset($_SESSION['officer_id']))
{
    $id= $_SESSION['officer_id'];
     $cat=$_SESSION['officer_cat'];
     $result= mysqli_query($conn, "SELECT * FROM category WHERE head='$id'");
     $row= mysqli_fetch_assoc($result);
     $catid=$row['catid'];
     $session_query="SELECT * FROM complaint,estimation WHERE complaint.id=estimation.compid AND cat='$catid' AND status='Approved'";
    
} else if(isset($_SESSION['hod']))
{
     $id= $_SESSION['hod'];
     $result= mysqli_query($conn, "SELECT * FROM users WHERE id='$id'");
     $row= mysqli_fetch_assoc($result);
     $name=$row['name'];
     $result= mysqli_query($conn, "SELECT * FROM dept WHERE head='$id'");
     $row= mysqli_fetch_assoc($result);
     $deptid=$row['deptid'];
     $deptname=$row['name'];
      $session_query="SELECT * FROM complaint,estimation WHERE complaint.id=estimation.compid AND dept='$deptid' AND status='Approved'";
}
else {
 header('Location:logout.php');
    exit();
  
}
//$id="";
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
         <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

 <script src='https://kit.fontawesome.com/81235d51ef.js' crossorigin="anonymous"></script> 
      <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
 <header>
  <nav class="navbar  navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">Online</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
  <li class="nav-item  pr-3">
     <?php  
     if(isset($_SESSION['hod']))
     {
         echo ' <a class="nav-link " href="hod_dashboard.php">Dashboard </a>';
     }
      if(isset($_SESSION['officer_id']))
     {
         echo ' <a class="nav-link " href="go_dashboard.php">Dashboard </a>';
     }
        if(isset($_SESSION['principal']))
     {
         echo ' <a class="nav-link " href="prin_dashboard.php">Dashboard </a>';
     }
     ?>
     
      </li>
       <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Complaint
        </a>
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                  <?php  if(isset($_SESSION['hod']))
     {
         echo ' <a class="dropdown-item text-white" href="repair.php">New Complaint</a>';
     }
      if(isset($_SESSION['officer_id']))
     {
         echo '     <a class="dropdown-item text-white" href="regcomp.php">Register Complaint</a>
             <a class="dropdown-item text-white" href="viewstatus.php">View Status</a>'
          . '<a class="dropdown-item text-white" href="newcomp.php">New Complaint</a>';
     }
        if(isset($_SESSION['principal']))
     {
         echo ' <a class="dropdown-item text-white" href="request.php">New Complaint</a>';
     }
     ?>
            
      
          <a class="dropdown-item text-white" href="#">Approved Complaint</a>
      
           <a class="dropdown-item text-white" href="forward.php">Forwarded Complaint</a>
     
            <a class="dropdown-item text-white" href="reject.php">Rejected Complaint</a>
      
          <a class="dropdown-item text-white" href="closed.php">Completed Complaint</a>
        </div>
      </li>
      <?php
      if(isset($_SESSION['officer_id']))
     {
         echo ' <li class="nav-item pr-3">
           <a class="nav-link " href="work.php">Work Details</a>
      </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Bill Details
        </a>
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
            <a class="dropdown-item text-white" href="addbill.php" >Add Bill</a>
      
            <a class="dropdown-item text-white" href="view_bill.php">View Details</a>
           
   
        </div>
      </li>';
     }
      
      ?>
       
    
           <?php  
     if(isset($_SESSION['hod']))
     {
         echo '  <li class="nav-item pr-3">
     <a class="nav-link " href="summary.php">Bill Summary</a>
      </li>  <li class="nav-item pr-3"><a class="nav-link " href="hod_profile.php">Profile</a>';
     }
      if(isset($_SESSION['officer_id']))
     {
         echo ' <li class="nav-item pr-3"><a class="nav-link " href="go_profile.php">Profile</a>';
     }
        if(isset($_SESSION['principal']))
     {
         echo ' <li class="nav-item pr-3"><a class="nav-link " href="prin_profile.php">Profile</a>';
     }
     ?>
          
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
            <h3>Approved Complaint</h3>
          <?php 
          
          if(isset($_POST['details']))
          {
               $compid= mysqli_real_escape_string($conn,$_POST['compid']); 
                $w_name= mysqli_real_escape_string($conn,$_POST['w_name']);
                 $w_num= mysqli_real_escape_string($conn,$_POST['w_num']); 
                  $org= mysqli_real_escape_string($conn,$_POST['org']);
                   $due= mysqli_real_escape_string($conn,$_POST['due']); 
                  // echo $compid.$due.$org;
          $query="INSERT INTO work(compid,name,phone,organization) VALUES ('$compid','$w_name','$w_num','$org')";
mysqli_query($conn, $query) or die(mysqli_error($conn));

if(mysqli_affected_rows($conn)>0)
{
    mysqli_query($conn, "UPDATE complaint SET due='$due' WHERE id='$compid'");
    sendmail($compid, $mail, $conn);
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successful!</strong> Work Details Added Successfully.
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
}  
          
          ?>
            
        </div>
        <div class="card-body">
            <table id="dataTable" class="table table-bordered table-striped table-hover table-responsive-lg text-center">
                <thead class="thead-dark">
                <th>
                    ID
                </th>
                <th>
                    Subject
                </th>
                <th>
                    Description
                </th>
                <th>
                    Document
                </th>
                <th>
                    Filed by & On
                </th>
              
                <th>
                    Replace?
                </th>
               <th>
                    Estimation Amount & Details
                </th>
                <th>
                    Status
                </th>
                <?php 
                 if(isset($_SESSION['officer_id']))
     {
         echo ' <th>
                    Add Work Details
                </th>';
     }
                ?>
                </thead>
                <tbody>
                    <?php
             
                    $result= mysqli_query($conn,$session_query );
                    while($row= mysqli_fetch_array($result))
                    {
                        echo ' <tr>
                       <td>
                         COMP'.sprintf("%03d",$row['id']).'
                        </td> <td>
                            '.$row['sub'].' 
                        </td> <td>
                             '.$row['descp'].'
                        </td> <td>';
                        if($row['proof']=="NULL")
                        {
                            echo ' <a><i class="fas fa-eye"></i> View</a>';
                        }
                        else
                        {
                            echo ' <a href="'.$row["proof"].'" target="_blank"><i class="fas fa-eye"></i> View</a>';
                        }
                       
                        echo '</td> <td>';
                $x=$row['filedby'];
                $rr= mysqli_query($conn, "SELECT * FROM staff WHERE id='$x'");
                $aa= mysqli_fetch_assoc($rr);
                echo $aa['name'];
                            echo '<br>'.$row['date'].' '.$row['time'].' 
                        </td>  <td>';
                        if($row['replaces']==1)
                        {
                            echo 'YES';
                        }
 else {
     echo 'NO';
 }
                        
                        echo ' <td>
                               <i class="fas fa-rupee-sign"></i>'.$row['amount'].'<br><a href="'.$row["estimate"].'" target="_blank"><i class="fas fa-eye"></i> View</a>
                        </td>
                            <td>
                            '.$row['status'].' by '; 
                        
                        echo $row['approvedby'].'
                            </td>';
                               if(isset($_SESSION['officer_id']))
     {
         echo ' <td>';
         $x=$row['id'];
         $q= mysqli_query($conn, "SELECT * FROM work WHERE compid='$x'");
         if(mysqli_num_rows($q)>0)
         {
             echo '<a class="btn btn-warning">Added</a>';
         }
 else {
             echo '<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#details" data-id="'.$row['id'].'">Add</a>';
 }
                    
               echo '</td>';
     }
                    echo '</tr>';
                 
                        
                    }
                    ?>
                   
                </tbody>
                
                
            </table>
            
        </div>
    
    </div>
   
            </div>
            <div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h3 class="modal-title" id="exampleModalLabel">Add Work Details</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="post" action="">
              <div class="form-group">
               <div class="input-group">
                       <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-list-alt"></i></span>
                        </div>
                      <input type="hidden" id="comp" value="" name="compid"/>
                      <input type="text" class="form-control" id="compid" value="" placeholder="Complaint ID"  readonly/>
                  </div>
      </div> 
        <div class="form-group">
               <div class="input-group">
                       <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                     
                   <input type="text" class="form-control" name="w_name" placeholder="Labour Name" required/>
                  </div>
      </div>
        <div class="form-group">
               <div class="input-group">
                       <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                     
                   <input type="tel" class="form-control" name="w_num" pattern="\d{10}" placeholder="Contact Number" required/>
                  </div>
      </div>
         <div class="form-group">
               <div class="input-group">
                       <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-university"></i></span>
                        </div>
                     
                   <input type="text" class="form-control" name="org" placeholder="Organization" required/>
                  </div>
      </div>
                <div class="form-group">
               <div class="input-group">
                       <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                        </div>
                  
                   <input type="date" min="<?php print date("Y-m-d");?>" class="form-control" title="Due Date" name="due" required/>
                  </div>
      </div>
              <div class="form-group text-center">
                  <button type="submit" name="details" class="btn btn-outline-success">Submit</button>
              </div>
          </form>
      </div>
    
    </div>
  </div>
</div>
        </section>
            
     
        <?php include 'footer.php';?>
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js" ></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" ></script>
         <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" ></script>
 <script src="js/main.js" ></script>
        
       <script>
  $(document).ready(function(){   
    $('#details').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        var x=pad(rowid,3);
        $('#compid').val("COMP"+x);
           $('#comp').val(rowid);
        
     });
});
function pad (str, max){
  str = str.toString();
  return str.length < max ? pad("0" + str, max) : str;
}
       </script>
    </body>
</html>
