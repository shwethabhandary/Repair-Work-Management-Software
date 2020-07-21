<?php  
include 'conn.php';
 if(isset($_SESSION['admin']))
{
     $id= $_SESSION['admin'];

  
 
    
}

    
    else {
 header('Location:logout.php');
    exit();
  
}
$from="";
$to="";
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
      
            <a class="dropdown-item text-white" href="view_bill.php">View Bills</a>
            <a class="dropdown-item text-white" href="#">View Bill Summary</a>
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
                         <h3>Bill Summary</h3></div>
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="row">
                                <div class="pl-3"><label>From</label></div>
                                <div class="col-md-3">
                                    
                                    <div class="form-group">
                                        <div class="input-group">
                       <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                        </div>
                                            <input type="date" class="form-control" name="from" title="From Date" required/>
                                    </div>
                                    </div>
                                </div>
                                <div class="pl-2"><label>To</label></div>
                                <div class="col-md-3">
                          
                                    <div class="form-group">
                                        <div class="input-group">
                       <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                        </div>
                                            <input type="date" value="<?php print date("Y-m-d");?>" max="<?php print date("Y-m-d");?>" class="form-control" title="To Date"  name="to"/>
                                    </div>
                                        </div>
                                </div>
                                <div class="pl-2"><label>Summary Of</label></div>
                                <div class="col-md-3">
                          
                                    <div class="form-group">
                                        <div class="input-group">
                       <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-house-user"></i></span>
                        </div>
                                            <select class="custom-select" name="sum" required>
                        <option value="">-Select-</option>
                         <option value="all">All</option>
                       <option value="d1">Computer Science</option>
                            <option value="d2">Information Science</option>
                            <option value="d3">ELectronics and Communication</option>
                            <option value="d4">Mechanical</option>
                        
                             <option value="c1">Electrical</option>
                                 <option value="c2">Networking</option>
                                   <option value="c3">General</option>
                      
                    </select>
                                    </div>
                                        </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group"> 
                                        <button type="submit" class="btn btn-primary" name="fetch">Fetch</button>
                                    </div>
                                </div>
                                    
                            </div>
                                
                        </form>
                        <?php
                        if(isset($_POST['fetch']))
                        {
                            $total=0;
                            $from= date('Y-m-d',strtotime($_POST['from']));
                            $to= date('Y-m-d',strtotime($_POST['to']));
                            $sum= mysqli_real_escape_string($conn,$_POST['sum']);
                            if($sum[0]=='d')
                            {
                               $dept=$sum[1];
                                     $res= mysqli_query($conn, "SELECT * FROM dept WHERE deptid='$dept'");
                                $t= mysqli_fetch_assoc($res);
                                $summary=$t['name'];
                                
                                $session_query="SELECT * FROM complaint,estimation,bill WHERE due BETWEEN '$from' AND '$to' AND complaint.id=estimation.compid AND bill.compid=complaint.id AND dept='$dept'";
                                $qq= mysqli_query($conn, $session_query);
                                $temp=0;
                                while($rr= mysqli_fetch_array($qq))
                                {
                                    $temp+=$rr['amt'];
                                }
                           $total=$temp;
                            }
                           else if($sum[0]=='c')
                            {
                                $cat=$sum[1];
                                $res= mysqli_query($conn, "SELECT * FROM category WHERE catid='$cat'");
                                $t= mysqli_fetch_assoc($res);
                                $summary=$t['name'];
                             
                                   $session_query="SELECT * FROM complaint,estimation,bill WHERE due BETWEEN '$from' AND '$to' AND complaint.id=estimation.compid AND bill.compid=complaint.id AND cat='$cat'"; 
                                
                                 
                                  $qq= mysqli_query($conn, $session_query);
                                $temp=0;
                                while($rr= mysqli_fetch_array($qq))
                                {
                                    $temp+=$rr['amt'];
                                }
                                 $total=$temp;
                            }
 else {
      
    
                               
                                  $session_query="SELECT * FROM complaint,estimation,bill WHERE due BETWEEN '$from' AND '$to' AND complaint.id=estimation.compid AND bill.compid=complaint.id";
                               
      $qq= mysqli_query($conn, $session_query);
                                $temp=0;
                                while($rr= mysqli_fetch_array($qq))
                                {
                                    $temp+=$rr['amt'];
                                }
                                 $total=$temp;
      $summary="All";
      }
                           
                            
                            
                            
                            echo '<div class="text-center"><h3>Summary of '.$summary    .'</h3>';
                            echo '<h3>Total Expenditure: <i class="fas fa-rupee-sign"></i>'.$total.'</h3></div>';
                        }
                        
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <section id="admin">
            <div class="container">
               
    <div class="card">
        <div class="card-header">
            <h4>Bill Details <?php 
            if(isset($_POST['fetch']))
            {
                echo ' From '.date('d-m-Y',strtotime($from)).' To '.date('d-m-Y',strtotime($to));
            }
            ?></h4>
            
        </div>
        <div class="card-body">
            <table id="dataTable" class="table table-bordered table-striped table-hover table-responsive-lg text-center">
                <thead class="thead-dark">
                <th>
                    ID
                </th>
          <th>
                    Department
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
                </thead>
                <tbody>
                    <?php
             if(isset($_POST['fetch']))
                        {
                    $result= mysqli_query($conn,$session_query );
                      while($row= mysqli_fetch_array($result))
                    {
                        echo ' <tr>
                       <td>
                         COMP'.sprintf("%03d",$row['id']).'
                        </td>';
                 
                    echo '<td> ';
                        $x=$row['dept'];
                         $rr= mysqli_query($conn, "SELECT * FROM dept WHERE deptid='$x'");
                $aa= mysqli_fetch_assoc($rr);
                echo $aa['name'];
                         echo '</td>';
                
               
                        echo '<td>
                            '.$row['sub'].' 
                        </td> <td>
                             '.$row['descp'].'
                        </td>  <td>';
                $x=$row['filedby'];
                $rr= mysqli_query($conn, "SELECT * FROM staff WHERE id='$x'");
                $aa= mysqli_fetch_assoc($rr);
                echo $aa['name'];
                            echo '<br>'.$row['date'].' '.$row['time'].' 
                        </td>'; 
                                 
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
                    </tr>';
                 
                        
                    }
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

