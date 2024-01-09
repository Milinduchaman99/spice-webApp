<?php include('partials-front/menu.php'); ?>

    <!-- Spice Search Section Starts Here -->
    <section class="spice-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>spice-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Spice.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Spice Search Section Ends Here -->



    <!-- Spice Menu Section Starts Here -->
    <section class="spice-menu">
        <div class="container">
            <h2 class="text-center">Spice Menu</h2>

            <?php 

            $sql = "SELECT * FROM tbl_spice WHERE active='Yes'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if ($count>0) {
                while ($row=mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];

                    ?> 

                    <div class="spice-menu-box">
                        <div class="spice-menu-img">
                            <?php 

                            if ($image_name=="") {
                                echo "<div class='error'>Spice not available.</div>";
                            }
                            else{
                                ?> 

                                <img src="<?php echo SITEURL; ?>images/spice/<?php echo $image_name; ?>" alt="seeds" class="img-responsive img-curve" width="500" height="100">

                                <?php
                            }

                            ?>
                            
                        </div>

                        <div class="spice-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="spice-price">Rs.<?php echo $price; ?></p>
                            <p class="spice-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL; ?>order.php?spice_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>

                    <?php
                }
            }
            else{
                echo "<div class='error'>Spice not found.</div>";
            }

            ?>


            <div class="clearfix"></div>
        </div>

    </section>
    <!-- Spice Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>