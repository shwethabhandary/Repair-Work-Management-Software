<?php  
include 'conn.php';
if(!isset( $_SESSION['admin']))
{
    header('Location:logout.php');
    exit();
}
else {
 
     $id= $_SESSION['admin']; 
   
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
       <li class="nav-item dropdown ">
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
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Add
        </a>
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
      
            <a class="dropdown-item text-white" href="adduser.php">Add Users</a>
            <a class="dropdown-item text-white" href="addstaff.php">Add Staff</a>
       
      
            
        </div>
      </li>
     
      <li class="nav-item active pr-3">
     <a class="nav-link " href="#">Profile</a>
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
          
            <div class="row">
                <div class="col-md-10">
            <h3>Profile</h3>
                  </div>
                <div class="col-md-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#update">Update Profile</button>
            </div>
            </div>
            <?php  
         
           $result= mysqli_query($conn, "SELECT * FROM users WHERE id='$id'");
           $row= mysqli_fetch_assoc($result);
           $name=$row['name'];
           $email=$row['email'];
            if(isset($_POST['go_pass']))
{
     unset($_POST['go_pass']);
      $c_pass = stripslashes($_POST['c_pass']);
        $c_pass = mysqli_real_escape_string($conn,$c_pass);
        
        $n_pass = stripslashes($_POST['n_pass']);
        $n_pass = mysqli_real_escape_string($conn,$n_pass);

    
    $query="SELECT password FROM users WHERE id='$id'";
    $result= mysqli_query($conn, $query);
    $pass= mysqli_fetch_assoc($result);
    if($pass){
        $temppass=$pass['password'];
    }
    if($temppass!= $c_pass)
    {
         echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Oops!</strong> Current Password do not match.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }
   
    else
{
        
    $query1="UPDATE users SET password='$n_pass' WHERE id='$id'";
    mysqli_query($conn, $query1) or die(mysqli_errno($conn));
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successful!</strong> Password Changed Successfully.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
   } 
}
            if(isset($_POST['go_update']))
{
  $name= mysqli_real_escape_string($conn,$_POST['name']); 
    $email= mysqli_real_escape_string($conn,$_POST['email']); 
$query="UPDATE users SET name='$name',email='$email' WHERE id='$id'";
mysqli_query($conn, $query);
if(mysqli_affected_rows($conn)>0)
{
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successful!</strong> Profile Updated Successfully.
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
            <table class="table table-striped table-hover table-bordered">
                <tr>
                    <td>Staff ID</td>
                    <td><?php echo "ADMIN".sprintf("%03d",$id);?></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><?php print $name; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php print $email; ?></td>
                </tr>
           
            </table>
        </div>
    
    </div>
   
            </div>
        </section>
        <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h3 class="modal-title">Update Profile</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="post" action="">
              <div class="form-group">
                  <div class="input-group">
                       <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-id-badge"></i></span>
                        </div>
                      <input type="text" class="form-control" value="<?php echo "ADMIN".sprintf("%03d",$id);?>" placeholder="Staff ID"  readonly/>
                  </div>
              </div>
                 
                            <div class="form-group">
                  <div class="input-group">
                       <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                      <input type="text" class="form-control" placeholder="Name" value="<?php print $name; ?>" name="name" required/>
                  </div>
              </div>
                       <div class="form-group">
                  <div class="input-group">
                       <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
                        </div>
                      <input type="email" class="form-control" placeholder="Email" value="<?php print $email; ?>" name="email" required/>
                  </div>
              </div>
           
              <div class="form-group text-center">
                  <button type="submit" name="go_update" class="btn btn-outline-primary">Update</button>
              </div>
          </form>
      </div>
      <div class="modal-footer">
          <a href="" class="text-danger" data-toggle="modal" data-target="#changepass" data-dismiss="modal">
                      Change Password?</a>
      </div>
    </div>
  </div>
</div>
          <div id="changepass" class="modal fade">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-light">
              <h3 class="modal-title">Change Password</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
              
                 <div class="form-group">
                  <div class="input-group">
                       <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                    <input type="password" class="form-control" name="c_pass" placeholder="Current Password" required>
                </div>
                 </div>
                  <div class="form-group">
                  <div class="input-group">
                       <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                     <input type="password" class="form-control" name="n_pass" id="pass" placeholder="New Password" required>
                </div>
                  </div>
                      <div class="form-group">
                  <div class="input-group">
                       <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                         <input type="password" class="form-control" name="cn_pass" id="newpass" placeholder="Confirm New Password" required>

                     </div>
                                                   <small><span id="checkpass"></span></small>
                      </div>
                   
                
                <div class="text-center">
                    <button type="submit" class="btn btn-success" disabled id="cpass" name="go_pass">Change</button>
                </div>
              </form>
            </div>
            
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
     
        <?php include 'footer.php';?>
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js" ></script>
        <script>
          $(document).ready(function(){
      $('#newpass').keyup(function(){
          if($('#pass').val()!=$('#newpass').val()){
              $('#checkpass').html("Passwords do not match").css("color","red");
              $('#cpass').attr("disabled",true);
          }
          else
          {
              $('#checkpass').html("Passwords matched").css("color","green");
              $('#cpass').attr("disabled",false);
          }
      });
  });
        </script>
    </body>
</html>
