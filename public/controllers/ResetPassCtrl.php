<?php

class ResetPassCtrl extends Basic{
    

    public function resetPassword($userPassword, $tokenCheck,$login_var)
{
    $userPassword = $this->sanitize($userPassword, 'string');
    $tokenCheck = $this->sanitize($tokenCheck, 'string');


    $sql = "SELECT verify_token FROM users WHERE verify_token=:verify_token LIMIT 1";
    $stmt = $this->dbConnection->prepare($sql);
    $stmt->bindParam(':verify_token', $tokenCheck, PDO::PARAM_STR);
    $stmt->execute();
    $count_user = $stmt->fetchColumn();
    echo $count_user;

    if ($count_user > 0) {

        
        $hashedpassword = password_hash($userPassword, PASSWORD_BCRYPT);

        $sql = "UPDATE users SET userPassword = :userPassword WHERE verify_token=:verify_token";
        $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':userPassword', $hashedpassword, PDO::PARAM_STR);
        $stmt->bindParam(':verify_token', $tokenCheck, PDO::PARAM_STR);
        $res = $stmt->execute();


        // update token 


        

        if ($res) {
            $updateToken = md5(rand());


        $send_token = "UPDATE users SET verify_token = :updateToken WHERE emailid = :emailid";
        $stmt = $this->dbConnection->prepare($send_token);
        $stmt->bindParam(':updateToken', $updateToken, PDO::PARAM_STR);
        $stmt->bindParam(':emailid', $login_var, PDO::PARAM_STR);
        $res = $stmt->execute();

            return true;

        }
    }

    return false;
}


   
}

?>