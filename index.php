<?php
session_start();
$errors = array();

if (!isset($_SESSION['username']))
{

}
?> 
<?php
include 'config.php'
?>

<?php
include ('config.php');

if (isset($_POST["username"]) && isset($_POST["password"]))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = stripcslashes($username);
    $password = stripcslashes($password);
    $username = mysqli_real_escape_string($con, $username);
    $password = mysqli_real_escape_string($con, $password);

    if (empty($username))
    {
        array_push($errors, "Username is required");
    }
    elseif (empty($password))
    {
        array_push($errors, "Password is required");
    }
    if (count($errors) == 0)
    {

        $sql = "SELECT * FROM login WHERE username = '$username' and password = '$password'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

        if (mysqli_num_rows($result) == 1)
        {
            $_SESSION['username'] = $username;
            $_SESSION['userId'] = $row['id'];

            header("Location: home.php");
        }
        else
        {
            array_push($errors, "Username or password incorrect");
        }

    }
}
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/log.css">
    <link rel="icon" type="image/x-icon" href="assets/favicon.png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
</head>
<body>

    <video src="assets/video.mp4" autoplay muted loop class="vid"></video>
    
    <form acttion ="index.php" method="POST" class= "login" autocomplete="off">
    <?php include ('errors.php'); ?>

        <h3>Login Here</h3>
  
        <label for="username">Username</label>
        <input type="text" placeholder="Name" id="username" name ="username" autocomplete ="off" >

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password"  autocomplete= "off">
        <input type ="hidden" id="id" name= "userId" value="id"> 

        <input type="submit" value ="Log in" class="button" ></input>

        <p> If you not registred <a href="register.php">click here</a> to register</p>

    </form>
  
    
    
       
</body>
</html>
