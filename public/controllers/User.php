<?php class User extends Basic
{



    public function validation($fullname, $username, $emailid, $userPhoneNumber, $gender, $userPassword, $cfmUserPassword)
    {

        $fullname = $this->sanitize($fullname, 'string');
        $username = $this->sanitize($username, 'string');
        $emailid = $this->sanitize($emailid, 'email');
        $userPhoneNumber = $this->sanitize($userPhoneNumber, 'int');
        $gender = $this->sanitize($gender, 'string');
        $userPassword = $this->sanitize($userPassword, 'string');
        $cfmUserPassword = $this->sanitize($cfmUserPassword, 'string');

        // name validation



        // Name validation 
        if ($fullname == '') {
            $error[] = 'Please enter your Name';
        }
        if (strlen($fullname) <= 2) { // Minimum 
            $error[] = 'Please enter Name using 3 charaters atleast.';
        }

        // name validation end

        /// Username 

        if ($username == '') {
            $error[] = 'Please enter your username';
        }

        $count_username = $sql = "SELECT count(*) FROM users WHERE username=:username";
        $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $count_username = $stmt->fetchColumn();
        if ($count_username > 0) {
            $error[] = 'Username  already exists.';
        }
        /// Username

        if ($emailid == '') {
            $error[] = 'Please enter the email address.';
        }
        if ($emailid != '') {
            if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $emailid)) {
                $error[] = 'Invalid Entry for Email.ie- username@domain.com';
            }
        }



        $count_username = $sql = "SELECT count(*) FROM users WHERE emailid=:emailid";
        $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':email', $emailid, PDO::PARAM_STR);
        $stmt->execute();

        $count_email = $stmt->fetchColumn();
        if ($count_email > 0) {
            $error[] = 'Email  already exists.';
        }

        // Validating Phone Number


        $count_username = $sql = "SELECT count(*) FROM users WHERE userPhoneNumber=:userPhoneNumber";
        $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':userPhoneNumber', $userPhoneNumber, PDO::PARAM_STR);
        $stmt->execute();

        $count_phoneNumber = $stmt->fetchColumn();
        if ($count_phoneNumber > 0) {
            $error[] = 'Phone Number already exists.';
        }


        // Validating Password
        if ($userPassword == '') {
            $error[] = 'Please enter the password';
        }
        if ($userPassword != '') {
            if ($cfmUserPassword == '') {
                $error[] = 'Please enter the confirm password';
            }
        }

        if ($userPassword != $cfmUserPassword) {
            $error[] = "Password don not match";
        }

        $sql = "SELECT count(*) from users WHERE username=:username";
        $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $count_username = $stmt->fetchColumn();

        if ($count_username > 0) {
            $error[] = 'Username already exists';
        }



        // password




        if (isset($error)) {
            return $error;
        } else {
            return $arrayName = [];
        }
    }

    public function resetPassValidation($userPassword,$cfmUserPassword,$tokenCheck){
        
        $userPassword = $this->sanitize($userPassword, 'string');
        $cfmUserPassword = $this->sanitize($cfmUserPassword, 'string');
        $tokenCheck = $this->sanitize($tokenCheck, 'string');


        // Validating Password
        if ($userPassword == '') {
            $check[] = 'Please enter the password';
        }
        if ($userPassword != '') {
            if ($cfmUserPassword == '') {
                $check[] = 'Please enter the confirm password';
            }
        }

        if ($userPassword != $cfmUserPassword) {
            $check[] = "Password don not match";
        }

        if (isset($check)) {
            return $check;
        } else {
            return $arrayName = [];
        }
    }






    public function is_loggedin()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
            return true;
        }
    }


}
