<?php include('partials-front/menu.php'); ?>

<?php 

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);

    $category_title = $row['title'];
}
else{
    header('location:'.SITEURL);
}

?>

    <!-- Spice Search Section Starts Here -->
    <section class="spice-search text-center">
        <div class="container">
            
            <h2>Spices on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- Spice Search Section Ends Here -->



    <!-- Spice Menu Section Starts Here -->
    <section class="spice-menu">
        <div class="container">
            <h2 class="text-center">Seeds Menu</h2>

            <?php 

            $sql2 = "SELECT * FROM tbl_spice WHERE category_id=$category_id";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);

            if ($count2>0) {
                while ($row2=mysqli_fetch_assoc($res2)) {
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];

                    ?> 
                        <div class="spice-menu-box">
                            <div class="spice-menu-img">
                                <?php 

                                if ($image_name=="") {
                                    echo "<div class='error'>Image not available.</div>";
                                }
                                else{
                                    ?> 

                                    <img src="<?php echo SITEURL; ?>images/spice/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                                    <?php
                                }

                                ?>
                                
                            </div>

                            <div class="spice-menu-desc">
                                <h4></h4><?php echo $title ?></h4>
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
                echo "<div class='error'>Category not found.</div>";
            }

            ?>
            <div class="clearfix"></div>
        </div>

    </section>
    <!-- Spice Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>