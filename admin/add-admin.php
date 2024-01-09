<?php include('partials/menu.php'); ?>

<!-- Main Content Section Starts -->
	<div class="main-content">
		<div class="wrapper">
			<h1>Add Admin</h1>
			<br><br>

			<?php 
				if(isset($_SESSION['add'])){
					echo $_SESSION['add'];
					unset($_SESSION['add']); 
				}
			?>

			<form action="" method="POST">
				
				<table class="tbl-30">
					<tr>
						<td>Full Name: </td>
						<td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
					</tr>

					<tr>
						<td>Username: </td>
						<td><input type="text" name="username" placeholder="Enter Username"></td>
					</tr>

					<tr>
						<td>Password: </td>
						<td><input type="Password" name="password" placeholder="Enter password"></td>
					</tr>

					<tr>
						<td colspan="2">
							<input type="submit" name="submit" value="Add admin" class="btn-secondary">
						</td>
					</tr>

				</table>
			</form>

			<div class="clearfix"></div>
		</div> 
	</div>
	<!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>

<?php 
//Process the value from form and save it is in database. 
//Check whether submit button is clicked or not

//1. Get the data from form
	if (isset($_POST['submit'])) {
		$full_name = $_POST['full_name'];
		$username = $_POST['username'];
		$password = md5($_POST['password']); //Password Encryption
	}

//2. SQL query to save the data into database
	$sql = "INSERT INTO tbl_admin SET
	full_name = '$full_name',
	username = '$username',
	password = '$password'
	";

//3. Executing query and saving data into database
	$res = mysqli_query($conn, $sql) or die(mysqli_error());

//4. Check whether the data insert or not
	if ($res==TRUE) {
		// Data Inserted and create a session variable to display message
		$_SESSION['add'] = "<div class='success'>Admin added succesfully</div>";
		//Redirect page to manage admin
		header("location:".SITEURL.'admin/manage-admin.php');
		
	}
	else{
		//Insert falied and create a session variable to display message
		$_SESSION['add'] = "<div class='error'>Failed to add admin</div>";
		//Redirect page to manage admin
		header("location:".SITEURL.'admin/add-admin.php');
		
	}
	
?>