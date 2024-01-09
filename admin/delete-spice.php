<?php 

include('../config/constants.php');

	if (isset($_GET['id']) AND isset($_GET['image_name'])) {
		$id = $_GET['id'];
		$image_name = $_GET['image_name'];

		if ($image_name != "") {
			$path = "../images/spice/".$image_name;
			$remove = unlink($path);

			if ($remove==false) {
				$_SESSION['remove'] = "<div class='error'>Failed to remove spice image.</div>";
				header('location:'.SITEURL.'admin/manage-spice.php');
				die();
			}
		}

		$sql = "DELETE FROM tbl_spice WHERE id=$id";
		$res = mysqli_query($conn, $sql);

		if ($res==TRUE) {
			$_SESSION['delete'] = "<div class='success'>Spice deleted successfully.</div>";
			header('location:'.SITEURL.'admin/manage-spice.php');
		}
		else{
			$_SESSION['delete'] = "<div class='error'>Failed to delete spice.</div>";
			header('location:'.SITEURL.'admin/manage-spice.php');
		}
	}
	else{
		$_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
		header('location:'.SITEURL.'admin/manage-spice.php');
	}	
?>