<?php
include"db.php";
if(isset($_GET['id'])){
  $id=$_GET['id'];
}

if(empty($_FILES['fileToUpload']['name'])){
  $file_name = $_POST['old_image'];
}else{

  $error=array();
  $file_name=$_FILES['fileToUpload']['name'];
  $file_size=$_FILES['fileToUpload']['size'];
  $file_tmp=$_FILES['fileToUpload']['tmp_name'];
  $file_type=$_FILES['fileToUpload']['type'];
  $file_ext=end(explode('.',$file_name));
  $extension=array("jpg","jpeg","png");
  if(in_array($file_ext,$extension) == false){
    $error[]="only support jpeg jpg png";
  }
  if($file_size>2097152){
    $error[]="File size must be lower";
  }
  if(empty($error)==true){
    move_uploaded_file($file_tmp,"upload/".$file_name);
  }else{
    print_r($error);
    die();
  }

}
if(isset($_POST['submit'])){
  $id=mysqli_real_escape_string($conn,$_POST['id']);
  $fname=mysqli_real_escape_string($conn,$_POST['fname']);
  $lname=mysqli_real_escape_string($conn,$_POST['lname']);
  $uname=mysqli_real_escape_string($conn,$_POST['username']);
  $gen=mysqli_real_escape_string($conn,$_POST['gen']);
  $rol=mysqli_real_escape_string($conn,$_POST['rol']);

  if($_POST['rol']==7){
    $ro="Admin";
  }else{
    $ro="User";
  }

  if($_POST['rol']==7){
    $sql = "UPDATE information SET first_name='{$fname}',last_name='{$lname}',username='{$uname}',gender='{$gen}',post_img='{$file_name}',role={$rol} WHERE user_id='{$id}';";
    $sql .= "UPDATE admin SET role_name='{$ro}',total=total+1 WHERE aid={$rol};";
    mysqli_multi_query($conn,$sql) or die("insert query faield...");
    header("location:dashboard.php");
  }else{
    $sql = "UPDATE information SET first_name='{$fname}',last_name='{$lname}',username='{$uname}',gender='{$gen}',post_img='{$file_name}' WHERE user_id='{$id}';";
    $sql .= "UPDATE admin SET role_name='{$ro}',total=total+1 WHERE aid={$rol};";
    mysqli_multi_query($conn,$sql) or die("insert query faield...");
    header("location:dashboard.php");
  }



  }



?>
