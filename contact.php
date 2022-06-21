
<!doctype html>
<html lang="en">
  <head>

    <!-- Required meta tags -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>PROJECT</title>
    <link rel="stylesheet" href="style.css">
    
  </head>
  <body>
      
     <?php include 'partials/_dbconnect.php'?>

     <!-- Navbar -->

     <?php include 'partials/_header.php'?>

     <?php 
         
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          
        
          // storing in variable
          
          $username = $_POST['username'];
          $email = $_POST['email']; 
          $concern = $_POST['concern'];

          // sql query to insert form data

          $sql = "INSERT INTO `contact`(`Username`,`Email_Address`,`Concern`,`timestamp`)
                  VALUES('$username','$email','$concern',current_timestamp())";
          $result = mysqli_query($connect,$sql);

          if($result){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your response has been submitted successfully!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </button>
                 </div>';
          }else{
            echo "Failed to insert record --->" . mysqli_error($connect);
          }


        }   
       ?>

    <!-- Contact Form -->

    <?php

      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

        echo '<div class="container">
                  <h2 class="text-center mt-3">Contact Us :</h2>
                  <form action="/PROJECT/contact.php" method="post">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email Address :</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">Well never share your email with anyone else.</div>
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Elaborate Concern :</label>
                    <textarea class="form-control" name="concern" id="exampleFormControlTextarea1" rows="3"></textarea>
                  </div>
                  <input type="hidden" name="username" value="'.$_SESSION['username'].'">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>';
      }else{
        echo'<div class="container">
              <h2 class="text-center mt-3">Contact Us :</h2>
              <h6 class="pt-2 text-center mt-3">You Are Not Logged In.Kindly Login To Start Discussion With Us</h6>
            </div>'; 
      }
      
    ?>
    

     <footer>
        <?php include 'partials/_footer.php' ?>
     </footer>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
