<?php
require('vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;




class  ForgotPasswordCtrl extends Basic
{

    public function resetpass($get_email,$token)
    {

        try {

            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  //gmail SMTP server
            $mail->SMTPAuth = true;
            //to view proper logging details for success and error messages
            // $mail->SMTPDebug = 1;
            $mail->Host = 'smtp.gmail.com';  //gmail SMTP server
            $mail->Username = 'phptest912@gmail.com';   //email
            $mail->Password = 'crgzmlwntiyimrxb';   //16 character obtained from app password created
            $mail->Port = 465;                    //SMTP port
            $mail->SMTPSecure = "ssl";


            //sender information
            $mail->setFrom('phptest912@gmail.com', 'PhpTest');

            //receiver email address and name
            $mail->addAddress($get_email, '$get_username');

            // Add cc or bcc   
            // $mail->addCC('email@mail.com');  
            // $mail->addBCC('user@mail.com');  


            $mail->isHTML(true);


            $mail->Subject = 'Forgot Password';
            $mail->Body = "
                    <h2>Hello </h2>
                    <h3>Reset Password link</h3>
                    <br/><br/>
                    <a href='http://php.dv/passwordreset.php?token=$token&email=$get_email'>Reset Password</a>
                    ";


            $mail->send();
            
        } catch (Exception $e) {
            echo " Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        $mail->smtpClose();



        // app password- crgzmlwntiyimrxb
   
    }



    public function forgotpass($login_var)
    {

        // $fetchUserDetails = new Fetch($db);
        // $row=$fetchUserDetails->fetch_user(['userid']);
        // $get_username = $row['username'];

        $login_var = $this->sanitize($login_var, 'string');
        // $get_username = $this->sanitize($get_username, 'string');
        $token = md5(rand());

        $sql = "SELECT id,emailid from users WHERE emailid=:emailid limit 1";

        // $sql = "SELECT count(*) FROM users WHERE emailid=:emailid LIMIT 1";
        $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':emailid', $login_var, PDO::PARAM_STR);
        
        $stmt->execute();
        $count_user = $stmt->fetchColumn();

        if ($count_user > 0) {

            // $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // $get_username = $row['username'];
            $get_email = $login_var;

            $send_token = "UPDATE users SET verify_token = :token WHERE emailid = :emailid";
            $stmt = $this->dbConnection->prepare($send_token);
            $stmt->bindParam(':token', $token, PDO::PARAM_STR);
            $stmt->bindParam(':emailid', $login_var, PDO::PARAM_STR);
            $res = $stmt->execute();

            if ($res) {
                // sendPasswordReset($get_username,$get_email,$token);
                $this->resetpass($get_email,$token);
                echo '<div class="errormsg alert alert-success">we mailed password reset link.</div>';
            }


            return true;
        } else {
            return false;
        }
    }




}
