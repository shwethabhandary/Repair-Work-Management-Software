<?php  
include 'conn.php';
if(!isset($_SESSION['staff']))
{
    header('Location:logout.php');
    exit();
}
else {
 
     $id= $_SESSION['staff']; 
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
  <a class="navbar-brand " href="index.php">Online</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
       <ul class="navbar-nav ml-auto">
  <li class="nav-item active pr-3">
        <a class="nav-link " href="#">Dashboard</a>
      </li>
       <li class="nav-item pr-3">
           <a class="nav-link " href="viewstatus.php">View Status</a>
      </li>
      <li class="nav-item pr-3">
        <a class="nav-link " href="sprofile.php">Profile</a>
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
            <h3>Register Complaint</h3>
            <?php  
         
           $result= mysqli_query($conn, "SELECT * FROM staff WHERE id='$id'");
           $row= mysqli_fetch_assoc($result);
           $name=$row['name'];
           $dept=$row['dept'];
            if(isset($_POST['reg_comp']))
{
  $sub= mysqli_real_escape_string($conn,$_POST['sub']); 
   $cat= mysqli_real_escape_string($conn,$_POST['cat']); 
    $desc= mysqli_real_escape_string($conn,$_POST['desc']); 
    $proof="NULL";
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
$query="INSERT INTO complaint(sub,descp,proof,cat,filedby,dept,date,time) VALUES ('$sub','$desc','$proof','$cat','$id','$dept',NOW(),NOW())";
mysqli_query($conn, $query) or die(mysqli_error($conn));

if(mysqli_affected_rows($conn)>0)
{
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successful!</strong> Registered Complaint Successfully.
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
            <form action="" method="post" enctype="multipart/form-data">
                <label>Name</label>
                <div class="form-group">
                  
                    <input type="text" class="form-control" value="<?php print $name;  ?>" readonly>
                    
                </div>
                   <label>Category</label>
                <div class="form-group">
                  
                    <select class="custom-select" name="cat">
                        <option value="">-Select-</option>
                        <option value="1">Electrical</option>
                         <option value="2">Networking</option>
                         <option value="3">General</option>
                      
                    </select>
                </div>
                <div class="form-group">
                <label>Subject</label>

                <input type="text" class="form-control" placeholder="Subject" name="sub" required>
          
                </div>
                    <div class="form-group">
                <label>Description</label>

                <textarea class="form-control" placeholder="Description" rows="5" name="desc" required></textarea>
          
                </div>
                    <div class="form-group">
                <label>Proof (.docx, .doc .pdf)</label>

                <input type="file" class="form-control-file" name="proof" onchange="ValidateSingleInput(this);">
                </div>
             
                
                <div class="form-group text-center">
                    <button class="btn btn-outline-success" name="reg_comp">Submit</button>
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
