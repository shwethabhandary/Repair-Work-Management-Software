<?php  
include 'conn.php';
if(isset($_SESSION['admin']))
{
    $id= $_SESSION['admin'];

     $session_query="SELECT * FROM complaint,bill WHERE complaint.id=bill.compid";
    
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
        <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          View
        </a>
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
      
            <a class="dropdown-item text-white" href="#">View Bills</a>
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
            <h3>Bill Details</h3>
          <?php 
 if(isset($_POST['del_bill']))
 {
     $id=$_POST['del_bill']; 
     $query="DELETE FROM `bill` WHERE bid='$id'";
     mysqli_query($conn,$query) or die(mysqli_errno($conn));
   if(mysqli_affected_rows($conn)>0)
{
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successful!</strong> Bill Deleted Successfully.
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
                    Filed by & On
                </th>
              
                <th>
                    Replace?
                </th>
               <th>
                    Bill Amount
                </th>
                <th>
                    Bill Details
                </th>
                 <th>
                    Completed On
                </th>
                <th>
                    Status
                </th>
                <th>
                    Delete?
                </th>
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
                        </td>  <td>';
                $x=$row['filedby'];
                $rr= mysqli_query($conn, "SELECT * FROM staff WHERE id='$x'");
                $aa= mysqli_fetch_assoc($rr);
                echo $aa['name'];
                            echo '<br>'.$row['date'].' '.$row['time'].' 
                        </td>  <td>';
                        if(isset($row['replaces']) && $row['replaces']==1)
                        {
                            echo 'YES';
                        }
 else {
     echo 'NO';
 }
                        
                        echo ' <td>
                               <i class="fas fa-rupee-sign"></i>'.$row['amt'].'
                        </td>
                        <td>';
                        $bills = explode (";", $row['bill']); 
                        array_pop($bills);
                        foreach($bills as $key => $bill)
                        {
                            echo '<a href="'.$bill.'" target="_blank"><i class="fas fa-receipt"></i> Bill-'.($key+1).'</a><br>';
                        }
                       echo '</td>
                        <td>   '.date('d-m-Y',strtotime($row['due'])).' </td>
                            <td>
                            '.$row['status'].'
                            </td>
                            <td><form method="post" action=""><button type="submit" class="btn btn-danger" value="'.$row['bid'].'" name="del_bill">Delete</button></form></td>
                    </tr>';
                 
                        
                    }
                    ?>
                   
                </tbody>
                
                
            </table>
            
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
        
     
    </body>
</html>
