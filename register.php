<?php require_once("autoload.php");
// include('config.php');
if($getUser->is_loggedin())
{
	header("location:index.php"); 
}
include('public/includes/header.php');
include('public/includes/navbar.php');

?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Register</h3>
                    </div>
                    <div class="card-body">

                    <?php
if(isset($_POST['register_btn'])){
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $emailid = $_POST['emailid'];
    $userPhoneNumber = $_POST['userPhoneNumber'];
    $gender = $_POST['gender'];
    $userPassword = $_POST['userPassword'];
    $cfmUserPassword = $_POST['cfmUserPassword'];

    $error=$getUser->validation($fullname,$username,$emailid,$userPhoneNumber,$gender,$userPassword,$cfmUserPassword);
   
    if($error == NULL){
    $result=$newUserRegistration->register($fullname,$username,$emailid,$userPhoneNumber,$gender,$userPassword);

    if($result){
        header("location:index.php?register=1");
       
    }
    else{
        $error[] = "Something went wrong...";
    }   
    }


    if(isset($error)){
        foreach($error as $err){
            echo '<p class = "errormsg alert alert-danger">'.$err.'</p>';
        }
    }
}
                    ?>
                        <form action="" method="POST">
                            <div class="form-group row mb-4">
                                <label for="fullname" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="name" class="form-control" id="fullname" name="fullname" placeholder="Enter your full name">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="username" class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="username" name="username"  placeholder="Create your Username">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="Emailid" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="Emailid" name="emailid" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="user-phone-number" class="col-sm-3 col-form-label">Phone</label>
                                <div class="col-sm-2">
                                <div class="india-ctr-code">
                                        <span class="input-group-text" id="india-ctr-code">+91</span>
                                    </div>
                                </div>
                                
                                <div class="col-sm-7">
                                    <input type="tel" class="form-control" id="user-phone-number" name="userPhoneNumber" placeholder="Enter your Number">
                                </div>
                            </div>


                            <fieldset class="form-group mb-4">
                                <div class="row ">
                                    <legend class="col-form-label col-sm-3 pt-0">Gender</legend>
                                    <div class="col-sm-9">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="male-radio" value="male">
                                            <label class="form-check-label" for="male-radio">
                                                Male
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="female-radio" value="female">
                                            <label class="form-check-label" for="female-radio">
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group row mb-4">
                                <label for="user-password" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="userPassword" name="userPassword" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="cfm-user-password" class="col-sm-3 col-form-label">Confirm Password</label>
                                <div class="col-sm-9 mb-2">
                                    <input type="password" class="form-control" id="cfmUserPassword" name="cfmUserPassword" placeholder="Confirm Password">
                                </div>
                            </div>
                            <div class="form-group row mb-4 text-center">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary" name="register_btn">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<?php
include('public/includes/footer.php');
?>