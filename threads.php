<!-- threadlist -->

<!doctype html>
<html lang="en">
  <head>
    
    <!-- Required meta tags -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/PROJECT/style.css">
    <title>Coding Forums</title>
  </head>
  <body>
    
     <!-- DB Connection -->

     <?php  include 'partials/_dbconnect.php' ?>

      <!-- Navbar -->

      <?php  include 'partials/_header.php'  ?>

    
     <?php 
      
        $id = $_GET['catid'];

        $sql = "SELECT * FROM `categories`
                WHERE category_id = $id";
        $result = mysqli_query($connect,$sql);

        while($row = mysqli_fetch_assoc($result)){
          $catname = $row['category_name'];
          $catdesc = $row['category_description'];
        }
      
     ?>

    <?php 
      
        $showAlert = false;
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == 'POST'){
          $th_title = $_POST['title']; 
          $th_desc = $_POST['desc'];

          $th_title = str_replace("<" , "&lt;" , $th_title);
          $th_title = str_replace(">" , "&gt;" , $th_title);

          $th_desc = str_replace("<" , "&lt;" , $th_desc);
          $th_desc = str_replace(">" , "&gt;" , $th_desc);

          $sno = $_POST['sno']; 
          $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`)
                  VALUES('$th_title','$th_desc','$id','$sno',current_timestamp())";
          $result = mysqli_query($connect,$sql);
          $showAlert = true;    
          
          if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Success!</strong> Your thread has been added! Please wait for community to respond
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>';
          }

        }

        
      
    ?>
     

     <!-- Thread Info Ques. will be related to specific thread -->

     <div class="container my-4">
        <div class="jumbotron">
            <div class="container">
                <h2 class="display-4">Welcome to <?php echo $catname ?> Forums</h1>
                <p class="lead"><?php echo $catdesc ?></p>
                <hr class="my-4">
                <p class="lead">This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums allowed. Do not post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post questions. Remain respectful of other members at all times.</p>
                <a class="btn btn-primary btn-md" href="">Learn More</a>
            </div>
        </div>
     </div>

   
      
  <?php 
      
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
      echo '<div class="container">
      <h1 class="pt-3 pb-3">Start Discussion :</h1>
        <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Problem Title :</label>
              <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp">
              <div id="emailHelp" class="form-text">Write Your Problem Short & Crisp</div>
            </div>
            <input type="hidden" name="sno" value="'. $_SESSION["sno"].'">
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">Elaborate Your Problem :</label>
              <textarea class="form-control" name="desc" rows="3" cols="4" id="desc"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>';
    }else{
      echo'<div class="container">
            <h1 class="pt-3 pb-3">Start Discussion :</h1>
            <h6 class="pt-2">You Are Not Logged In.Kindly Login To Start Discussion</h6>
          </div>'; 
    }
      
  ?>         

     

     <!-- Users Questions -->

     <div class="container">
         <h1 class="pt-3 pb-3">Browse Questions :</h1>

         <?php 
            $id = $_GET['catid'];
            $sql = "SELECT * FROM `threads`
                    WHERE thread_cat_id = $id";
            $result = mysqli_query($connect,$sql);
            $noResult = false;
            while($row = mysqli_fetch_assoc($result)){
              $noResult = true;
              $id = $row['thread_id'];
              $title = $row['thread_title'];
              $desc = $row['thread_desc'];
              $thread_user_id = $row['thread_user_id'];
              $sql2 = "SELECT Username,timeStamp FROM `users`
                       WHERE sno = '$thread_user_id'";
              $result2 = mysqli_query($connect,$sql2); 
              $row2 = mysqli_fetch_assoc($result2);
                 

              echo'<div class="d-flex media my-3">
                    <img src="img/users.png" width="54px" height="54px" class="mr-3" alt="...">
                    <div class="media-body"  style="padding-left: 0px;">
                      <h5 class="fw-bold my-0 pl-3" style="padding-left: 23px;padding-right: 11px;display: inline-block;padding-bottom: 10px" mb-3>'.$row2['Username'].'</h5>
                      <span  style="display: inline-block;opacity: 0.85;">'.$row2['timeStamp'].'</span>
                      <h5 class="font-weight-bold pl-3"><a class="text-dark"  style=" padding-left: 12px;" href="threadnew.php?threadid='.$id.'">'.$title.'</a></h5>
                      <p class="margin" style="padding-left: 21px;">'.$desc.'</p>
                    </div>
                  </div>';     
            }
            
            if(!$noResult){
              echo'<div class="jumbotron jumbotron-fluid">
                      <div class="container">
                          <p class="display-4 pt-3">No Comments Found</p>
                          <p class="lead"> Be the first person to comment</p>
                      </div>
                  </div>'; 
            }
        ?>
 
         
     </div>



    
     <!-- Footer -->

    <?php  include 'partials/_footer.php'  ?>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>