<?php
 include"db.php";
 $err=' ';
 $empt='';
 $errors=' ';
 if(isset($_FILES['fileToUpload'])){
   $errors =array();
   $file_name=$_FILES['fileToUpload']['name'];
   $file_size=$_FILES['fileToUpload']['size'];
   $file_tmp=$_FILES['fileToUpload']['tmp_name'];
   $file_type=$_FILES['fileToUpload']['type'];
   $file_ext=end(explode('.',$file_name));
   $extension=array("jpeg","jpg","png");
   if(in_array($file_ext,$extension) === false){
     $errors[]="this extension is not allowed";
   }
   if($file_size>2097152){
     $errors[]="File size must be lower";
   }
   if(empty($errors)==true){
     move_uploaded_file($file_tmp,"upload/".$file_name);
   }else{
     print_r($errors);
     die();
   }}
 if(isset($_POST['submit'])){
     $fname=mysqli_real_escape_string($conn,$_POST['fname']);
     $lname=mysqli_real_escape_string($conn,$_POST['lname']);
     $uname=mysqli_real_escape_string($conn,$_POST['uname']);
     $rr='8';
     if($_POST['gen']=="Male" || $_POST['gen']=="Female"){
       $gen=$_POST['gen'];
     }else{
       $empt="<p style='color:red; margin:20px;'>Please provide your Gender!</p>";
     }
     $pass = mysqli_real_escape_string($conn,md5($_POST['upass']));
     $sql1="SELECT * FROM information WHERE username='{$uname}'";
     $result1=mysqli_query($conn,$sql1);
     if(mysqli_num_rows($result1)>0){
       $err="<p style='color:red; margin:20px;'>Username already taken!</p>";

     }else{
       $sql="INSERT INTO information(first_name,last_name,username,gender,password,post_img,role) VALUES ('{$fname}','{$lname}','{$uname}','{$gen}','{$pass}','{$file_name}',{$rr});";
       $sql .= "INSERT INTO notification (nmessage,status) VALUES ('$fname has joined as a Student!!','unread')";
            mysqli_multi_query($conn,$sql) or die("insert query faield");
            header("location:index.php");
     }
    }
?>

<html>
  <head>
     <title>Signup</title>
     <link rel="stylesheet" href="style/signup.css" >
  </head>
  <body>
    <div class="info">
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
             <fieldset>
               <legend><h3>Information</h3></legend>
               <input type="text" name="fname" placeholder="First-Name" size="35" required><br><br>
               <input type="text" name="lname" placeholder="Last-Name" size="35" required><br><br>
               <input type="text" name="uname" placeholder="UserName" size="35" required><br><br>
               <label>Gender:</label>
               <label>Male</label><input type="radio" name="gen" value="Male" required>
               <label>Female</label><input type="radio" name="gen" value="Female" required ><br><br>
               <label for="exampleInputPassword1">Image:</label>
               <input type="file" name="fileToUpload" required><br><br>
               <input type="text" name="upass" placeholder="Password" size="35" required><br><br>
               <?php echo $err; ?>
               <?php echo $empt; ?>

               <input type="submit" name="submit">
            </fieldset>
        </form>
    </div>
  </body>
</html>
