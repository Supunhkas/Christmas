
<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/register.css">
    <link rel="icon" type="image/x-icon" href="assets/favicon.png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    
</head>
<body>

    <video src="assets/video.mp4" autoplay muted loop class="vid"></video>
    
    <form acttion ="register.php" method="POST" class= "login" autocomplete="off">
    <?php include('errors.php'); ?>

        <h3>Register Here</h3>
  
        <label for="username">Username</label>
        <input type="text" placeholder="Name" id="username" name ="username" autocomplete ="off" >

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password"  autocomplete= "off">
        
        <label for="confrim password">Confirm password</label>
  	    <input type="password" name="cpassword"  placeholder="Confirm Password">
        <input type ="hidden" id="id" name= "userId" value="id"> 

        <input type="submit" value ="Register" class="button" name="reg_user"></input>

        <p> If you registred <a href="index.php">click here</a> to login</p>

    </form>
  
       
</body>
</html>
