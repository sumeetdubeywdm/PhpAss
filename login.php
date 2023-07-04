<?php require_once('autoload.php');
if($getUser->is_loggedin())
{
	header("location:index.php"); 
}
include('public/includes/header.php');
include('public/includes/navbar.php');
?>

<?php 
if (isset($_GET['passwordupdated'])) {
    echo '<p class="alert alert-success col-sm-6 text-center mx-auto mt-3" >Password Updated successfully please login.</p>';
}
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
   
                    <div class="card-header text-center">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_POST['submit_form'])) {
                            $login_var = $_POST['login_var'];
                            $password = $_POST['password'];
                            $check = $getUserLoginDeatils->login($login_var, $password);
                            if ($check) {
                                header("location:index.php");
                            } else {
                                echo '<div class="errormsg alert alert-danger">Invalid login credentials ,Please try again .. </div>';
                            }
                        }
                   
                        ?>
                        <form action="" method="post"> 
                            <h5 class="fw-normal pb-3 pt-2 text-center" style="letter-spacing: 1px;">Sign into your account</h5>

                            <div class="form-floating mb-3 col-sm-8 mx-auto">
                                <input type="text" name="login_var" value="<?php if (isset($check)) {
                                                                                echo $login_var;
                                                                            } ?>" class="form-control" id="floatingInput" placeholder="Username or Email" required>
                                <label for="floatingInput">Username or Email</label>
                            </div>


                            <div class="form-floating mb-3 col-sm-8 mx-auto">
                                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                                <label for="floatingPassword">Password</label>
                            </div>


                            <p class="small mb-3 text-center"><a class="" href="forgotPassword.php">Forgot password?</a></p>
                            <div class="form-group row pb-4 pt-2">
                                <div class="d-grid gap-2 col-6 mx-auto">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" name="submit_form">Login</button>
                                </div>
                            </div>


                            <p class="pb-lg-2 text-center" >Don't have an account? <a href="register.php" style="color: #393f81;">Register here</a></p>
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