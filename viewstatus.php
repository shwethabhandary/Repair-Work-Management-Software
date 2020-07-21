<?php  
include 'conn.php';
if(isset($_SESSION['staff']))
{
    $id= $_SESSION['staff'];
   
}
else if($_SESSION['officer_id'])
{
    $id= $_SESSION['officer_id'];
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
  <a class="navbar-brand " href="index.php">Online</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <?php 
      if(isset($_SESSION['staff']))
      {
          echo ' <ul class="navbar-nav ml-auto">
  <li class="nav-item  pr-3">
      <a class="nav-link " href="dashboard.php">Dashboard</a>
      </li>
       <li class="nav-item active pr-3">
           <a class="nav-link " href="#">View Status</a>
      </li>
      <li class="nav-item  pr-3">
          <a class="nav-link " href="sprofile.php">Profile</a>
      </li>
      <li class="nav-item pr-3">
        <a class="nav-link " href="logout.php">Logout</a>
      </li>
    </ul>';
      }
      else if($_SESSION['officer_id'])
      {
          echo ' <ul class="navbar-nav ml-auto">
  <li class="nav-item  pr-3">
   <a class="nav-link " href="go_dashboard.php">Dashboard </a>
     
      </li>
       <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Complaint
        </a>
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
             <a class="dropdown-item text-white" href="regcomp.php">Register Complaint</a>
             <a class="dropdown-item text-white" href="#">View Status</a>
            <a class="dropdown-item text-white" href="newcomp.php">New Complaint</a>
            
      
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
   
    </ul>';
      }
      ?>
     
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
            <h3>Status</h3>
          <?php
            if(isset($_POST['update_comp']))
{
           $compid= mysqli_real_escape_string($conn,$_POST['compid']); 
         $result= mysqli_query($conn, "SELECT * FROM complaint WHERE id='$compid'");
         $xx= mysqli_fetch_assoc($result);
         $proof=$xx['proof'];
  $sub= mysqli_real_escape_string($conn,$_POST['sub']); 
   $cat= mysqli_real_escape_string($conn,$_POST['cat']); 
    $desc= mysqli_real_escape_string($conn,$_POST['desc']); 
     if(isset($_FILES['proof']))
      {
       
        $num=rand();
        $ext = pathinfo($_FILES['proof']['name'], PATHINFO_EXTENSION);
		  $dir="docs/";
		   $path=$dir.$num.".".$ext;
                  //echo $path;
		  if(move_uploaded_file($_FILES['proof']['tmp_name'],$path))
		  {
                     $proof=$path;
                  }
      }
$query="UPDATE complaint SET sub='$sub',cat='$cat',descp='$desc',proof='$proof' WHERE id='$compid'";
        mysqli_query($conn, $query) or die(mysqli_error($conn));

if(mysqli_affected_rows($conn)>0)
{
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successful!</strong> Edited Complaint Successfully.
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
                    Category
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
                    Due/ Completion Date
                </th>
                <th>
                    Status
                </th>
                <th>
                    Edit
                </th>
                </thead>
                <tbody>
                    <?php
                  
                    $result= mysqli_query($conn, "SELECT * FROM complaint,category WHERE complaint.cat=category.catid AND filedby='$id'");
                    while($row= mysqli_fetch_array($result))
                    {
                        echo ' <tr>
                        <td>
                         COMP'.sprintf("%03d",$row['id']).'
                        </td><td>
                            '.$row['name'].'
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
                       
                        echo '</td> <td>
                             '.$row['date'].'  '.$row['time'].'
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
                       echo '</td> <td>';
                        if($row['checks']==0)
                        {
                            echo  '<a href="#" data-toggle="modal" data-target="#edit_comp" data-id="'.$row['id'].'" data-cat="'.$row['cat'].'" data-sub="'.$row['sub'].'" data-desc="'.$row['descp'].'" data-proof="'.$row['proof'].'"><i class="fas fa-edit"></i> Edit</a>';
                        }
                        else
                        {
                            echo  '<a><i class="fas fa-edit"></i> Edit</a>';
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
         <div class="modal fade" id="edit_comp" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h3 class="modal-title">Edit Complaint</h3>
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
                            <span class="input-group-text"><i class="fas fa-house-user"></i></span>
                        </div>
                    <select class="custom-select" name="cat" id="cat">
                        <option value="">-Select-</option>
                        <option value="1">Electrical</option>
                         <option value="2">Networking</option>
                         <option value="3">General</option>
                      
                    </select>
        
                  </div>
              </div>
                   <div class="form-group">
                  <div class="input-group">
                       <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-pen"></i></span>
                        </div>
                      <input type="text" class="form-control" placeholder="Subject" id="sub" name="sub" value="" required>
                  </div>
              </div> 
                  <div class="form-group">
                  <div class="input-group">
                       <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-book"></i></span>
                        </div>
                      <textarea class="form-control" placeholder="Description" id="desc" rows="3" name="desc" required> </textarea>
                  </div>
              </div> 
            
                      <div class="form-group">
                         
                  <div class="input-group">
                       <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-receipt"></i></span>
                        </div>
                      
                <input type="file" class="form-control" name="proof" onchange="ValidateSingleInput(this);">
                  </div>
                          <a href="" id="proof" target="_blank"><i class="fas fa-eye"></i> Uploaded File</a>
              </div>       
           
             
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-outline-success" name="update_comp">Update</button>
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
    $('#edit_comp').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        var x=pad(rowid,3);
        $('#compid').val("COMP"+x);
           $('#comp').val(rowid);
           var sub = $(e.relatedTarget).data('sub');
           $('#sub').val(sub);
           var cat= $(e.relatedTarget).data('cat');
           $('#cat').val(cat);
              var desc= $(e.relatedTarget).data('desc');
            $('#desc').val(desc);
           var proof= $(e.relatedTarget).data('proof');
           $('#proof').attr("href", proof);
        
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
