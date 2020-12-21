<?php
include"db.php";
$err='';
if(isset($_POST['submit'])){
if(empty($_POST['uname']) || empty($_POST['upass'])){
  $err="<p style='color:red; margin:20px;'> Please provide your user-name & password</p>";
}else{
  $uname=mysqli_real_escape_string($conn,$_POST['uname']);
  $pass=md5($_POST['upass']);
  $sql="SELECT * FROM Information WHERE username='{$uname}' AND password='{$pass}'";
  $rslt=mysqli_query($conn,$sql) or die("login query faield");
  if (mysqli_num_rows($rslt)>0){
      while($row=mysqli_fetch_assoc($rslt)){
        session_start();
        $_SESSION['uid']=$row['user_id'];
        $_SESSION['username']=$row['username'];
          $_SESSION['role']=$row['role'];
        $_SESSION['img']=$row['post_img'];
        header("location:dashboard.php");
      }

  }else{
    $err="<p style='color:red; margin:20px;'>  user-name & password doesn't match</p>";
  }
}
}
?>

<html>
<head>
  <title>swapnil-blogs</title>
  <style>
  .login-module{
       margin: 100px 0 0 300px;
       padding:10px;
     }
  .login-module input{
    padding:8px;
     outline: none;
  }
  .login-module input[type=text]{
    border: 3px solid lightblue;
    border-radius: 8px;
    height: 50px;
  }
  .login-module input[type=text]:hover{
    border: 3px solid tomato;
  }
  .nam{
    color:tomato;
    font-weight: bold;
    font-size:20px;
  }
  legend{
    margin:30px;
    border:3px solid skyblue;
    padding:5px;
  }
  fieldset{
    margin-right:400px;
    border-radius:6px;
    border:3px solid skyblue;
  }
  .sbmt{
    border-radius:5px;
    border-color:skyblue;
  }

  </style>
</head>
<body>
    <div class="login-module" >
       <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
         <fieldset>
           <legend><h1 class="nam">  LOGIN FORM </h1></legend>
           <input  type="text" name="uname" placeholder="User-Name" size="35"><br><br>
           <input type="text" name="upass" placeholder="Password" size="35"><br><br>
           <input type="submit" name="submit" class="sbmt"><p><?php echo $err; ?></p>
           <p class="f"><a href="#">Forget password?</a> or <a href="signup.php">Signup</a></p>
        </fieldset>
       </form>
    </div>
</body>
</html>
