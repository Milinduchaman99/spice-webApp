<?php include('partials/menu.php'); ?>

	<!-- Main Content Section Starts -->
	<div class="main-content">
		<div class="wrapper">
			<h1>Manage Order</h1>

			<br><br>

			<table class="tbl-full">
				<tr>
					<th>S.N.</th>
					<th>Spice</th>
					<th>Price</th>
					<th>Total</th>
					<th>Order Date</th>
					<th>Status</th>
					<th>Name</th>
					<th>Contact</th>
					<th>Email</th>
					<th>Address</th>
					<th>Actions</th>
				</tr>

				<?php 

				$sql = "SELECT * FROM tbl_order";
				$res = mysqli_query($conn, $sql);
				$count = mysqli_num_rows($res);
				$sn = 1;

				if ($count>0) {
					while ($row=mysqli_fetch_assoc($res)) {
						$id = $row['id'];
						$spice = $row['spice'];
						$price = $row['price'];
						$qty = $row['qty'];
						$total = $row['total'];
						$order_date = $row['order_date'];
						$status = $row['status'];
						$customer_name = $row['customer_name'];
						$customer_contact = $row['customer_contact'];
						$customer_email = $row['customer_email'];
						$customer_address = $row['customer_address'];

						?> 

						<tr>
							<td><?php echo $sn++; ?></td>
							<td><?php echo $spice; ?></td>
							<td><?php echo $price; ?></td>
							<td><?php echo $qty; ?></td>
							<td><?php echo $total; ?></td>
							<td><?php echo $order_date; ?></td>
							<td><?php echo $status; ?></td>
							<td><?php echo $customer_name; ?></td>
							<td><?php echo $customer_contact; ?></td>
							<td><?php echo $customer_email; ?></td>
							<td><?php echo $customer_address; ?></td>
							<td>
								<a href="#" class="btn-secondary">Update Order</a>
							</td>
						</tr>

						<?php
					}
				}
				else{
					echo "<tr><td colspan='12' class='error'>Orders not Available</td></tr>";
				}

				?>

				
			</table>

			<div class="clearfix"></div>
		</div> 
	</div>
	<!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>