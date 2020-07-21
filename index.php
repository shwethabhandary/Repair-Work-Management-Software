<?php  
include 'conn.php';
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
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
     <a class="navbar-brand" href="#">Online</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
       <ul class="navbar-nav ml-auto">
	  <li class="nav-item active pr-3">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
<!--      <li class="nav-item pr-3">
        <a class="nav-link" href="#">About</a>
      </li>-->

<!--        <li class="nav-item pr-3">
        <a class="nav-link" href="#">Contact</a>
      </li>-->
       <li class="nav-item pr-3">
        <a class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#login">Login</a>
      </li>
    </ul>

  </div>
</nav>  
</header>
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h3 class="modal-title" id="exampleModalLabel">Login</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="post" action="process.php">
              <div class="form-group">
                  <div class="input-group">
                       <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                      <input type="text" class="form-control" placeholder="Username" name="uname" required/>
                  </div>
              </div>
                            <div class="form-group">
                  <div class="input-group">
                       <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                      <input type="password" class="form-control" placeholder="Password" name="pass" required/>
                  </div>
              </div>
            
              <div class="form-group float-right">
                  <button type="submit" name="login" class="btn btn-outline-success">Login</button>
              </div>
          </form>
      </div>
      <div class="modal-footer">
     
          <a href="" data-toggle="modal" data-target="#forgotpass" data-dismiss="modal" class="text-danger">Forgot password?</a>
      </div>
    </div>
  </div>
</div>
          <div id="forgotpass" class="modal fade">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-light">
              <h3 class="modal-title">Forgot Password</h3>
             
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center">
                 <p>Enter your email address that you used to register. We'll send you password.</p>
              <form method="POST" action="process.php">
                <div class="form-group">
                  <input type="email" class="form-control" name="email" placeholder="Email Id" required>
                </div>
                  
      
			  <div class="text-center">
                  <button type="submit" name="forgot" class="btn btn-outline-success">Reset</button>
                </div>
              </form>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>
        <div class="cc">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/networkco.jpg" class="d-block w-100 cc" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Network Maintainance</h5>
        <p>Keeps track of network related issues of the organization</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/electricalco.jpg" class="d-block w-100 cc" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Electrical Maintainance</h5>
        <p>Keeps track of electrical related issues of the organization</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/generalco.jpg" class="d-block w-100 cc" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>General Maintainance</h5>
        <p>Keeps track of Genenral issues of the organization</p>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
        </div>
        <section>
        <div class="jumbotron bg-blue">
    <div class="container-fluid text-cust ">
        <center><h1>Repair Work Management</h1>
        <p>An online Maintainance Department under Canara Engineering College</p>
        <button class="btn btn-success" data-toggle="modal" data-target="#login">Login</button></center>
    </div>

    </div>
            
        </section>
     
        <footer class="footers">
          
    <div class="container-fluid bg-dark">
     
    <p class=" text-center text-white">Copyright &copy; 2020 Online | All rights reserved <br>Developed by Major Project Team 29</p>
    
    </div>

        </footer>
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js" ></script>
        <script src="js/sweetalert.js"></script>
        <?php 
        if(isset($_GET['login']))
        {
            $st=$_GET['login'];
            if($st=="failed")
            {
                       echo '<script type="text/javascript">swal("Oops!","Wrong Email / Password Combination .","error");</script>'; 
            }
        }
        if(isset($_GET['forgotpass']))
        {
            $st=$_GET['forgotpass'];
            if($st=="failed")
            {
                       echo '<script type="text/javascript">swal("Oops!","Email Id does not exists .","error");</script>'; 
            }
 else {
      echo '<script type="text/javascript">swal("Successful!","Email has been sent with password. .","success");</script>'; 
 }
        }
        
        ?>
    </body>
</html>
