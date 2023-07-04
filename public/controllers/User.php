<?php class User extends Basic
{



    public function validation($fullname, $username, $emailid, $userPhoneNumber, $gender, $userPassword, $cfmUserPassword)
    {
        $fullname = $this->sanitize($fullname, 'string');
        $username = $this->sanitize($username, 'string');
        $emailid = $this->sanitize($emailid, 'email');
        $userPhoneNumber = $this->sanitize($userPhoneNumber, 'string');
        $gender = $this->sanitize($gender, 'string');
        $userPassword = $this->sanitize($userPassword, 'string');
        $cfmUserPassword = $this->sanitize($cfmUserPassword, 'string');
    
        $error = array();
    
        // Username validation
        if ($username === '') {
            $error[] = 'Please enter your username';
        } elseif (!preg_match('/^[a-zA-Z0-9]{4,10}$/', $username)) {
            $error[] = 'Username must be alphanumeric and have 4 to 10 characters';
        }

        $sql = "SELECT count(*) FROM users WHERE username=:username";
        $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $count_username = $stmt->fetchColumn();
        if ($count_username > 0) {
            $error[] = 'Username  already exists.';
        }
    
        // Name validation
        if ($fullname === '') {
            $error[] = 'Please enter your name';
        } elseif (!preg_match('/^[a-zA-Z\s\']+$/', $fullname)) {
            $error[] = "Name must only contain alphabets, spaces, and '";
        }
    
        // Phone number validation
        if ($userPhoneNumber === '') {
            $error[] = 'Please enter your phone number';
        } elseif (!preg_match('/^(?:\+91|0)?[1-9][0-9]{9}$/', $userPhoneNumber)) {
            $error[] = 'Invalid phone number format. Please enter a valid Indian mobile number.';
        }

        $count_username = $sql = "SELECT count(*) FROM users WHERE userPhoneNumber=:userPhoneNumber";
        $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':userPhoneNumber', $userPhoneNumber, PDO::PARAM_STR);
        $stmt->execute();

        $count_phoneNumber = $stmt->fetchColumn();
        if ($count_phoneNumber > 0) {
            $error[] = 'Phone Number already exists.';
        }



    
        // Password validation
        if ($userPassword === '') {
            $error[] = 'Please enter your password';
        } elseif ($cfmUserPassword === '') {
            $error[] = 'Please confirm your password';
        } elseif (!preg_match('/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{4,20}$/', $userPassword)) {
            $error[] = 'Password must be strong and contain at least one alphabet, one numeric digit, and one special character from !@#$%^&*';
        } elseif ($userPassword !== $cfmUserPassword) {
            $error[] = 'Passwords do not match';
        }
    
        // Email validation
        if ($emailid === '') {
            $error[] = 'Please enter your email address';
        } elseif (!filter_var($emailid, FILTER_VALIDATE_EMAIL)) {
            $error[] = 'Invalid email address';
        }

        $count_username = $sql = "SELECT count(*) FROM users WHERE emailid=:emailid";
        $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':email', $emailid, PDO::PARAM_STR);
        $stmt->execute();

        $count_email = $stmt->fetchColumn();
        if ($count_email > 0) {
            $error[] = 'Email  already exists.';
        }
    
        // Gender validation
        if ($gender === '') {
            $error[] = 'Please select your gender';
        }
    
        if (!empty($error)) {
            return $error;
        } else {
            return array();
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
