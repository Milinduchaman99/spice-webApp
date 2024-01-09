<?php include('../config/constants.php'); ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - Spice Ordering System</title>

	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>
	<div class="login">
		<h1 class="text-center">Login</h1>
		<br><br>

		<?php 
				if(isset($_SESSION['login'])){
					echo $_SESSION['login'];
					unset($_SESSION['login']); 
				}

				if(isset($_SESSION['no-login-message'])){
					echo $_SESSION['no-login-message'];
					unset($_SESSION['no-login-message']); 
				}

		?>
		<br><br>

		<form action="" method="POST" class="text-center">
			Username: <br>
			<input type="text" name="username" placeholder="Enter Your Username"><br><br>

			Password: <br>
			<input type="password" name="password" placeholder="Enter Your Password"><br><br>

			<input type="submit" name="submit" value="Login" class="btn-primary">
		</form>


	</div>
</body>
</html>

<?php 

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
	$res = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($res);

	if ($count==1) {
		$_SESSION['login'] = "<div class='success'>Login Successfully</div>";
		$_SESSION['user'] = $username;
		header('location:'.SITEURL.'admin/');
	}
	else{
		$_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
		header('location:'.SITEURL.'admin/login.php');
	}
}


?>