<?php class UpdatedprofileCtrl extends Basic
{



    public function profileValidation($fullname,$username,$emailid,$userPhoneNumber)
    {

        $fullname = $this->sanitize($fullname, 'string');
        $username = $this->sanitize($username, 'string');
        $emailid = $this->sanitize($emailid, 'email');
        $userPhoneNumber = $this->sanitize($userPhoneNumber, 'int');


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
        }


        // Phone number validation
        if ($userPhoneNumber === '') {
            $error[] = 'Please enter your phone number';
        } elseif (!preg_match('/^(?:\+91|0)?[1-9][0-9]{9}$/', $userPhoneNumber)) {
            $error[] = 'Invalid phone number format. Please enter a valid Indian mobile number.';
        }



        if (isset($error)) {
            return $error;
        } else {
            return $arrayName = [];
        }
    }

    public function saveProfileChanges($fullname,$username,$emailid,$userPhoneNumber){
       
        $fullname = $this->sanitize($fullname, 'string');
$username = $this->sanitize($username, 'string');
$emailid = $this->sanitize($emailid, 'email');
$userPhoneNumber = $this->sanitize($userPhoneNumber, 'int');

$sql = "UPDATE users SET fullname = :fullname, emailid = :emailid, userPhoneNumber = :userPhoneNumber WHERE username = :username";
$stmt = $this->dbConnection->prepare($sql);

$stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->bindParam(':emailid', $emailid, PDO::PARAM_STR);
$stmt->bindParam(':userPhoneNumber', $userPhoneNumber, PDO::PARAM_STR);
$res = $stmt->execute();

if ($res) {
    return true;
} else {
    return false;
}

    }



   

}
