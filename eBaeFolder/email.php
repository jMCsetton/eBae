<?php

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require_once('./vendor/autoload.php');

  $mail = new phpmailer(true);


  //Server settings
  $mail->isSMTP();
  $mail->SMTPDebug = 2;
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 587;
  $mail->SMTPSecure = 'tls'; // enable 'tls'  to prevent security issues
  $mail->SMTPAuth = true;
  $mail->Username = 'uclbay.gc06@gmail.com';
  $mail->Password = 'uclbay_gc06';
  // walkaround to bypass server errors
  $mail->SMTPOptions = array(
  'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
      )
  );
  $mail->Subject = 'UCL Databases';
  $mail->Debugoutput = 'html';
  $mail->setFrom('EMAIL', 'PASSWORD');
  $mail->addAddress('german.aqtau@gmail.com', 'German');
  $mail->Subject = 'Auction Expired';
  $mail->Debugoutput = 'html';
  $mail->Body = 'Hi Shabri, 
                   Your auction for has ended!';

  if ($mail->send()){
      echo 'Message sent';
  }

    echo json_encode($mail);

?>