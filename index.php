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

    
      <!-- Slider -->

     <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="img/cod2.png" class="d-block w-100" alt="..."> 
          </div>
          <div class="carousel-item">
            <img src="img/cod3.png" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="img/cod4.png" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

    <!-- Categories Container -->

    <div class="container my-4">
        <h1 class="text-center mt-4 mb-4">iDiscuss - Categories</h1>
            <div class="row">
             <?php 
               
               $sql = "SELECT * FROM `categories`";
               $result = mysqli_query($connect,$sql);

               while($row = mysqli_fetch_assoc($result)){

                $id = $row['category_id']; 
                $cat = $row['category_name'];
                $desc = $row['category_description'];

                echo'<div class="col-md-4 my-2" style="position: relative;left: 80px;">   
                        <div class="card mt-3 mb-3" style="width: 17rem;">
                            <img src="img/'.$cat.'.jpeg"  height="230px" width="230px" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><a href="threads.php?catid='.$id.'">'.$cat.'</a></h5>
                                <p class="card-text">'.substr($desc,0,90).'...</p>
                                <a href="threads.php?catid='.$id.'" class="btn btn-primary">View Threads</a>
                            </div>
                        </div>
                    </div>';    
               }
               
             ?>
             
                
           </div>
    </div>

    <?php  include 'partials/_footer.php'  ?>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>