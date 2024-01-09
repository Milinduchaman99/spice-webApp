<?php include('partials/menu.php'); ?>

	<!-- Main Content Section Starts -->
	<div class="main-content">
		<div class="wrapper">
			<h1>Manage Spice</h1>

			<br><br>
			<!-- Button to Add Spice -->
			<a href="<?php echo SITEURL; ?>admin/add-spice.php" class="btn-primary">Add Spice</a>
			<br><br>

			<?php 

				if(isset($_SESSION['add'])){
						echo $_SESSION['add'];
						unset($_SESSION['add']); 
					}

				if(isset($_SESSION['delete'])){
						echo $_SESSION['delete'];
						unset($_SESSION['delete']); 
					}

				if(isset($_SESSION['remove'])){
						echo $_SESSION['remove'];
						unset($_SESSION['remove']); 
					}

				if(isset($_SESSION['unauthorize'])){
						echo $_SESSION['unauthorize'];
						unset($_SESSION['unauthorize']); 
					}

				if(isset($_SESSION['update'])){
						echo $_SESSION['update'];
						unset($_SESSION['update']); 
					}	

			?>

			<table class="tbl-full">
				<tr>
					<th>S.N.</th>
					<th>Title</th>
					<th>Price</th>
					<th>Image</th>
					<th>Featured</th>
					<th>Active</th>
					<th>Actions</th>
				</tr>

				<?php 

				$sql = "SELECT * FROM tbl_spice";
				$res = mysqli_query($conn, $sql);
				$count = mysqli_num_rows($res);
				$sn = 1;

				if ($count>0) {
					while ($row=mysqli_fetch_assoc($res)) {
						$id = $row['id'];
						$title = $row['title'];
						$price = $row['price'];
						$image_name = $row['image_name'];
						$featured = $row['featured'];
						$active = $row['active'];

						?> 

						<tr>
							<td><?php echo $sn++; ?>.</td>
							<td><?php echo $title; ?></td>
							<td>Rs.<?php echo $price; ?></td>
							<td>
								<?php 

									if ($image_name=="") {
										echo "<div class='error'>Image not added.</div>";
									}
									else{
										?> 
										<img src="<?php echo SITEURL; ?>images/spice/<?php echo $image_name; ?>" width="100px">
										<?php
									}

								?>		
							</td>
							<td><?php echo $featured; ?></td>
							<td><?php echo $active; ?></td>
							<td>
								<a href="<?php echo SITEURL; ?>admin/update-spice.php?id=<?php echo $id; ?>" class="btn-secondary">Update Spice</a>
								<a href="<?php echo SITEURL; ?>admin/delete-spice.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Spice</a>
							</td>
						</tr>

						<?php
					}
				}
				else{
					echo "<tr> <td colspan='7' class='error'> Spice not added yet. </td></tr>";
				}

				?>

				
			</table>

			<div class="clearfix"></div>
		</div> 
	</div>
	<!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>