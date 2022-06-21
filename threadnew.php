<!-- thread -->


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

  <?php include 'partials/_dbconnect.php' ?>

  <!-- Navbar -->

  <?php include 'partials/_header.php'  ?>


  <?php
  $id = $_GET['threadid'];
  $sql = "SELECT * FROM `threads`
                WHERE thread_id = '$id'";

  $result = mysqli_query($connect, $sql);
  $noResult = false;
  while ($row = mysqli_fetch_assoc($result)) {
    $noResult = true;
    $title = $row['thread_title'];
    $desc = $row['thread_desc'];
    $thread_user_id = $row['thread_user_id'];

    $sql2 = "SELECT Username From `users`
                     WHERE sno = '$thread_user_id'";
    $result2 = mysqli_query($connect, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $posted_by = $row2['Username'];
  }
  ?>


  <!-- Storing User Comment In DB -->

  <?php

  $showAlert = false;
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $showAlert = true;
    $comment_content = $_POST['comment'];
    $comment_content = str_replace("<" , "&lt;" , $comment_content);
    $comment_content = str_replace(">" , "&gt;" , $comment_content);
    $sno = $_POST['sno'];
    $sql = "INSERT INTO `comments`(`comment_content`,`thread_id`,`comment_time`,`comment_by`)
            VALUES('$comment_content','$id',current_timestamp(),'$sno')";

    $result = mysqli_query($connect, $sql);
  }

  if ($showAlert) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success!</strong> Your comment has been added!
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
  }

  ?>



  <!-- Thread Info Ques. will be related to specific thread -->

  <div class="container my-4">
    <div class="jumbotron">
      <div class="container">
        <h2 class="display-4"><?php echo $title ?></h1>
          <p class="lead"><?php echo $desc ?></p>
          <hr class="my-4">
          <p class="lead">This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums allowed. Do not post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post questions. Remain respectful of other members at all times.</p>
          <p class="lead">Posted By :<b><?php echo $posted_by ?></b></p>
      </div>
    </div>
  </div>

  <?php

  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
    echo '<div class="container">
                <h1 class="pt-3 pb-3">Post A Comment :</h1>
                  <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
                      <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Reply :</label>
                        <textarea class="form-control" name="comment" rows="3" cols="4" id="comment"></textarea>
                        <input type="hidden" name="sno" value="' . $_SESSION["sno"] . '">
                      </div>
                      <button type="submit" class="btn btn-success">Post</button>
                  </form>
          </div>';
  } else {
    echo '<div class="container">
                <h1 class="pt-3 pb-3">Post A Comment :</h1>
                <h6 class="pt-2">You Are Not Logged In.Kindly Login To Post Comment</h6>
            </div>';
  }

  ?>


  <!-- Users Questions -->

  <div class="container">
    <h1 class="pt-5 pr-4 pb-3">Discussions :</h1>

    <!-- Displaying user comment from the database -->

    <?php

    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `comments`
            WHERE thread_id = '$id'";
    $result = mysqli_query($connect, $sql);
    $noResult = true;

    while ($row = mysqli_fetch_assoc($result)) {
      $noResult = false;
      $id = $row['comment_id'];
      $content = $row['comment_content'];
      $comment_time = $row['comment_time'];
      $thread_user_id = $row['comment_by'];
      $sql2 = "SELECT Username From `users`
                 WHERE sno = '$thread_user_id'";
      $result2 = mysqli_query($connect, $sql2);
      $row2 = mysqli_fetch_assoc($result2);


      echo '<div class="d-flex media my-3">
                  <img src="img/users.png" width="54px" height="54px" class="mr-3" alt="...">
                  <div class="media-body"  style="padding-left: 0px;">
                    <h5 class="font-weight-bold pl-3"  class="text-dark" style="padding-left: 13px;padding-right: 11px;display: inline-block;padding-bottom: 3px";">' . $row2['Username'] . '</h5>
                    <span  style="display: inline-block;opacity: 0.85;">' . $row['comment_time'] . '</span>
                    <p class="margin" style=" padding-left: 13px;">' . $content . '</p>
                  </div>
             </div>';
    }

    if ($noResult) {
      echo '<h5 class="pl-2 move">Be The First To Reply Comment</h5>';
    }
    ?>



  </div>




  <!-- Footer -->

  <?php include 'partials/_footer.php'  ?>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>