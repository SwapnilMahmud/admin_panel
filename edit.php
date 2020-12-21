<?php
session_start();
include"db.php";
if(isset($_GET['id'])){
  $id=$_GET['id'];
}
$sql="SELECT * FROM information WHERE user_id='{$id}'";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
while($row=mysqli_fetch_assoc($result)){
?>


<html>
 <head>
    <title>edit-php</title>
    <style>

      input[type=text]{
        border:1px solid skyblue;
        padding:10px;
        outline:none;
          border-radius:4px;
      }
        input[type=submit]{
          border:1px solid skyblue;
          padding:6px;
          outline:none;
          border-radius:4px;

        }
      input[type=text]:hover{
        border:1px solid darkorange;

      }
      .edit{
        margin-top:80px;
        margin-left:500px;
      }
      fieldset{
        margin-right:500px;
        padding:40px;
        border:2px solid skyblue;

        border-radius:4px;
      }

    </style>
 </head>
 <body>
    <div class="edit">
      <fieldset>
        <legend>Update Information</legend>
      <form action="update.php" method="post" enctype="multipart/form-data" >
          <input type="hidden" name="id" class="form-control" value="<?php echo $row['user_id'];  ?>">
          <input type="text" name="fname" placeholder="FirstName" value="<?php echo $row['first_name']; ?>" size="35"><br><br>
          <input type="text" name="lname" placeholder="LastName" value="<?php echo $row['last_name']; ?>" size="35"><br><br>
          <input type="text" name="username" placeholder="UserName"  value="<?php echo $row['username']; ?>"size="35"><br><br>
          <?php
               $sql3="SELECT * FROM admin";
               $rslt=mysqli_query($conn,$sql3);
               if($_SESSION['role'] == 7){

          echo"<select name='rol' style='width:170px; padding:5px; border-radius:4px; outline:none; border-color:skyblue;'>";
          echo"<option disabled > Select Category</option>";
           while($row1=mysqli_fetch_assoc($rslt)){

              if($row['role']==$row1['aid']){
                $selected="selected";
              }else {
                $selected="";
              }

              echo"<option {$selected} value='{$row1['aid']}'>{$row1['role_name']}</option>";

           } ?>
          </select>
        <?php } ?>

          <br><br>
          <div>
              <label>Gender:</label>
              <?php

                  if($row['gender'] == "Male"){
                    echo "<label>Male</label>  <input type='radio' name='gen' value='{$row['gender']}' checked>";

                  }else{

                    echo "<label>Female</label>  <input type='radio' name='gen' value='{$row['gender']}' checked>";

                  }
             ?>

            </div><br>
         <div>
         <input type="file" name="fileToUpload" ><br><br>
         <img src="upload/<?php echo $row['post_img']; ?>" style="width:70px; height:70px">
         <input type="hidden" name="old_image" value="<?php echo $row['post_img']; ?>">
         </div><br><br>
         <input type="submit" name="submit" value="Submit" size="35">


      </form>
    <?php }} ?>
    </fieldset>
    </div>
 </body>
</html>
