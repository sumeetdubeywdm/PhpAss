<?php require_once("autoload.php");
if (!($getUser->is_loggedin())) {
    header("location:login.php");
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
                        <h3>Edit Profile</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        $row = $fetchUserDetails->fetch_user($_SESSION['userid']);
                        ?>
                        <?php
                        if (isset($_POST['saveChanges_btn'])) {
                            $fullname = $_POST['fullname'];
                            $username = $_POST['username'];
                            $emailid = $_POST['emailid'];
                            $userPhoneNumber = $_POST['userPhoneNumber'];
                            $gender = $_POST['gender'];

                            $error = $updateProfile->profileValidation($fullname, $username, $emailid, $userPhoneNumber, $gender);

                            if ($error == NULL) {
                                $result = $updateProfile->saveProfileChanges($fullname, $username, $emailid, $userPhoneNumber, $gender);

                                if ($result) {
                                    header("location:profile.php?updatechangessuccessfully=1");
                                } else {
                                    $error[] = "Something went wrong...";
                                }
                            }


                            if (isset($error)) {
                                foreach ($error as $err) {
                                    echo '<p class = "errormsg alert alert-danger">' . $err . '</p>';
                                }
                            }
                        }
                        ?>
                        <form action="" method="POST">
                            <div class="form-group row mb-4">
                                <label for="fullname" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="name" class="form-control" id="fullname" name="fullname" value="<?php echo $row['fullname']; ?>">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="username" class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Create your Username" value="<?php echo $row['username']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="Emailid" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="Emailid" name="emailid" placeholder="Email" value="<?php echo $row['emailid']; ?>">
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
                                    <input type="tel" class="form-control" id="user-phone-number" name="userPhoneNumber" placeholder="Enter your Number" value="<?php echo $row['userPhoneNumber']; ?>">
                                </div>
                            </div>
                            <fieldset class="form-group mb-4">
                                <div class="row">
                                    <legend class="col-form-label col-sm-3 pt-0">Gender</legend>
                                    <div class="col-sm-9">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="male-radio" value="Male" <?php echo ($row['gender'] === 'Male') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="male-radio">
                                                Male
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="female-radio" value="Female" <?php echo ($row['gender'] === 'Female') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="female-radio">
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>



                            <div class="form-group row mb-4 text-center">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary" name="saveChanges_btn">save
                                        changes</button>
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