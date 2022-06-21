
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


     <!-- Search Functionality -->

      <div class="container my-3">
          <h1 class="pt-3 pb-3 px-3">Search Results For <em>&quot;<?php echo $_GET['search'] ?>&quot;</em></h1>
         <?php 
             $noResult = false;
             $search = $_GET['search']; 
             $sql = "SELECT * FROM `threads` WHERE MATCH(thread_title,thread_desc) AGAINST('$search')";
             $result = mysqli_query($connect,$sql);
             while($row = mysqli_fetch_assoc($result)){
                 $noResult = true;
                 $thread_title = $row['thread_title'];
                 $thread_desc = $row['thread_desc'];
                 $thread_id = $row['thread_id'];
                 $url = "threadnew.php?threadid=".$thread_id;
                 echo'<div class="result container">
                        <h3><a href="'.$url.'" class="text-dark px-2">'.$thread_title.'</a></h3>
                        <p>'.$thread_desc.'</p>
                     </div>';
             }

             if(!$noResult){
                 echo'  <div class="jumbotron jumbotron-fluid pb-5">
                            <div class="container">
                                <p class="display-4">No Results Found</p>
                                <p class="lead">Suggestions:</p>
                                <ul>
                                    <li>Make sure that all words are spelled correctly.</li>
                                    <li>Try different keywords.</li>
                                    <li>Try more general keywords. </li>
                                </ul>
                            </div>
                        </div>';
             }
             
         ?>
          
         
      </div>

     
     
     <footer>
        <?php include 'partials/_footer.php' ?>
      </footer>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
