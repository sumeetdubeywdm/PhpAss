
<?php
require_once("autoload.php");

if ($getUser->is_loggedin()) {
    header("location:index.php");
}

include('public/includes/header.php');
include('public/includes/navbar.php');


if (isset($_POST['register_btn'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $emailid = $_POST['emailid'];
    $userPhoneNumber = $_POST['userPhoneNumber'];
    $gender = $_POST['gender'];
    $userPassword = $_POST['userPassword'];
    $cfmUserPassword = $_POST['cfmUserPassword'];

    $error = $getUser->validation($fullname, $username, $emailid, $userPhoneNumber, $gender, $userPassword, $cfmUserPassword);

    if (empty($error)) {
        $result = $newUserRegistration->register($fullname, $username, $emailid, $userPhoneNumber, $gender, $userPassword);

        if ($result) {
            header("location:index.php?register=1");
        } else {
            $error[] = "Something went wrong...Unable to register. Please try again.";
        }
    }
}

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
                        if (isset($error)) {
                            foreach ($error as $err) {
                                echo '<p class="errormsg alert alert-danger">' . $err . '</p>';
                            }
                        }
                        ?>
                        <form action="" method="POST" class="needs-validation" novalidate>
                            <div class="form-group row mb-4">
                                <label for="fullname" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="name" class="form-control" id="fullname" name="fullname" placeholder="Enter your full name" value="<?php echo $fullname; ?>" required>
                                    <div class="invalid-feedback">
                                        Please enter your full name.
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="username" class="col-sm-3 col-form-label">Username <span class="required" style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Create your Username" value="<?php echo $username; ?>" required>
                                    <div class="invalid-feedback">
                                        Please choose a username.
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="Emailid" class="col-sm-3 col-form-label">Email <span class="required" style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="Emailid" name="emailid" placeholder="Email" value="<?php echo $emailid; ?>" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid email address.
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="user-phone-number" class="col-sm-3 col-form-label">Phone <span class="required" style="color: red;">*</span></label>
                                <div class="col-sm-2">
                                    <div class="india-ctr-code">
                                        <span class="input-group-text" id="india-ctr-code">+91</span>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <input type="tel" class="form-control" id="user-phone-number" name="userPhoneNumber" placeholder="Enter your Number" value="<?php echo $userPhoneNumber; ?>" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid phone number.
                                    </div>
                                </div>
                            </div>

                            <fieldset class="form-group mb-4">
                                <div class="row">
                                    <legend class="col-form-label col-sm-3 pt-0">Gender</legend>
                                    <div class="col-sm-9">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="male-radio" value="male" <?php if ($gender === 'male') { echo 'checked'; } ?> required>
                                            <label class="form-check-label" for="male-radio">
                                                Male
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="female-radio" value="female" <?php if ($gender === 'female') { echo 'checked'; } ?> required>
                                            <label class="form-check-label" for="female-radio">
                                                Female
                                            </label>
                                        </div>
                                        <div class="invalid-feedback">
                                            Please select your gender.
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group row mb-4">
                                <label for="user-password" class="col-sm-3 col-form-label">Password <span class="required" style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="userPassword" name="userPassword" placeholder="Password" value="<?php echo $userPassword; ?>" required>
                                    <div class="invalid-feedback">
                                        Please enter a password.
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="cfm-user-password" class="col-sm-3 col-form-label">Confirm <span class="required" style="color: red;"> *</span> Password</label>
                                <div class="col-sm-9 mb-2">
                                    <input type="password" class="form-control" id="cfmUserPassword" name="cfmUserPassword" placeholder="Confirm Password" value="<?php echo $cfmUserPassword; ?>" required>
                                    <div class="invalid-feedback">
                                        Please confirm your password.
                                    </div>
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

<script>
  (function () {
    'use strict';

    var forms = document.querySelectorAll('.needs-validation');

    Array.prototype.slice.call(forms).forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        } else {
          var fullname = form.querySelector('#fullname').value.trim();
          var username = form.querySelector('#username').value.trim();
          var emailid = form.querySelector('#emailid').value.trim();
          var userPhoneNumber = form.querySelector('#userPhoneNumber').value.trim();
          var userPassword = form.querySelector('#userPassword').value.trim();
          var cfmUserPassword = form.querySelector('#cfmUserPassword').value.trim();

          var error = [];

          // Name validation
          if (!/^[a-zA-Z\s']+$/.test(fullname)) {
            error.push("Name must only contain alphabets, spaces, and '");
          }

          // Username validation
          if (username === '') {
            error.push("Please enter your username. Username can't be blank.");
          } else if (!/^[a-zA-Z0-9]{4,10}$/.test(username)) {
            error.push("Username must be alphanumeric and have 4 to 10 characters");
          }

          // Email validation
          if (emailid === '') {
            error.push("Please enter your email address");
          } else if (!/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/.test(emailid)) {
            error.push("Invalid email address");
          }

          // Phone number validation
          if (userPhoneNumber === '') {
            error.push("Please enter your phone number. Phone number can't be blank.");
          } else if (!/^[0-9]{10}$/.test(userPhoneNumber)) {
            error.push("Invalid phone number format. Please enter a valid mobile number.");
          }

          // Password validation
          if (userPassword === '') {
            error.push("Please enter your password");
          } else if (cfmUserPassword === '') {
            error.push("Please confirm your password");
          } else if (!/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{4,20}$/.test(userPassword)) {
            error.push("Password must be strong and contain at least one alphabet, one numeric digit, and one special character from !@#$%^&*");
          } else if (userPassword !== cfmUserPassword) {
            error.push("Passwords do not match");
          }

          if (error.length > 0) {
           // event.preventDefault();
            displayErrors(error);
          }
        }

        form.classList.add('was-validated');
      }, false);
    });

    function displayErrors(errors) {
      var errorList = document.querySelector('.error-list');
      errorList.innerHTML = '';

      errors.forEach(function (error) {
        var li = document.createElement('li');
        li.textContent = error;
        errorList.appendChild(li);
      });
    }
  })();
</script>



<?php
include('public/includes/footer.php');
?>