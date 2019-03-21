<?php include("includes/header.php"); ?>

<?php

if($session->is_login()) {
	redirect("index.php");
}

//if form is submitted
if(isset($_POST['submit'])) {

	$username = trim($_POST['usr_username']);
	$password = trim($_POST['usr_password']);

	//method to check database
	$user_found = User::verify_user($username, $password);


	if($user_found) $session->login($user_found);
	else $error_login_message = "Your Username/Password are incorrect or not exist!";

} else {
	$error_login_message = "";
	$username = "";
	$password = "";
}


?>


<div class="col-md-4 col-md-offset-3">

<h4 class="bg-danger"><?php echo $error_login_message; ?></h4>
	
<form id="login-id" action="" method="post">
	
<div class="form-group">
	<label for="username">Username</label>
	<input type="text" class="form-control" name="usr_username" value="<?php echo htmlentities($username); ?>" >

</div>

<div class="form-group">
	<label for="password">Password</label>
	<input type="password" class="form-control" name="usr_password" value="<?php echo htmlentities($password); ?>">
	
</div>


<div class="form-group">
<input type="submit" name="submit" value="Submit" class="btn btn-primary">

</div>


</form>


</div>