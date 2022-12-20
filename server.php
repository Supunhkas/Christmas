<?php
session_start();

$username = "";
$password = "";
$errors = array();

function alerts($msg)
{
    echo "<script type ='text/javascript'>alert('$msg');</script>";
}

?>
<!-- $db = mysqli_connect('localhost', 'root', '', 'xmas'); -->

<?php include 'config.php' ?>
<?php
if (isset($_POST['reg_user']))
{

    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    if (empty($username))
    {
        array_push($errors, "Username is required");
    }
    if (empty($password))
    {
        array_push($errors, "Password is required");
    }
    if ($password != $cpassword)
    {
        array_push($errors, "The two passwords do not match");
    }

    $user_check_query = "SELECT * FROM login WHERE username='$username'  LIMIT 1";
    $result = mysqli_query($con, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user)
    {
        if ($user['username'] === $username)
        {
            array_push($errors, "Username already exists");
        }

    }

    if (count($errors) == 0)
    {
        $password = ($password);
        $query = "INSERT INTO login (username, password) 
  			      VALUES('$username', '$password')";
        mysqli_query($con, $query);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = alerts("Register Succsess. Please login to continue");

?>
    <script type="text/javascript">
      window.location.href = 'http://localhost/christmas/index.php';
    </script>

<?php
    }
    else
    {
        alerts("Please check details again.");
    }

}
?>
