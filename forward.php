<?php  
include 'conn.php';
if(isset($_SESSION['officer_id']))
{
    $id= $_SESSION['officer_id'];
     $cat=$_SESSION['officer_cat'];
     $result= mysqli_query($conn, "SELECT * FROM category WHERE head='$id'");
     $row= mysqli_fetch_assoc($result);
     $catid=$row['catid'];
     $session_query="SELECT * FROM complaint,estimation WHERE complaint.id=estimation.compid AND cat='$catid' AND status='Forwarded'";
    
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
      $session_query="SELECT * FROM complaint,estimation WHERE complaint.id=estimation.compid AND dept='$deptid' AND status='Forwarded'";
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
      <?php  if(isset($_SESSION['hod']))
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
         echo '    <a class="dropdown-item text-white" href="regcomp.php">Register Complaint</a>
             <a class="dropdown-item text-white" href="viewstatus.php">View Status</a>'
          . '<a class="dropdown-item text-white" href="newcomp.php">New Complaint</a>';
     }
        if(isset($_SESSION['principal']))
     {
         echo ' <a class="dropdown-item text-white" href="request.php">New Complaint</a>';
     }
     ?>
      
            <a class="dropdown-item text-white" href="approved.php">Approved Complaint</a>
      
           <a class="dropdown-item text-white" href="#">Forwarded Complaint</a>
     
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
         echo ' <li class="nav-item pr-3">
     <a class="nav-link " href="summary.php">Bill Summary</a>
      </li>  <li class="nav-item pr-3"><a class="nav-link " href="hod_profile.php">Profile</a>';
     }
      if(isset($_SESSION['officer_id']))
     {
         echo '<li class="nav-item pr-3"> <a class="nav-link " href="go_profile.php">Profile</a>';
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
            <h3>Forwarded Complaint</h3>
          <?php 
     
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
                </thead>
                <tbody>
                    <?php
             
                    $result= mysqli_query($conn,$session_query);
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
                            </td>
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
