<?php include('partials/menu.php'); ?>

<?php 

			if (isset($_GET['id'])) {
				$id = $_GET['id'];
				$sql2 = "SELECT * FROM tbl_spice WHERE id=$id";
				$res2 = mysqli_query($conn, $sql2);
				$row2 = mysqli_fetch_assoc($res2);
				//$count = mysqli_num_rows($res);
					
				$title = $row2['title'];
				$description = $row2['description'];
				$price = $row2['price'];
				$current_image = $row2['image_name'];
				$current_category = $row2['category_id'];
				$featured = $row2['featured'];
				$active = $row2['active'];
				
				/*else{
					$_SESSION['no-category-found'] = "<div class='error'>Category not found.</div>";
					header('location:'.SITEURL.'admin/manage-category.php');
				}*/
			}
			else{
				header('location:'.SITEURL.'admin/manage-spice.php');
			}

		?>

	<div class="main-content">
		<div class="wrapper">
			<h1>Update Spice</h1>
			<br><br>

			<form action="" method="POST" enctype="multipart/form-data">
				
				<table class="tbl-30">
					<tr>
						<td>Title: </td>
						<td><input type="text" name="title" value="<?php echo $title; ?>"></td>
					</tr>

					<tr>
						<td>Description: </td>
						<td>
							<textarea name="description" cols="30" rows="10"><?php echo $description; ?></textarea>
						</td>
					</tr>

					<tr>
						<td>Price(100g): </td>
						<td>
							<input type="number" name="price" value="<?php echo $price; ?>">
						</td>
					</tr>

					<tr>
						<td>Current Image: </td>
						<td>
							<?php 

							if ($current_image != "") {
								?> 
								<img src="<?php echo SITEURL; ?>images/spice/<?php echo $current_image; ?>" width="150px">
								<?php
							}
							else{
								echo "<div class='error'>Image not available.</div>";
							}

							?>
						</td>
					</tr>

					<tr>
						<td>Select New Image: </td>
						<td>
							<input type="file" name="image">
						</td>
					</tr>

					<tr>
						<td>Category: </td>
						<td>
							<select name="category">

								<?php 
									$sql = "SELECT * FROM tbl_category WHERE active='Yes'";
									$res = mysqli_query($conn, $sql);
									$count = mysqli_num_rows($res);

									if ($count>0) {
										while ($row=mysqli_fetch_assoc($res)) {
											$category_id = $row['id'];
											$category_title = $row['title'];

											?>

											<option <?php if ($current_category==$category_id) {
												echo "selected";
											} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

											<?php
											
										}
									}
									else{	 
										echo "<option value='0'>Category Not Avaliable.</option>";	
									}
								?>
							</select>
						</td>
					</tr>

					<tr>
						<td>Featured: </td>
						<td>
							<input <?php if ($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
							<input <?php if ($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
						</td>
					</tr>

					<tr>
						<td>Active: </td>
						<td>
							<input <?php if ($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
							<input <?php if ($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
						</td>
					</tr>

					<tr>
						<td colspan="2">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
							<input type="submit" name="submit" value="Update spice" class="btn-secondary">
						</td>
					</tr>

				</table>
			</form>

			<?php 
				if (isset($_POST['submit'])) {
					$id = $_POST['id'];
					$title = $_POST['title'];
					$description = $_POST['description'];
					$price = $_POST['price'];
					$current_image = $_POST['current_image'];
					$category = $_POST['category'];
					$featured = $_POST['featured'];
					$active = $_POST['active'];

					if (isset($_FILES['image']['name'])) {
						$image_name = $_FILES['image']['name'];

						if ($image_name != "") {
							$src_path= $_FILES['image']['tmp_name'];

							$dest_path= "../images/spice/".$image_name;

							$upload = move_uploaded_file($src_path, $dest_path);

							if ($upload==false) {
								$_SESSION['upload'] = "<div class='error'>Failed to upload new image.</div>";
								header('location:'.SITEURL.'admin/manage-spice.php');
								die();
							}

							if ($current_image!="") {
								$remove_path = "../images/spice/".$current_image;
								$remove = unlink($remove_path);

								if ($remove==false) {
									$_SESSION['remove-failed'] = "<div class='error'>Faile to remove current image.</div>";
									header('location:'.SITEURL.'admin/manage-spice.php');
									die();
								}
							}	
						}
						else{
							$image_name = $current_image;
						}
					}
					else{
						$image_name = $current_image;
					}

					$sql3 = "UPDATE tbl_spice SET
						title = '$title',
						description = '$description',
						price = '$price',
						image_name = '$image_name',
						category_id = '$category',
						featured = '$featured',
						active = '$active'
						WHERE id=$id
					";

					$res3 = mysqli_query($conn, $sql3);

					if ($res3==TRUE) {
						$_SESSION['update'] = "<div class='success'>Spice Updated Successfully</div>";
						header('location:'.SITEURL.'admin/manage-spice.php');
					}
					else{
						$_SESSION['update'] = "<div class='error'>Failed to update spice.</div>";
						header('location:'.SITEURL.'admin/manage-spice.php');
					}

				}
			?>

		</div>
	</div>


<?php include('partials/footer.php'); ?>