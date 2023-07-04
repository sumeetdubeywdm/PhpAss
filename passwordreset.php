<?php require_once("autoload.php");

if ($getUser->is_loggedin()) {
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
                        <h3>Reset Password</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_POST['submit_form'])) {
                            $login_var = $_POST['login_var'];
                            $tokenCheck = $_POST['tokenCheck'];
                            $userPassword = $_POST['userPassword'];
                            $cfmUserPassword = $_POST['cfmUserPassword'];

                            $check = $getUser->resetPassValidation($userPassword, $cfmUserPassword,$tokenCheck);

                            if ($check == NULL) {
                                $result = $updatedPassword->resetPassword($userPassword, $tokenCheck,$login_var);
                            }

                            if ($result) {
                                header("location:login.php?passwordupdated=1");
                            } else {
                                $check[] = "Something went wrong...";
                            }

                            if (isset($check)) {
                                foreach ($check as $err) {
                                    echo '<p class = "errormsg alert alert-danger">' . $err . '</p>';
                                }
                            }

                           
                        }
                        ?>

                        <form action="" method="post">
                            <input type="hidden" name="tokenCheck" value="<?php if (isset($_GET['token'])) {
                                                                                echo $_GET['token'];
                                                                            } ?>" id="token_id">

                            <div class="form-floating mb-3 col-sm-8 mx-auto">
                                <input type="text" name="login_var" value="<?php if (isset($_GET['email'])) {
                                                                                echo $_GET['email'];
                                                                            } ?>" class="form-control" id="floatingInput" placeholder="Email" required>
                                <label for="floatingInput">Email</label>
                            </div>


                            <div class="form-floating mb-3 col-sm-8 mx-auto">
                                <input type="password" name="userPassword" class="form-control" id="userPassword" placeholder="Password" required>
                                <label for="floatingPassword">Password</label>
                            </div>

                            <div class="form-floating mb-3 col-sm-8 mx-auto">
                                <input type="password" name="cfmUserPassword" class="form-control" id="cfmUserPassword " placeholder="ConfirmPassword" required>
                                <label for="floatingPassword">Confirm Password</label>
                            </div>



                            <div class="form-group row pb-4 pt-2">
                                <div class="d-grid gap-2 col-6 mx-auto">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" name="submit_form">Update Password</button>
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