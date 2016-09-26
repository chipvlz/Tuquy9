<?php
$name = $_POST['name'];
$email = $_POST['email'];
$captchar = $_POST['captchar'];

date_default_timezone_set('Asia/Ho_Chi_Minh');

if ($_SESSION["captchar"] != $captchar) {
    print "Mã xác nhận không chính xác, vui lòng thử lại.";
    die;
}
else
{
    $name = str_replace("'", "", str_replace('"', '', $name));
    $email = str_replace("'", "", str_replace('"', '', $email));
    
    $sql = "SELECT * FROM player WHERE LOWER(username)='".strtolower ($name)."'";
    $rs = mysql_query($sql);
    $row = mysql_fetch_array($rs,MYSQL_ASSOC);
    
    if (!$row) {
        print "Tài khoản này không tồn tại, vui lòng thử lại.";
        die;
    }
    
    if ($row["email"] == "") {
        print "Tài khoản này chưa xác nhận địa chỉ email.";
        die;
    }
    
    if ($row["email"] != $email) {
        print "Địa chỉ email không khớp với tài khoản này.";
        die;
    }
    
    require_once 'class/PHPMailer/PHPMailerAutoload.php';
    
    $mail = new PHPMailer;
    
    //$mail->SMTPDebug = 2;                               // Enable verbose debug output
    
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = '';                 // SMTP username
    $mail->Password = '';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
    $mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');
    
    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML
    
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
    
    die;
}



