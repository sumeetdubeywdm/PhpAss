<?php

class Login extends Basic{
    
    public function login($login_var, $password)
    {
        $login_var = $this->sanitize($login_var, 'string');
        $password = $this->sanitize($password, 'string');


        $sql = "SELECT count(*) from users WHERE username=:username OR emailid=:emailid limit 1";
        $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':username', $login_var, PDO::PARAM_STR);
        $stmt->bindParam(':emailid', $login_var, PDO::PARAM_STR);
        $stmt->execute();
        $count_user = $stmt->fetchColumn();
        if ($count_user > 0) {
            $sql = "SELECT id,userPassword from users WHERE username=:username OR emailid=:emailid limit 1";
            $stmt = $this->dbConnection->prepare($sql);
            $stmt->bindParam(':username', $login_var, PDO::PARAM_STR);
            $stmt->bindParam(':emailid', $login_var, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['userPassword'])) {
                $_SESSION["logged_in"] = "1";
                $_SESSION["userid"] = $row['id'];
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
  

}

?>