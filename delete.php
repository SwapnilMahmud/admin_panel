<?php
include"db.php";
if(isset($_GET['id'])){
  $id=$_GET['id'];
}
$sql1="SELECT * FROM information WHERE user_id='{$id}'";
$result1=mysqli_query($conn,$sql1);
$row=mysqli_fetch_assoc($result1);
unlink("upload/".$row['post_img']);
$sql="DELETE FROM information WHERE user_id='{$id}'";
if(mysqli_query($conn,$sql)) {
  header("location:dashboard.php");
}


?>


<
