<?php
include 'conn.php';
include 'includes/PHPMailer/mail.php';
function sendmail($compid,$mail,$conn)
{
    $result= mysqli_query($conn, "SELECT * FROM complaint WHERE id='$compid'");
    $row= mysqli_fetch_assoc($result);
    $due=date('d-m-Y',strtotime($row['due']));
    $complaint="COMP".sprintf("%03d",$compid);
    $sub=$row['sub'];
    $desc=$row['descp'];
    $id=$row['cat'];
    $result= mysqli_query($conn, "SELECT * FROM category WHERE catid='$id'");
    $row= mysqli_fetch_assoc($result);
    $id=$row['head'];
    $result= mysqli_query($conn, "SELECT * FROM staff WHERE id='$id'");
    $row= mysqli_fetch_assoc($result);
    $email=$row['email'];
    $name=$row['name'];
   $mail->addAddress($email);  
    $mail->Subject = 'Repair Work Management | Complaint Due Date Crossed'; 
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
                                         '.$name.'</strong><br><br>
                                      </p>
                                    </td>
                                  </tr>
                                  
<tr>
    <td style="font-size: 25px; font-weight: bold; color:#69A3FA; ">
		Welcome to Repair Work Management<br><br>
               
	</td>
</tr>
<tr>
    <td style="font-size: 20px; font-weight: bold; color:#69A3FA; ">
		A Complaint under your category with Due date '.$due.' is crossed.<br><br>
               
	</td>
</tr>
<tr>
    <td style="line-height: 35px; padding-bottom: 20px;">
       Complaint Details :
       <br>
       Complaint ID : <strong>'.$complaint.'</strong>
       <br>
       Subject : <strong>'.$sub.'</strong>
       <br>
       Description : <strong>'.$desc.'</strong>
       <br>
       Due Date : <strong>'.$due.'</strong>
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
    $mail->ClearAllRecipients(); 
}
function duedate_check($mail,$conn)
{
    $query="SELECT * FROM complaint WHERE due < CURDATE() AND status='Approved'";
    $result= mysqli_query($conn, $query);
    while($row= mysqli_fetch_array($result))
    {
        $compid=$row['id'];
        sendmail($compid, $mail, $conn);
    }
}
duedate_check($mail, $conn);

?>