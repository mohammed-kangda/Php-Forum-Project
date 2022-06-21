<?php 
    session_start();
    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="/project">iDiscuss</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/PROJECT">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="about.php">About</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Top Categories
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';

            $sql = "SELECT * FROM `categories` LIMIT 3";
            $result = mysqli_query($connect,$sql);
            while($row = mysqli_fetch_assoc($result)){
                echo'<li><a class="dropdown-item" href="threads.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a></li>';
            }
              
             
           echo '</ul>
          </li>          
              <li class="nav-item">
                <a class="nav-link active" href="contact.php">Contact Us</a>
              </li>
        </ul>
        <form class="d-flex" action="search.php?search=" method="get">
          <input class="form-control me-2 search" name="search" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-primary mx-2 searchBtn">Search</button>';

        if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin']) == true){
            echo '<a href="partials/_logout.php" type="button" class="btn btn-outline-primary mx-2 pr-3">Logout</a>
                    <i class="fa-solid fa-circle-user fa-2x" style="margin-left: 10px;padding-top: 4px;filter: invert(1);"></i> 
                    <p class="fw-bold my-0 pl-3" style="padding-left: 8px;color: white;padding-right: 11px;padding-top: 7px;display: inline-block;">'.$_SESSION['username'].'</p>';             
        }else{
            echo '<button type="button" class="btn btn-outline-primary mx-2" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
                  <button type="button" class="btn btn-outline-primary mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>';
        }
        
  echo '</form>
     </div>
    </div>
  </nav>';

  include 'partials/_loginmodal.php';
  include 'partials/_signupmodal.php';
  include 'partials/_forgotmodal.php';

  // for successfully created account

  if(isset($_GET['signupsuccess']) && ($_GET['signupsuccess']) == 'true'){
    echo '<div class="alert alert-primary alert-dismissible fade show my-0" role="alert">
            <strong>Success!</strong> You can now login
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
  }

  // for signup information error

  if(isset($_GET['error']) && ($_GET['error']) == 'Password Mismatch'){
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            <strong>Error!</strong> ' .($_GET['error']).'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
  }else if(isset($_GET['error']) && ($_GET['error']) == 'Username Already Exists'){
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            <strong>Error!</strong> ' .($_GET['error']).'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
  }

  // for login inforamation error

  if(isset($_GET['msg']) && ($_GET['msg']) == 'Incorrect Password'){
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            <strong>Error!</strong> ' .($_GET['msg']).'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
  }else if(isset($_GET['msg']) && ($_GET['msg']) == 'Incorrect Username'){
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            <strong>Error!</strong> ' .($_GET['msg']).'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
  }

  // for password change successfully

  if(isset($_GET['passwordchanged']) && ($_GET['passwordchanged']) == true){
    echo '<div class="alert alert-primary alert-dismissible fade show my-0" role="alert">
            <strong>Success!</strong> Your Password has been changed
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
  }

  // for password info error

  if(isset($_GET['passError']) && ($_GET['passError'] == "Invalid Username")){
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            <strong>Error!</strong> ' .($_GET['passError']).'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
  }else if(isset($_GET['passError']) && ($_GET['passError'] == "Password Mismatch")){
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            <strong>Error!</strong> ' .($_GET['passError']).'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
  }
    
?>

