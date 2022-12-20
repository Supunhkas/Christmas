<?php
session_start();
if (isset($_GET['logout']))
{
    session_destroy();
    unset($_SESSION['username']);
    header("location: index.php");

}
if (!isset($_SESSION["userId"]))
{
    header("Location: index.php");
}

?>
 <?php @include 'config.php'; ?>

 
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      href="https://fonts.googleapis.com/css?family=Lato:100,300"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/box.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Gift Box</title>
</head>

<body>
 
<div class="parentsubmitter">
<div class="submitter"> 
<form id="form1" style= "display : none" acttion ="gift.php" method="POST" >
<input type="text" id ="nameValInput" ></input>
<input type="text" id ="idValInput" ></input>
<input type="submit" value ="Register" class="button" name="reg_user"></input>
</form>

</div>
</div>




<canvas id="canvas"></canvas>
<div class="present">
    <div class="rotate-container" id="rotate">
        
        <div class="bottom"></div>
        <div class="front"></div>
        <div class="left"></div>
        <div class="back"></div>
        <div class="right"></div>
        
      <div class="lid">
          <div class="lid-top"></div>
          <div class="lid-front"></div>
          <div class="lid-left"></div>
          <div class="lid-back"></div>
          <div class="lid-right"></div>
      </div>

      <div class="text text-center" id="text"> 
        <h3 class= "santa" >You secret santa for </h3>
        <h1 class ="winner">Result</h1>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
            View List
        </button>
      </div>

    </div>
    <!-- <button class="button" id= "button" style= "display : none"> Click Me</button>  -->
      <!-- <div class="instruction"> -->
        <!-- </div> -->
      <div class="snowman" id="snowman">
        <img src="assets/snowman.png" alt="snowman" class= "man">
      </div>
  
</div>



<!-- Modal -->
<form action="gift.php" method="get" >
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content rounded-10">
      <!-- <div class="modal-header"> -->
        <h5 class="modal-title text-center" id="exampleModalLongTitle">Wish List  </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         
        </button>
      <!-- </div> -->
      <div class="modal-body">
        <ul>
          <li> <label for="" id = "wish1" class="wishlistname"></label> </li>
          <li> <label for="" id = "wish2" class="wishlistname"></label> </li>
          <li> <label for="" id = "wish3" class="wishlistname"></label> </li>
          <li> <label for="" id = "wish4" class="wishlistname"></label> </li>
          <li> <label for="" id = "wish5" class="wishlistname"></label> </li>
          
        </ul>


      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary  " data-dismiss="modal" >Close</button>
      </div>
      <button type="button" class="btn btn-info" data-dismiss="modal" onClick="Javascript:window.location.href = 'http://localhost/christmas/home.php';"><i class="fa fa-home"></i>&nbsp;&nbsp;Back To Home</button>
    
    </div>
  </div>

</div>
</form>


</body>

<script src="js/giftbox.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
<?php
$r1 = '';
$isDrawed=false;
$id = $_SESSION['userId'];
$recieverName='null';
$availableNameArray = array();
$randNo=0;
 $sql3 = "SELECT reciever,(SELECT username FROM login WHERE id=reciever) AS recieverName FROM draw_list WHERE drawer= '$id'";
   
  $query = mysqli_query($con, $sql3);
  
     while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
       {
         $reciever=$row['reciever'];
         $recieverName=$row['recieverName'];
         $isDrawed=true;  
       }


if(!$isDrawed){

  $sql = "SELECT reciever FROM draw_list";
  $stmt = mysqli_query($con, $sql);
  $arrayToString = '';
  while ($row = mysqli_fetch_array($stmt, MYSQLI_ASSOC))
  {
      if ($arrayToString != '')
      {
          $arrayToString = $arrayToString . ',' . $row['reciever'];
  
      }
      else
      {
          $arrayToString = $row['reciever'];
      }
  }
  
  if ($arrayToString != '') $arrayToString = $arrayToString . ',' . $_SESSION["userId"];
  
  else $arrayToString = $_SESSION["userId"];
  
  $sql2 = "SELECT * FROM login WHERE id NOT IN (" . $arrayToString . ")";
  
  class Ob
  {
      public $id;
      public $name;
  }
  
  $query = mysqli_query($con, $sql2);
  while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
  {
  
      $ob1 = new Ob();
      $ob1->id = $row['id'];
      $ob1->name = $row['username'];
      array_push($availableNameArray, $ob1);
  
  }

  $randNo = rand(0, count($availableNameArray) - 1);
  
  if(count($availableNameArray)>0){

    $reciever = $availableNameArray[$randNo]->id;
  
    $query = "INSERT INTO draw_list (drawer, reciever) 
              VALUES('$id', '$reciever')";
  
    mysqli_query($con,$query);
  

  $tsql = "SELECT *
                   FROM list";
  
}
}

else{

 

  $tsql = "SELECT * FROM list WHERE userId= '$reciever '";

}
class ObWishes
{
    public $id;
    public $userId;
    public $w1;
    public $w2;
    public $w3;
    public $w4;
    public $w5;
}
$wishList = array();
$query = mysqli_query($con, $tsql);
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
{

    $ob1 = new ObWishes();
    $ob1->id = $row['listId'];
    $ob1->userId = $row['userId'];
    $ob1->w1 = $row['wish1'];
    $ob1->w2 = $row['wish2'];
    $ob1->w3 = $row['wish3'];
    $ob1->w4 = $row['wish4'];
    $ob1->w5 = $row['wish5'];
    array_push($wishList, $ob1);

}



?>

<script type="text/javascript">var isDrawed =<?php echo json_encode($isDrawed); ?>;</script>
<script type="text/javascript">var availableNameArray =<?php echo json_encode($availableNameArray); ?>;</script>
<script type="text/javascript">var randNo =<?php echo ($randNo); ?>;</script>
<script type="text/javascript">var wishList =<?php echo json_encode($wishList); ?>;</script>
<script type="text/javascript">var recieverName = <?php echo json_encode($recieverName); ?>;</script>


<?php
echo "<script > loadData() </script>";

?>
