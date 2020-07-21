<?php  
include 'conn.php';
if(!isset($_SESSION['hod']))
{
    header('Location:logout.php');
    exit();
}
else {
 
     $id= $_SESSION['hod'];
     $result= mysqli_query($conn, "SELECT * FROM users WHERE id='$id'");
     $row= mysqli_fetch_assoc($result);
     $name=$row['name'];
     $result= mysqli_query($conn, "SELECT * FROM dept WHERE head='$id'");
     $row= mysqli_fetch_assoc($result);
     $deptid=$row['deptid'];
     $deptname=$row['name'];
     
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
   <a class="nav-link " href="hod_dashboard.php">Dashboard </a>
     
      </li>
       <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Complaint
        </a>
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
               <a class="dropdown-item text-white" href="#">New Complaint</a>
            
      
            <a class="dropdown-item text-white" href="approved.php">Approved Complaint</a>
      
           <a class="dropdown-item text-white" href="forward.php">Forwarded Complaint</a>
     
            <a class="dropdown-item text-white" href="reject.php">Rejected Complaint</a>
      
          <a class="dropdown-item text-white" href="closed.php">Completed Complaint</a>
        </div>
      </li>
        <li class="nav-item pr-3">
     <a class="nav-link " href="summary.php">Bill Summary</a>
      </li> 
      <li class="nav-item pr-3">
     <a class="nav-link " href="hod_profile.php">Profile</a>
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
            <h3>New Complaint</h3>
            
          <?php 
           if(isset($_POST['approve']))
{
               $cid=$_POST['approve'];
$query="UPDATE complaint SET status='Approved', approvedby='$name' WHERE id='$cid'";
mysqli_query($conn, $query) or die(mysqli_error($conn));

if(mysqli_affected_rows($conn)>0)
{
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successful!</strong> Complaint COMP'.sprintf("%03d",$cid).' Approved Successfully.
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
           if(isset($_POST['reject']))
{
               $cid= mysqli_real_escape_string($conn,$_POST['compid']);
                   $reason= mysqli_real_escape_string($conn,$_POST['reason']);
               
$query="UPDATE complaint SET status='Rejected', approvedby='$name',remarks='$reason' WHERE id='$cid'";
mysqli_query($conn, $query) or die(mysqli_error($conn));

if(mysqli_affected_rows($conn)>0)
{
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successful!</strong> Complaint COMP'.sprintf("%03d",$cid).' Rejected Successfully.
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
       if(isset($_POST['forward']))
{
               $cid=$_POST['forward'];
$query="UPDATE complaint SET status='Forwarded', approvedby='$name' WHERE id='$cid'";
mysqli_query($conn, $query) or die(mysqli_error($conn));

if(mysqli_affected_rows($conn)>0)
{
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successful!</strong> Complaint COMP'.sprintf("%03d",$cid).' Forwarded Successfully.
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
                    Filed On
                </th>
                <th>
                    Replace?
                </th>
              <th>
                    Estimation Amount & Details
                </th>
                
                <th>
                   Approve?/ Forward?
                </th>
                   <th>
                    Reject?
                </th>
                </thead>
                <tbody>
                    <?php
             
                    $result= mysqli_query($conn, "SELECT * FROM complaint,estimation WHERE complaint.id=estimation.compid AND complaint.dept='$deptid' AND status='Pending'");
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
                       
                        echo '</td><td>
                             '.$row['date'].' '.$row['time'].'
                        </td>
                         <td>';
                        if($row['replaces']==1)
                        {
                            echo 'YES';
                        }
 else {
     echo 'NO';
 }   echo '   <td>
                               <i class="fas fa-rupee-sign"></i>'.$row['amount'].'<br><a href="'.$row["estimate"].'" target="_blank"><i class="fas fa-eye"></i> View</a>
                        </td>
                        <form method="post" action="">
                        <td>';
                          if($row['replaces']==0)
                        {
                           echo '<button type="submit" class="btn btn-success" value="'.$row['id'].'" name="approve">Approve</button>';
                        }
 else {
    echo '<button type="submit" class="btn btn-primary" value="'.$row['id'].'" name="forward">Forward</button>';
 }
                   
                       echo '</td></form><td>
                           <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#reject" data-id="'.$row['id'].'">Reject</button>
                           </td>
                           
                    </tr>';
                 
                        
                    }
                    ?>
                   
                </tbody>
                
                
            </table>
            
        </div>
    
    </div>
   
            </div>
             <div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h3 class="modal-title" id="exampleModalLabel">Reason for Rejection</h3>
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
                                <textarea class="form-control" name="reason" rows="4" placeholder="Reason..."></textarea>
              </div>
            
              <div class="form-group text-center">
                  <button type="submit" name="reject" class="btn btn-outline-danger">Reject</button>
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
    $('#reject').on('show.bs.modal', function (e) {
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
