<?php require_once("autoload.php");

if (!($getUser->is_loggedin())) {
	header("location:login.php");
}
include('public/includes/header.php');
include('public/includes/navbar.php');

?>

<div class="py-5">
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
			</div>
			<div class="col-sm-6">
				<div class="form_container">

					<?php
					if (isset($_GET['updatechangessuccessfully'])) {
						echo '<p class="alert alert-success col-sm-6 text-center mx-auto mt-3" >Profile updated successfully.</p>';
					}

					?>
					<?php
					$row = $fetchUserDetails->fetch_user($_SESSION['userid']);
					?>
					<div class="row">
						<div class="col-sm-3"></div>
						<div class="col-sm-6" style="text-align:center;">Hi &#128075; <strong><?php echo $row['username']; ?></strong></div>
						<div class="col-sm-3"> <a href="editprofile.php"><span style="color:red;float: right;">Edit</span> </a></div>

					</div>
					<hr>
					<div class="row">
						<div class="col-sm-4">
							<div class="field">Name:</div>
						</div>
						<div class="col-sm-8"><?php echo $row['fullname']; ?></div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-4">
							<div class="field">UserName:</div>
						</div>
						<div class="col-sm-8"><?php echo $row['username']; ?></div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-4">
							<div class="field">Email : </div>
						</div>
						<div class="col-sm-8"><?php echo $row['emailid']; ?></div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-4">
							<div class="field">Phone Number : </div>
						</div>
						<div class="col-sm-8"><?php echo $row['userPhoneNumber']; ?></div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-4">
							<div class="field">Gender : </div>
						</div>
						<div class="col-sm-8"><?php echo $row['gender']; ?></div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-4">
							<div class="field">Registered Date: </div>
						</div>
						<div class="col-sm-8"><?php echo $getUser->easy_date($row['created_date']); ?></div>
					</div>
					<hr>
				</div>
			</div>


		</div>
		<div class=" mx-auto col-sm-1">
			<a href="logout.php"><button class="btn btn-primary" style="background-color:red;">Logout</button></a>
		</div>
	</div>
</div>


<?php
include('public/includes/footer.php');
?>