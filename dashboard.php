 <?php session_start(); ?>

<html>
   <head>
      <title>A</title>
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <link rel="stylesheet" href="style/dashboard.css">

       <style>
       .card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
   width: 60%;
   margin-left:100px;
   margin-top:30px;
   color:white;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container {
  padding: 2px 16px;
}
       </style>
   </head>
   <body>

         <main>
            <div class="div1">
              <nav class="menu">
                  <div class="polaroid">
                      <img src="upload/<?php echo $_SESSION['img']; ?>" style="width:70px; height:70px">
                     <div class="container">
                       <p> <?php echo $_SESSION['username']; ?></p>
                     </div>
                   </div>
                  <ul>
                    <li><a href="#">Home</a></li>
                   <hr class="a">
                     <?php
                       if($_SESSION['role'] == 7){

                           echo" <li><a href='add-user.php'>User</a></li>";
                           echo" <hr class='a'>";
                           echo"<li><a href='post.php'>Post</a></li>";
                           echo"<hr class='a'>";
                       }
                     ?>

                 <li><a href="logout.php">Logout</a></li>
               </ul>
           </nav>
            </div>
            <div class="div2">
                <div class="tab">
                <?php
                     include"db.php";
                     $limit = 5;
                     if(isset($_GET['page'])){
                       $page = $_GET['page'];
                     }else{
                       $page = 1;
                     }
                     $offset = ($page - 1) * $limit;


                     if($_SESSION["role"] == '7'){
                       $sql="SELECT * FROM information ORDER BY user_id DESC LIMIT {$offset},{$limit}";



                     }elseif ($_SESSION["role"] == '8') {
                       // code...
                       $sql="SELECT * FROM information WHERE user_id={$_SESSION['uid']}  LIMIT {$offset},{$limit}";


                     }
                     $result=mysqli_query($conn,$sql) or die("query faield");
                     if(mysqli_num_rows($result)>0){
                 ?>
                      <table id="customers">
                        <tr>
                          <th>FirstName</th>
                          <th>LastName</th>
                          <th>UserName</th>
                          <th>Gender</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                        <?php
                        while($row=mysqli_fetch_assoc($result)){
                        ?>
                        <tr>
                          <td><?php echo $row['first_name']; ?></td>
                          <td><?php echo $row['last_name']; ?></td>
                          <td><?php echo $row['username']; ?></td>
                          <td><?php echo $row['gender']; ?></td>
                          <td><i class="fa fa-edit " > <a href="edit.php?id=<?php echo $row['user_id']; ?>" class="e">Edit</a></i></td>
                          <td><i class="fa fa-remove " ><a href="delete.php?id=<?php echo $row['user_id']; ?>" class="e"> Delete</a></i></td>
                        </tr>
                      <?php } ?>
                      </table>
                      <?php }
                      //pagination
                      $sql1 = "SELECT * FROM information";
                      $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");
                      if(mysqli_num_rows($result1) > 0){
                        $limit=5;
                        $total_records = mysqli_num_rows($result1);
                        $total_page = ceil($total_records / $limit);
                        echo '<div class="pa">';
                        echo '<ul class="pagination">';
                        if($page > 1){
                          echo '<li><a id="pag" href="dashboard.php?page='.($page - 1).'">Prev</a></li>';
                        }
                        for($i = 1; $i <= $total_page; $i++){
                          if($i == $page){
                            $active = "active";
                          }else{
                            $active = "";
                          }
                          echo '<li id="pag" class="'.$active.'"><a href="dashboard.php?page='.$i.'">'.$i.'</a></li>';
                        }
                        if($total_page > $page){
                          echo '<li><a  id="pag" href="dashboard.php?page='.($page + 1).'">Next</a></li>';
                        }

                        echo '</ul>';
                          echo '</div>';
                      }

                      ?>

                </div>
            </div>
            <div class="div3">
              <div class="rcnt">
              <h1 class="a">Recent Post</h1>
              <div class="srch">
              <input type="search" name="srch" placeholder="Search">
            </div>
            </div>

            


                  <div class="card">
                  <img src="upload/Layers.jpg" alt="Avatar" style="width:100%">
                  <div class="container">
                   <h4><b>John Doe</b></h4>
                   <p>Architect & Engineer</p>
                  </div>
                  </div>

            </div>
            <div class="div4">footer</div>
         </main>



 </body>
</html>
