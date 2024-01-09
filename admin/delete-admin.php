<?php 

include('../config/constants.php');

//1. Get the id of admin to be delete
	$id = $_GET['id'];

//2. Create sql query to delete admin
	$sql = "DELETE FROM tbl_admin WHERE id=$id";

//Execute the query
	$res = mysqli_query($conn, $sql);

//Checking whether the query executed successfully or not
	if ($res==TRUE) {
		$_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
		header('location:'.SITEURL.'admin/manage-admin.php');
	}
	else{
		$_SESSION['delete'] = "<div class='error'>Failed to delete admin. Try again later</div>";
		header('location:'.SITEURL.'admin/manage-admin.php');
	}
?>