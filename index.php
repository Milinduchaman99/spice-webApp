    <?php include('partials-front/menu.php'); ?>

    <!-- Spices Search Section Starts Here -->
    <section class="spice-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>spice-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Spice.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Spices Search Section Ends Here -->

    <?php 

    if (isset($_SESSION['order'])) {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }

    ?>

    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Spices</h2>

            <?php 

            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if ($count>0) {
                while ($row=mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];

                    ?> 

                    <a href="<?php echo SITEURL; ?>category-spices.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php 

                            if ($image_name=="") {
                                echo "<div class='error'>Image not available</div>";
                            }
                            else{
                                ?> 

                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name ?>" alt="Seeds" class="img-responsive img-curve" width="500" height="265">

                                <?php
                            }

                            ?>

                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                        </a>

                    <?php
                }
            }
            else{
                echo "<div class='error'>Category not added.</div>";
            }

            ?>
            <div class="clearfix"></div>
        </div>
        
    </section>
    <!-- Categories Section Ends Here -->

    <!-- Spice Menu Section Starts Here -->
    <section class="spice-menu">
        <div class="container">
            <h2 class="text-center">Spice Menu</h2>

            <?php 

            $sql2 = "SELECT * FROM tbl_spice WHERE active='Yes' AND featured='Yes' LIMIT 6";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);

            if ($count2>0) {
                while ($row=mysqli_fetch_assoc($res2)) {
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

                                <img src="<?php echo SITEURL; ?>images/spice/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve" width="500" height="100">

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
                echo "<div class='error'>Spice not available.</div>";
            }

            ?>

            
            <div class="clearfix"></div>
        </div>

        <p class="text-center">
            <a href="#">See All Spices</a>
        </p>
    </section>
    <!-- Spice Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>