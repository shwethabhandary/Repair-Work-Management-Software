<?php
include 'conn.php';
include 'includes/PHPMailer/mail.php';
function sendpassword($email,$pass,$mail)
{
   $mail->addAddress($email);  
    $mail->Subject = 'Repair Work Management Login'; 
    $mail->Body='<table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
              <tbody><tr>
                <td>
                  <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                    <tbody><tr>
                      <td align="center" style="padding-bottom:20px;">
                     
                      </td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
              
              <tr>
                <td>
                  <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                    <tbody><tr>
                      <td bgcolor="#fafbfc" style="width:7px; font-size:1px;">&nbsp;</td>
                      <td bgcolor="#f5f6f7" style="width:1px; font-size:1px;">&nbsp;</td>
                      <td bgcolor="#f0f2f3" style="width:1px; font-size:1px;">&nbsp;</td>
                      <td bgcolor="#edeef1" style="width:1px; font-size:1px;">&nbsp;</td>
                      <td bgcolor="#ffffff">
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                          <tbody><tr>
                            <td style="text-align:center; padding:40px 40px 40px 40px; border-top:3px solid #69A3FA;">
                            
                              <div style="display:inline-block; width:100%; max-width:520px;">
                                <table border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; font-size:14px; line-height:24px; color:#525C65; text-align:left; width:100%;">
                                  <tbody><tr>
                                    <td>
                                      <p style="Margin:0; font-size:18px; line-height:23px; color:#102231; font-weight:bold;">
                                        <strong>
                                          Dear, 
                                         '.$email.'</strong><br><br>
                                      </p>
                                    </td>
                                  </tr>
                                  
<tr>
    <td style="font-size: 25px; font-weight: bold; color:#69A3FA; ">
		Welcome to Repair Work Management<br><br>
               
	</td>
</tr>
<tr>
    <td style="line-height: 35px; padding-bottom: 20px;">
       This is your Login Credentials :
       <br>
       Username : <strong>'.$email.'</strong>
       <br>
       Password : <strong>'.$pass.'</strong>
    </td>
</tr>
         <tr>
                                    <td style="font:14px/16px Arial, Helvetica, sans-serif; color:#363636; padding:0 0 14px;">
                                      Regards,
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="font:bold 14px/16px Arial, Helvetica, sans-serif; color:#363636; padding:0 0 7px;">
                                      Major Project Team 29
                                    </td>
                                  </tr>
                                  
                                </tbody></table>
                              </div>
                           
                            </td>
                          </tr>
                          <tr>
                            <td bgcolor="#e0e2e5" style="height:1px; width:100%; line-height:1px; font-size:0;">&nbsp;</td>
                          </tr>
                          <tr>
                            <td bgcolor="#e0e2e4" style="height:1px; width:100%; line-height:1px; font-size:0;">&nbsp;</td>
                          </tr>
                          <tr>
                            <td bgcolor="#e8ebed" style="height:1px; width:100%; line-height:1px; font-size:0;">&nbsp;</td>
                          </tr>
                          <tr>
                            <td bgcolor="#f1f3f6" style="height:1px; width:100%; line-height:1px; font-size:0;">&nbsp;</td>
                          </tr>
                        </tbody></table>
                      </td>
                      <td bgcolor="#edeef1" style="width:1px; font-size:1px;">&nbsp;</td>
                      <td bgcolor="#f0f2f3" style="width:1px; font-size:1px;">&nbsp;</td>
                      <td bgcolor="#f5f6f7" style="width:1px; font-size:1px;">&nbsp;</td>
                      <td bgcolor="#fafbfc" style="width:7px; font-size:1px;">&nbsp;</td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
             <tr>
                <td align="center" style="padding-bottom:30px; padding-top: 30px;">
                  <table border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; font-size:12px; line-height:18px;  text-align:center; width:auto;">
                    <tbody><tr>
                      <td style="color:#b7bdc1;">
                        
                        <p style="Margin:0;">Copyright &copy; Major Project Team 29 <br>This e-mail is autogenerated, may contain trade secrets or privileged, confidential information. If you have received this e-mail in error, Please ignore.</p>
                      </td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
            
            </tbody></table>';
    $mail->AltBody = '';
   $mail->send(); 
}
if (isset($_POST['login'])) {
     unset($_POST['login']);
     
     $uname = stripslashes($_POST['uname']);
        $uname = mysqli_real_escape_string($conn,$uname);
        $password = stripslashes($_POST['pass']);
        $password = mysqli_real_escape_string($conn,$password);
        $query = "SELECT * FROM `staff` WHERE email='$uname' AND pass='$password'";
                $result = mysqli_query($conn,$query);
                $rows = mysqli_num_rows($result);
                $data = mysqli_fetch_array($result);
                if($rows == 1){
                           if($data['auth'] == 'staff'){
                   $_SESSION['staff']=$data['id'];
                            header("Location: dashboard.php");
                            exit();
                           }
                         else if($data['auth'] == 'general' || $data['auth'] == 'electrical' || $data['auth'] == 'networking'){
                            $_SESSION['officer_id']=$data['id'];
                            $_SESSION['officer_cat']=$data['auth'];
                            header("Location: go_dashboard.php");
                            exit();
                        }
                         else{
                        header('Location: index.php?login=failed');
                        exit();
                    }
                }else{
          $query = "SELECT * FROM users WHERE email='$uname' AND password='$password'";
            $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
            $rows = mysqli_num_rows($result);
            $data = mysqli_fetch_assoc($result);
                if($rows == 1){
                        if($data['auth'] == 'sadmin'){
                            $_SESSION['admin']=$data['id'];
                            header("Location: admin/index.php");
                            exit();
                        }    
                        else if($data['auth'] == 'hodcs' || $data['auth'] == 'hodis' || $data['auth'] == 'hodec' || $data['auth'] == 'hodme' || $data['auth'] == 'hos' || $data['auth'] == 'can'){
                            $_SESSION['hod']=$data['id'];
                            header("Location: hod_dashboard.php");
                            exit();
                        }
                       
                        else if($data['auth'] == 'principal'){
                              $_SESSION['principal']=$data['id'];
                            header("Location: prin_dashboard.php");
                            exit();
                        }
                        
                         
                        else{
                        header('Location: index.php?login=failed');
                        exit();
                    }
                    }else{
                        header('Location: index.php?login=failed');
                        exit();
                    }
                }
                
            
}
        
    if (isset($_POST['forgot'])) {
    
     $email = stripslashes($_POST['email']);
     $email = mysqli_real_escape_string($conn,$email);
        $query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn,$query);
        if(mysqli_num_rows($result) == 1){
            $rows = mysqli_fetch_assoc($result);
            sendpassword($rows['email'], $rows['password'], $mail);

            header('Location: index.php?forgotpass=success');
            exit();
        }
        else 
        {$query = "SELECT * FROM staff WHERE email='$email'";
        $result = mysqli_query($conn,$query);
            if(mysqli_num_rows($result) == 1){
              
            $rows = mysqli_fetch_assoc($result);
            sendpassword($rows['email'], $rows['pass'], $mail);

            header('Location: index.php?forgotpass=success');
            exit();
        }
        }
      
            header('Location: index.php?forgotpass=failed');
            exit();
       
        
     
     
} 

