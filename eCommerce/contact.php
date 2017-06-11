<?php 

    if(isset($_POST['send'])){

        $message = $_POST['message'];
        
        $name = $_POST['name'];
        $subject = $name . ": ".$_POST['subject'];
        

        mail('ahmedhdawy@azhar.edu.eg', $subject, message);
    }


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
            CONTACT SECTION
************************************-->
<section id="contact-us">
    <div class="container">
        <div class="form-header">
            <h1>Contact Us</h1>
            <h2>We Wanna hear from you</h2>
        </div>
        <!-- <div style="clear:both;"></div> -->
        <div class="contact-form">
            <form>
                <input type="text" placeholder="Name" name="name">
                <input type="email" placeholder="Email" name="email">
                <input type="text" placeholder="Subject" name="subject">
                <textarea name="message" placeholder="Message" rows="5"></textarea>

                <input type="submit" class="btn" name="send" value="Send">
            </form>
        </div>
    </div>
</section>





    <script src="layout/js/wow.min.js"></script> <!-- WOW.js Mini file -->
    <script src="layout/js/owl.carousel.min.js"></script> <!-- Owl-Carousel.js Mini file -->
    <script src="layout/js/wow.min.js"></script> 
    <script>new WOW().init();</script> <!-- Activate WOW.js File -->
    <script src="layout/js/semantic.min.js"></script> <!-- semantic Js File -->

</body>
</html>
