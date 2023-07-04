<?php require_once("autoload.php");
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
                    <div class="card-header text-center pt-4">
                        <h4>Forgot Password</h4>
                    </div>
                    <div class="card-body">
                    <?php
                        if (isset($_POST['submitForgotPassword'])) {
                            $login_var = $_POST['login_var'];

                          
                            $check = $userForgotPassword->forgotpass($login_var);
                            if ($check) {
                               
                                // echo '<div class="errormsg alert alert-success">success</div>';
                            } else {
                                echo '<div class="errormsg alert alert-danger">No Email found!!! </div>';
                            }
                        }
                   
                        ?>
                        <form action="" method="post"> 

                            <div class="form-floating mb-3 col-sm-8 mx-auto">
                                <input type="text" name="login_var"  class="form-control" id="floatingInput" placeholder="Enter your Email id" required>
                                <label for="floatingInput"> Enter your Email</label>
                            </div>


                            <div class="form-group row pb-4 pt-2">
                                <div class="d-grid gap-2 col-6 mx-auto">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" name="submitForgotPassword">Send Me Password</button>
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
include('public/include/footer.php');
?>