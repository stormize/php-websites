<?php

session_start(); 

include "classes/products.php";


$product = new products();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- IE Combitability Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Mobile First Meta -->

        <title>Home | navbar</title>

        <link rel="stylesheet" href="layout/css/semantic.min.css"> <!-- semantic.css File -->
        <link rel="stylesheet" href="layout/css/font-awesome.min.css"> <!-- font awesome.css file -->
        <link rel="stylesheet" href="layout/css/animate.css"> <!-- Animate.CSS File -->
        <link href="layout/css/hover.css" rel="stylesheet" media="all"> <!-- Hover.CSS File -->
        <link rel="stylesheet" href="layout/css/owl.carousel.css"> <!-- Carousal -->
        <link rel="stylesheet" href="layout/css/style.css"> <!-- CSS File -->
        <link rel="stylesheet" href="layout/css/media.css"> <!-- Media Query File -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"> <!-- Font -->
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
        <script src="layout/js/jquery.min.js"></script> <!-- Jquery Mini file -->
        <script src="layout/js/jquery.validate.min.js"></script>
        <script src="layout/js/script.js"></script> <!-- Externa Js File file - My File -->

    </head>
    <body>

        <?php include "layout/header.php"; ?>





        <!--***********************************
                         Main Slider SECTION
        ************************************-->
        <header id="header">
            <div class="container-fluid">
                <div id="header-left" class="float-left">
                    <div class="lg-add float-left">
                        <img src="layout/img/header-add.jpg" alt="addvertisment">
                    </div>
                </div>
                <div id="header-right" class="float-left">

                    <!--***********************************
                                    OWL CAROUSEL SECTION
                    ************************************-->
                    <div class="header-carousel">
                        
                    <?php 
                    $slider = $product->selectSlider();

                    foreach ($slider as $key) { ?>

                        <div class="item" id="slide" style="background-image: url('product_image/<?php echo $key['pic_name']; ?>');">
                            
                            <div class="inside-item">
                            <h3><?php echo $key['pro_name']; ?></h3>
                            <p>shop with us and get 10% discound and more</p>
                            <a href="display.php?id=<?php echo $key['pro_id']; ?>" class="btn">Shop Now</a>

                            </div>
                        </div>
                            
                     <?php   }
                     ?>

                    </div>
                </div>
                <div style="clear:both;"></div>
            </div>
        </header>

<!--********  Display Search results ******-->
<?php 
    if(isset($_POST['search'])){
        $search_value = $_POST['search_value'];
?>

    <section id="addvertis">
            <div class="container">
                <h2>Search Results</h2>
            </div>
        </section>
        <section id="offers">
            <div class="container-fluid">

                <div class="offers-carousel">
                    <!--***********************************
                                            CAROUSEL ITEMS
                    ************************************-->
                    <?php 
                    $search_items = $product->searchProducts($search_value);
                    if(!empty($search_items)){
                        foreach ($search_items as $value){
                        
                        ?>
                    <div class="item">
                    
                        <img src="product_image/<?php echo $value['pic_name'] ?>" alt="" />

                        
                        <div class="offer-item">
                            <h1> <?php echo $value['pro_name'] ?></h1>
                            <p>Price: <?php echo $value['price'] ?> $</p>
                            <?php 
                                if( $value['offer'] > 1){
                                    $after_offer = $value['price'] - $value['offer'];
                                    $offer = $value['price'] / 100;
                                    $offer = $value['offer'] / $offer;

                                    echo "<h4>Offer: " .$offer. "%</h4>";
                                }
                            ?>
    
                            <a href="display.php?id=<?php echo $value['pro_id']; ?>" class="btn">Shop Now</a>
                            
                        </div>
                    </div>                    
<?php }
        } else {
                echo "<h4 class='searc-result'>Your search did not match any Products.</h4>";
        }
?>
                </div>
            </div>
        </section>

<?php } ?>

<!-- End Display Search results *******-->

        <!--***********************************
                        ADDVERTOSMENT SECTION
        ************************************-->
        <section id="addvertis">
            <div class="container">
                <h2>Products</h2>
            </div>
        </section>



        <!--***********************************
                                OFFERS SECTION
        ************************************-->
        <section id="offers">
            <div class="container-fluid">

                <div class="offers-carousel">
                    <!--***********************************
                                            CAROUSEL ITEMS
                    ************************************-->
                    <?php 
                        foreach ($product->selectProducts() as $value){
                        
                        ?>
                    <div class="item">
                    
                        <img src="product_image/<?php echo $value['pic_name'] ?>" alt="" />

                        
                        <div class="offer-item">
                            <h1> <?php echo $value['pro_name'] ?></h1>
                            <p>Price: <?php echo $value['price'] ?> $</p>
                            <?php 
                                if( $value['offer'] > 1){
                                    $after_offer = $value['price'] - $value['offer'];
                                    $offer = $value['price'] / 100;
                                    $offer = $value['offer'] / $offer;

                                    echo "<h4>Offer: " .$offer. "%</h4>";
                                }
                            ?>
    
                            <a href="display.php?id=<?php echo $value['pro_id']; ?>" class="btn">Shop Now</a>
                            
                        </div>
                    </div>
                        <?php }?>
                    
                    
                </div>
            </div>
        </section>


        <!--***********************************
                        ADDVERTOSMENT SECTION
        ************************************-->
        <section id="addvertis">
            <div class="container">
                <img src="http://placehold.it/750x150?text=ADVERTISEMENT" alt="" class="lg-add">
            </div>
        </section>


        <!--***********************************
                                MOST RECENT SECTION
        ************************************-->
        <section id="most-recent">
            <div class="container-fluid">

                <div class="most-recent-carousel">
                    <!--***********************************
                                            CAROUSEL ITEMS
                    ************************************-->
                    <div class="item">
                        <img src="http://placehold.it/309x350" alt="" />
                        <div class="most-recent-item">
                            <h2>Most recent</h2>
                            <button class='btn'>Shop Now</button>
                        </div>
                    </div>
                    <div class="item">
                        <img src="http://placehold.it/309x350" alt="" />
                        <div class="most-recent-item">
                            <h2>Most recent</h2>
                            <button class='btn'>Shop Now</button>
                        </div>
                    </div>
                    <div class="item">
                        <img src="http://placehold.it/309x350" alt="" />
                        <div class="most-recent-item">
                            <h2>Most recent</h2>
                            <button class='btn'>Shop Now</button>
                        </div>
                    </div>
                    <div class="item">
                        <img src="http://placehold.it/309x350" alt="" />
                        <div class="most-recent-item">
                            <h2>Most recent</h2>
                            <button class='btn'>Shop Now</button>
                        </div>
                    </div>
                    <div class="item">
                        <img src="http://placehold.it/309x350" alt="" />
                        <div class="most-recent-item">
                            <h2>Most recent</h2>
                            <button class='btn'>Shop Now</button>
                        </div>
                    </div>
                    <div class="item">
                        <img src="http://placehold.it/309x350" alt="" />
                        <div class="most-recent-item">
                            <h2>Most recent</h2>
                            <button class='btn'>Shop Now</button>
                        </div>
                    </div>
                    <div class="item">
                        <img src="http://placehold.it/309x350" alt="" />
                        <div class="most-recent-item">
                            <h2>Most recent</h2>
                            <button class='btn'>Shop Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!--***********************************
                        ADVERTOSMENT SECTION
        ************************************-->
        <section id="addvertis">
            <div class="container">
                <img src="http://placehold.it/750x150?text=ADVERTISEMENT" alt="" class="lg-add">
            </div>
        </section>


        <!--***********************************
                                FOOTER SECTION
        ************************************-->
        <footer id="footer">

            <!--*********************
                      MAIN FOOTER
            **********************-->
            <div id="main-footer">
                <div class="container-fluid">

                    <!--*********************
                       popular search sec.
                    **********************-->
                    <div id="footer-popular-search">
                        <h4>popular searches</h4>
                        <div class="content">
                            <ul>
                                <li><a href="">Link</a></li>
                                <li><a href="">Link</a></li>
                                <li><a href="">Link</a></li>
                                <li><a href="">Link</a></li>
                                <li><a href="">Link</a></li>
                            </ul>
                        </div>
                        <h4>LEARNING CENTER</h4>
                        <div class="content">
                            <ul>
                                <li><a href="">Link</a></li>
                                <li><a href="">Link</a></li>
                            </ul>
                        </div>
                    </div> <!-- popular sec. end -->


                    <!--*********************
                            my account sec.
                    **********************-->
                    <div id="footer-my-account">
                        <h4>my account</h4>
                        <div class="content">
                            <ul>
                                <li><a href="">Link</a></li>
                                <li><a href="">Link</a></li>
                                <li><a href="">Link</a></li>
                                <li><a href="">Link</a></li>
                                <li><a href="">Link</a></li>
                            </ul>
                        </div>
                        <h4>INTELLECTUAL PROPERTY</h4>
                        <div class="content">
                            <ul>
                                <li><a href="">Link</a></li>
                                <li><a href="">Link</a></li>
                                <li><a href="">Link</a></li>
                                <li><a href="">Link</a></li>
                                <li><a href="">Link</a></li>
                            </ul>
                        </div>
                    </div> <!-- my account sec. end -->


                    <!--*********************
                              selling sec.
                    **********************-->
                    <div id="footer-selling">
                        <h4>selling</h4>
                        <div class="content">
                            <ul>
                                <li><a href="">Link</a></li>
                                <li><a href="">Link</a></li>
                                <li><a href="">Link</a></li>
                                <li><a href="">Link</a></li>
                                <li><a href="">Link</a></li>
                            </ul>
                        </div>
                        <h4>BUYING ON</h4>
                        <div class="content">
                            <ul>
                                <li><a href="">Link</a></li>
                                <li><a href="">Link</a></li>
                                <li><a href="">Link</a></li>
                                <li><a href="">Link</a></li>
                                <li><a href="">Link</a></li>
                            </ul>
                        </div>
                    </div><!-- selling sec. end -->


                    <!--*********************
                        contact us sec.
                    **********************-->
                    <div id="footer-contact-us">
                        <h4>contact us</h4>
                        <div class="content">
                            <div id="customer-service" class="contact-block">
                                <h4>customer service</h4>
                                <p><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> contact us</a></p>
                                <p>Sat - Thu: 9 AM - 9 PM </br> Fri: 1:30 PM - 9 PM</p>
                            </div>
                            <div id="call-to-order" class="contact-block">
                                <h4>call to order</h4>
                                <p><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> contact us</a></p>
                                <p>Daily, 9 AM to 10 PM</p>
                            </div>
                            <div id="follow-us" class="contact-block">
                                <h4>follow us</h4>
                                <div class="content">
                                    <ul>
                                        <li><a href="#" class="fb-icon"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                                        <li><a href="#" class="twitter-icon"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="#" class="google-icon"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
                                        <li><a href="#" class="yu-icon"><i class="fa fa-youtube-square" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> <!-- contact-us sec. end -->


                </div>
            </div> <!-- main-footer end -->


            <!--*********************
                      SMALL FOOTER
            **********************-->
            <div id="small-footer">
                <div class="container">
                    <div id="footer-copyright" class="float-left">
                        <h5> Powered By <i class="fa fa-copyright" aria-hidden="true"></i> NULL Team</h5>
                    </div>
                    <div id="footer-social" class="float-left">
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li>|</li>
                            <li><a href="#">Career</a></li>
                            <li>|</li>
                            <li><a href="#">Privacy Police</a></li>
                            <li>|</li>
                            <li><a href="#">Terms and Condetions</a></li>
                        </ul>
                    </div>
                </div>
            </div> <!-- small-footer end -->

        </footer> <!-- Footer end -->




    </div>




    <script src="layout/js/wow.min.js"></script> <!-- WOW.js Mini file -->
    <script src="layout/js/owl.carousel.min.js"></script> <!-- Owl-Carousel.js Mini file -->
    <script src="layout/js/wow.min.js"></script> 
    <script>new WOW().init();</script> <!-- Activate WOW.js File -->
    <script src="layout/js/semantic.min.js"></script> <!-- semantic Js File -->

</body>
</html>
