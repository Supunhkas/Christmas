<?php
session_start();
if (isset($_GET['logout']))
{
    session_destroy();
    unset($_SESSION['userId']);
    unset($_SESSION['username']);
    header("location: index.php");

}
if (!isset($_SESSION["userId"]))
{
    header("Location: index.php");
}
?>

<?php
include 'config.php'
?>

<?php
//////////////Greetings////////////
$dat = new DateTime('now', new DateTimeZone('Asia/Colombo'));
$date = $dat->format('H');
if ($date < 12) $greetings = "Good Morning";
else if ($date < 15) $greetings = "Good Afternoon";
else if ($date < 22) $greetings = "Good Evening";
else $greetings = "Good Night";

function function_alert($message)
{
    echo "<script>alert('$message');</script>";
}

?>
 <!-- ////////////validation user///////////// -->
<?php
if (isset($_POST['submit']))
{
    $id = $_SESSION['userId'];

    $wish1 = $_POST['wish1'];
    $wish2 = $_POST['wish2'];
    $wish3 = $_POST['wish3'];
    $wish4 = $_POST['wish4'];
    $wish5 = $_POST['wish5'];

    $con = mysqli_connect("localhost", "root", "", "xmas");
    if ($con === false)
    {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    else
    {

        $sql = "INSERT INTO list  (wish1,wish2,wish3,wish4,wish5,userId) VALUES ('$wish1','$wish2','$wish3', '$wish4', '$wish5', '$id')";
        $result2 = mysqli_query($con, $sql);

        $_POST = array();
        if (($result2) == !null)
        {
            function_alert("Data added Successfully");

        }
        else
        {
            function_alert("Error");
        }

    }
}

?>   

<?php
$id = $_SESSION['userId'];
$isAlreadyIn = false;

$query = "SELECT * FROM list WHERE userid = '$id' ";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0)
{
    $isAlreadyIn = true;
    $rows = [];
    $rows = $result->fetch_all(MYSQLI_ASSOC);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>   
    
    <!-- font awesome cdn link  -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>

      <link rel="icon" type="image/x-icon" href="assets/favicon.png">
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

    <!-- custom css file link  -->
       <link rel="stylesheet" href="css/style.css">
       <link rel="stylesheet" href="css/countdown.css">
       <link rel="stylesheet" href="css/gallery.css">
       <link rel="stylesheet" href="css/celebrate.css">
       

</head>
<body  >

  <main class="container" id="container">
    <?php @include 'header.php'; ?>
    <!-- hero section -->
<section class="hero" id="hero" > 
    <div class="card" >
        <div class="card-body">
        <?php if (isset($_SESSION['username'])): ?>
          <h5 class="welcome">
                <?php echo $greetings; ?>
                <strong class="name">
                  <?php echo $_SESSION['username']; ?> 
                </strong>
        </h5>
            <?php
              endif ?>
     
         <div class="count-down" id="countDownSection">

            <div class= "box" >
                <h3 id = "days">00</h3>
                    <p>Days</p>
            </div>

            <div class= "box">
                <h3 id = "hours">00</h3>
                    <p>Hours</p>
            </div>

            <div class= "box">
                <h3 id = "minutes">00</h3>
                    <p>Minutes</p>
            </div>

            <div class= "box">
                <h3 id = "seconds">00</h3>
                    <p>Seconds</p>
            </div>
            
          </div>  

         
          
      </div>
    </div>
</section>
<!-- 
<scetion class="celebrate" id = "celebrate">

<div class="window">
          
		<div class="santa">
			<div class="head">
				<div class="face">
					<div class="redhat">
						<div class="whitepart"></div>
						<div class="redpart"></div>
						<div class="hatball"></div>
					</div>
					<div class="eyes"></div>
					<div class="beard">
						<div class="nouse"></div>
						<div class="mouth"></div>
					</div>
				</div>
				<div class="ears"></div>
			</div>
			<div class="body"></div>
		</div>
    
	</div>
 <div class="message">
		<h1 class= "animateText">Merry Christmas!</h1>
    <audio  autoplay src="assets/hoho.mp3"></audio>
	  </div> 



</scetion> -->
<!-- end hero section -->

<!-- drawer section -->
<section class="wishlist" id ="wishlist" >

  <hr class="newline">

<link rel="stylesheet" href="css/list.css">

<div class="list-wrapper">
    <h1 class="list-title"> Insert Your Wishlist Below </h1>


    <form action="home.php" method = "POST" name="myform" id="myform" autocomplete="false">
        <input type="text" placeholder=" <?php echo $_SESSION['username']; ?>" class="box" disabled>
        
        <?php
if ($isAlreadyIn)
{
    foreach ($rows as $row)
    {
?>    
          <p class="pexsists"> *You enterd data already.</p>
          <input type="text" value="<?php echo $row['wish1']; ?>" placeholder="Enter your wish 1" class="box" name="wish1"  disabled> 
          <input type="text" value="<?php echo $row['wish2']; ?>" placeholder="Enter your wish 2" class="box" name="wish2"  disabled>
          <input type="text" value="<?php echo $row['wish3']; ?>" placeholder="Enter your wish 3" class="box" name="wish3"  disabled>
          <input type="text" value="<?php echo $row['wish4']; ?>" placeholder="Enter your wish 4" class="box" name="wish4"  disabled>
          <input type="text" value="<?php echo $row['wish5']; ?>" placeholder="Enter your wish 5" class="box" name="wish5"  disabled>
        
            <?php
    }
}
else
{
?>
              <p class="emptyp"> *you can enter wishlist only one time. So choose wisely. </p>
              <input type="text"  placeholder="Enter your wish 1" class="box" name="wish1" required autocomplete="false" > 
              <input type="text"  placeholder="Enter your wish 2" class="box" name="wish2" required autocomplete="false" > 
              <input type="text"  placeholder="Enter your wish 3" class="box" name="wish3" required autocomplete="false" > 
              <input type="text"  placeholder="Enter your wish 4" class="box" name="wish4" required autocomplete="false" > 
              <input type="text"  placeholder="Enter your wish 5" class="box" name="wish5" required autocomplete="false" > 
              <?php
} ?>

    <div class="listbtn">
        <input type="submit" value="Submit" class="button" name="submit" id="submitBtn" <?php print ($isAlreadyIn == true) ? 'disabled=disabled' : '' ?> >
        
    </div>
    </form>
    
</div>

       

</section>

<!-- gallery -->
<section class="gallery" id= "gallery">

<h2 class="imgheader"> Image Gallery</h2>
  <hr class="newline">

<div class="gallery-container">
  
	<div class="imgcard">
    <img class="img" src="assets/galleryImg/galleryimg1.jpg" > 
  </div>

  <div class = "imgcard">
    <img class="img" src="assets/galleryImg/sign7.webp">  
  </div>

  <div class="imgcard">
    <img class="img" src="assets/galleryImg/galleryimg5.jpg">  
  </div>

	<div class="imgcard">
    <img class="img" src="assets/galleryImg/galleryimg2.jpg">   
  </div>

  <div class="imgcard">
    <img class="img" src="assets/galleryImg/sign8.webp"> 
  </div>

  <div class="imgcard">
    <img class="img" src="assets/galleryImg/galleryimg4.jpg">  
  </div> 

</div>  

</section>
         

<!-- Fotter -->
<Footer class="footer-sec">
  
  <div class="credits">
    created by <span> ©2022 Dockyard Total Solutions (Pvt) Ltd.</span> | All Rights Reserved. 
  </div>

</Footer>
</main>
<!-- custom js link -->
<script src= "js/countdown.js"></script>
<script src="js/script.js"></script>


<script>
if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

</script>
<script>

$(document).ready(function(){
  // Add smooth scrolling to all links
 $("a").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();
      // Store hash
      var hash = this.hash;
      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
     $('html, body').animate({
       scrollTop: $(hash).offset().top
     }, 800, function(){
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
     });
   } // End if
 });
});
</script>
<script src="js/celebrate.js"></script>


</body>
</html>

<?php
mysqli_close($con);
?>
