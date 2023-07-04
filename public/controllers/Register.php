<?php

class Register extends Basic{
    
    public function register($fullname, $username, $emailid, $userPhoneNumber, $gender, $userPassword)
    {
        $fullname = $this->sanitize($fullname, 'string');
        $username = $this->sanitize($username, 'string');
        $emailid = $this->sanitize($emailid, 'email');
        $userPhoneNumber = $this->sanitize($userPhoneNumber, 'int');
        $gender = $this->sanitize($gender, 'string');
        $userPassword = $this->sanitize($userPassword, 'string');

        $sql = "INSERT INTO users(fullname,username,emailid,userPhoneNumber,gender,userPassword,created_date) VALUES(:fullname,:username,:emailid,:userPhoneNumber,:gender,:userPassword,:created_date)";
        $stmt = $this->dbConnection->prepare($sql);
        $created_date = $this->get_date();
        $options = array("cost" => 4);

        $hashedpassword = password_hash($userPassword, PASSWORD_BCRYPT, $options);
        $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':emailid', $emailid, PDO::PARAM_STR);
        $stmt->bindParam(':userPhoneNumber', $userPhoneNumber, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
        $stmt->bindParam(':userPassword', $hashedpassword, PDO::PARAM_STR);
        $stmt->bindParam(':created_date', $created_date, PDO::PARAM_STR);
        $res = $stmt->execute();
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

   
}

?>