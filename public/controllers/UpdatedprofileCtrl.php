<?php class UpdatedprofileCtrl extends Basic
{



    public function profileValidation($fullname, $username, $emailid, $userPhoneNumber, $gender)
    {
        $fullname = $this->sanitize($fullname, 'string');
        $username = $this->sanitize($username, 'string');
        $emailid = $this->sanitize($emailid, 'email');
        $userPhoneNumber = $this->sanitize($userPhoneNumber, 'int');
        $gender = $this->sanitize($gender, 'string');
    
        $error = [];
    
        // Name validation
        if ($fullname === '') {
            $error[] = 'Please enter your name';
        } elseif (!preg_match('/^[a-zA-Z\s\']+$/', $fullname)) {
            $error[] = "Name must only contain alphabets, spaces, and '";
        }
    
        // Email validation
        if ($emailid === '') {
            $error[] = 'Please enter your email address';
        } elseif (!filter_var($emailid, FILTER_VALIDATE_EMAIL)) {
            $error[] = 'Invalid email address';
        } else {
            // Check if email exists for any user except the current username
            $stmt = $this->dbConnection->prepare("SELECT * FROM users WHERE emailid = :emailid AND username != :username");
            $stmt->bindParam(':emailid', $emailid, PDO::PARAM_STR);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $error[] = 'Email address already exists';
            }
        }
    
        // Phone number validation
        if ($userPhoneNumber === '') {
            $error[] = 'Please enter your phone number';
        } elseif (!preg_match('/^[0-9]{10}$/', $userPhoneNumber)) {
            $error[] = 'Invalid phone number format. Please enter a valid Indian mobile number.';
        } else {
            // Check if phone number exists for any user except the current username
            $stmt = $this->dbConnection->prepare("SELECT * FROM users WHERE userPhoneNumber = :userPhoneNumber AND username != :username");
            $stmt->bindParam(':userPhoneNumber', $userPhoneNumber, PDO::PARAM_INT);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $error[] = 'Phone number already exists';
            }
        }
    
        if (isset($error)) {
            return $error;
        } else {
            return [];
        }
    }
    

    public function saveProfileChanges($fullname, $username, $emailid, $userPhoneNumber, $gender)
    {

        $fullname = $this->sanitize($fullname, 'string');
        $username = $this->sanitize($username, 'string');
        $emailid = $this->sanitize($emailid, 'email');
        $userPhoneNumber = $this->sanitize($userPhoneNumber, 'int');
        $gender = $this->sanitize($gender, 'string');

        $sql = "UPDATE users SET fullname = :fullname, emailid = :emailid, userPhoneNumber = :userPhoneNumber, gender = :gender WHERE username = :username";
        $stmt = $this->dbConnection->prepare($sql);

        $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':emailid', $emailid, PDO::PARAM_STR);
        $stmt->bindParam(':userPhoneNumber', $userPhoneNumber, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
        $res = $stmt->execute();

        if ($res) {
            return true;
        } else {
            return false;
        }
    }
}
