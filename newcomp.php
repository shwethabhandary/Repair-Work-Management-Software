<?php  
include 'conn.php';
if(!isset($_SESSION['officer_id']))
{
    header('Location:logout.php');
    exit();
}
else {
 
     $id= $_SESSION['officer_id'];
     $cat=$_SESSION['officer_cat'];
     $result= mysqli_query($conn, "SELECT * FROM category WHERE head='$id'");
     $row= mysqli_fetch_assoc($result);
     $catid=$row['catid'];
     
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
   <a class="nav-link " href="go_dashboard.php">Dashboard </a>
     
      </li>
       <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Complaint
        </a>
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
               <a class="dropdown-item text-white" href="regcomp.php">Register Complaint</a>
             <a class="dropdown-item text-white" href="viewstatus.php">View Status</a>
               <a class="dropdown-item text-white" href="#">New Complaint</a>
            
      
            <a class="dropdown-item text-white" href="approved.php">Approved Complaint</a>
      
           <a class="dropdown-item text-white" href="forward.php">Forwarded Complaint</a>
     
            <a class="dropdown-item text-white" href="reject.php">Rejected Complaint</a>
      
          <a class="dropdown-item text-white" href="closed.php">Completed Complaint</a>
        </div>
      </li>
         <li class="nav-item pr-3">
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
      </li>
    
      <li class="nav-item pr-3">
     <a class="nav-link " href="go_profile.php">Profile</a>
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
           if(isset($_POST['add_est']))
{
               $repair=0;
  $compid= mysqli_real_escape_string($conn,$_POST['compid']); 
   $amt= mysqli_real_escape_string($conn,$_POST['amt']); 
   if(isset($_POST['repair']))
   {
       $repair=1;
   }
     if(isset($_FILES['esti']))
      {
       
        $num=rand();
        $ext = pathinfo($_FILES['esti']['name'], PATHINFO_EXTENSION);
		  $dir="estimation/";
		   $path=$dir.$num.".".$ext;
                  //echo $path;
		  if(move_uploaded_file($_FILES['esti']['tmp_name'],$path))
		  {
                     $estimation=$path;
                  }
      }
$query="INSERT INTO estimation(compid,amount,estimate,replaces,dates,times) VALUES ('$compid','$amt','$estimation','$repair',NOW(),NOW())";
mysqli_query($conn, $query) or die(mysqli_error($conn));
if($repair==1)
{
    mysqli_query($conn, "INSERT INTO replacement (compid)VALUES('$compid')"); 
}
if(mysqli_affected_rows($conn)>0)
{
    mysqli_query($conn, "UPDATE complaint SET checks=1 WHERE id='$compid'");
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successful!</strong> Estimation Added Successfully.
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
                    Filed by 
                </th>
                <th>
                    Filed On
                </th>
                <th>
                    Add Estimation
                </th>
                </thead>
                <tbody>
                    <?php
             
                    $result= mysqli_query($conn, "SELECT * FROM complaint WHERE cat='$catid' AND status='Pending'");
                    while($row= mysqli_fetch_array($result))
                    {
                        echo ' <tr>
                       <td>
                         COMP'.sprintf("%03d",$row['id']).'
                        </td> <td>
                            '.$row['sub'].' 
                        </td> <td>
                             '.$row['descp'].'
                        </td><td>';
                        if($row['proof']=="NULL")
                        {
                            echo ' <a><i class="fas fa-eye"></i> View</a>';
                        }
                        else
                        {
                            echo ' <a href="'.$row["proof"].'" target="_blank"><i class="fas fa-eye"></i> View</a>';
                        }
                       
                        echo '</td>
                        <td>';
                            $x=$row['filedby'];
                $rr= mysqli_query($conn, "SELECT * FROM staff WHERE id='$x'");
                $aa= mysqli_fetch_assoc($rr);
                echo $aa['name'].' </td>
                        <td>
                             '.$row['date'].' '.$row['time'].'
                        </td>  <td>';
                        if($row['checks']==0)
                        {
                            echo  '<a href="#" data-toggle="modal" data-target="#addestimate" data-id="'.$row['id'].'"><i class="fas fa-plus-square"></i> Add Estimation</a>';
                        }
                        else
                        {
                            echo  '<a><i class="fas fa-plus-square"></i> Estimate Added</a>';
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
                <div class="modal fade" id="addestimate" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h3 class="modal-title">Add Estimation</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="post" action="" enctype="multipart/form-data">
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
                            <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                        </div>
                      <input type="number" class="form-control" placeholder="Estimated Amount" name="amt" required/>
                  </div>
              </div>
               
                      <div class="form-group">
                  <div class="input-group">
                       <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-receipt"></i></span>
                        </div>
                      <input type="file" class="form-control" name="esti" onchange="ValidateSingleInput(this);" required/>
                  </div>
              </div>       
              <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1" name="repair">
    <label class="form-check-label" for="exampleCheck1">Replacement?</label>
  </div>
              <div class="form-group text-center">
                  <button type="submit" name="add_est" class="btn btn-outline-primary">Add</button>
              </div>
          </form>
      </div>
    
    </div>
  </div>
</div>
     
        <?php include 'footer.php';?>
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js" ></script>
        
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" ></script>
         <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" ></script>
 <script src="js/main.js" ></script>
       
       
        
       <script>
  $(document).ready(function(){   
    $('#addestimate').on('show.bs.modal', function (e) {
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
       
        <script type="text/javascript">
            var _validFileExtensions = [".pdf", ".docx",".doc"];    
function ValidateSingleInput(oInput) {

    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
                alert("Invalid type of file. Only upload " + _validFileExtensions.join(", ")+" files");
                oInput.value = "";
                return false;
            }
               
            
        }
        
    }
    return true;
}

            </script>
    </body>
</html>
