<?php

require 'PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->isSMTP();                                   
$mail->Host = 'smtp.gmail.com';  
$mail->SMTPAuth = true;                               
$mail->Username = 'major.project.team.29.2020@gmail.com';               
$mail->Password = 'MAJORPROJECTteam29';                          
$mail->SMTPSecure = 'ssl';//'tls';                           
$mail->Port = 465;//587; 
$mail->setFrom('major.project.team.29.2020@gmail.com', 'Reapir Work Management ');
$mail->addReplyTo('major.project.team.29.2020@gmail.com','Major Project Team 29');
$mail->isHTML(true);
