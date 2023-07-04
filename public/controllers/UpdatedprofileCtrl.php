<?php class UpdatedprofileCtrl extends Basic
{



    public function profileValidation($fullname,$username,$emailid,$userPhoneNumber)
    {

        $fullname = $this->sanitize($fullname, 'string');
        $username = $this->sanitize($username, 'string');
        $emailid = $this->sanitize($emailid, 'email');
        $userPhoneNumber = $this->sanitize($userPhoneNumber, 'int');


        // name validation



        // Name validation 
        if ($fullname == '') {
            $error[] = 'Please enter your Name';
        }
        if (strlen($fullname) <= 2) { // Minimum 
            $error[] = 'Please enter Name using 3 charaters atleast.';
        }


      

        if ($emailid == '') {
            $error[] = 'Please enter the email address.';
        }
        if ($emailid != '') {
            if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $emailid)) {
                $error[] = 'Invalid Entry for Email.ie- username@domain.com';
            }
        }

        if ($userPhoneNumber== '') {
            $error[] = 'Please enter phone number.';
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
