<?php  
include 'conn.php';
if(!isset($_SESSION['hod']))
{
    header('Location:logout.php');
    exit();
}
else {
 
     $id= $_SESSION['hod']; 
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
      <a class="nav-link active" href="#">Dashboard </a>
      </li>
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Complaint
        </a>
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
      
            <a class="dropdown-item text-white" href="repair.php">New Complaint</a>
      
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
        
            <h3>Dashboard</h3>
 
            <?php  
         $new=0;
         $forward=0;
         $closed=0;
           $result= mysqli_query($conn, "SELECT * FROM complaint,estimation WHERE complaint.id=estimation.compid AND complaint.dept='$deptid' AND status='Pending'");
           $new= mysqli_num_rows($result);
           $result= mysqli_query($conn, "SELECT * FROM complaint,estimation WHERE complaint.id=estimation.compid AND complaint.dept='$deptid' AND status='Forwarded'");
           $forward= mysqli_num_rows($result);
            $result= mysqli_query($conn, "SELECT * FROM complaint,estimation WHERE complaint.id=estimation.compid AND complaint.dept='$deptid' AND status='Approved'");
           $approved= mysqli_num_rows($result);
                $result= mysqli_query($conn, "SELECT * FROM complaint,estimation WHERE complaint.id=estimation.compid AND complaint.dept='$deptid' AND status='Completed'");
           $closed= mysqli_num_rows($result);
                 $result= mysqli_query($conn, "SELECT * FROM complaint,estimation WHERE complaint.id=estimation.compid AND complaint.dept='$deptid' AND status='Rejected'");
           $reject= mysqli_num_rows($result);
         
           ?>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover table-bordered">
                <tr>
                    <td>User ID</td>
                    <td><?php echo "CECHOD".sprintf("%03d",$id);?></td>
                </tr>
                   <tr>
                       <td>New Complaint <a href="repair.php"><i class="fas fa-eye"></i> View</a></td>
                    <td><?php print $new; ?></td>
                </tr>
                   <tr>
                       <td>Forwarded Complaint <a href="forward.php"><i class="fas fa-eye"></i> View</a></td>
                    <td><?php print $forward; ?></td>
                </tr>
                <tr>
                    <td>Approved Complaint <a href="approved.php"><i class="fas fa-eye"></i> View</a></td>
                    <td><?php print $approved; ?></td>
                </tr>
                  <tr>
                      <td>Rejected Complaint <a href="reject.php"><i class="fas fa-eye"></i> View</a></td>
                    <td><?php print $reject; ?></td>
                </tr>
                 <tr>
                    <td>Completed Complaint <a href="closed.php"><i class="fas fa-eye"></i> View</a></td>
                    <td><?php print $closed; ?></td>
                </tr>
           
            </table>
            <h4>All Complaints</h4>
            <table id="dataTable" class="table table-striped table-hover table-bordered table-responsive-lg text-center">
                
                <thead class="thead-dark">
                <th>ID</th>
                   <th>Subject</th>
                      <th>Description</th>
                         <th>Document</th>
                         <th>Filed by</th>
                         <th>Filed On</th>
                         <th>Due/ Completion Date</th>
                         <th>Status</th>
                </thead>
                <tbody>
                     <?php
             
                    $result= mysqli_query($conn, "SELECT * FROM complaint WHERE dept='$deptid'");
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
                echo $aa['name'].'</td><td>';
                            echo $row['date'].' '.$row['time'].' 
                        </td> 
                          <td>';
                        if($row['due']=="")
                        {
                            echo "NA";
                        }
                        else
                        {
                            echo date('d-m-Y',strtotime($row['due']));
                        }
                        echo '</td>
                        <td>';
                       if($row['status']=="Pending")
                        {
                            echo $row['status'];
                        }
                        else if($row['status']=="Completed")
                        {
                            echo $row['status'];
                        }
                        else
                        {
                            echo $row['status'].' by '.$row['approvedby'];
                        }
                       echo '</td>
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
