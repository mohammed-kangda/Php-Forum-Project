<?php 
    $showErr = false;
    $login = false;

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // connecting wit db

        include '_dbconnect.php';

        // storing into variable 

        $username = $_POST['loginEmail']; 
        $password = $_POST['loginPass'];

        // sql query to check weather user info. is matched with the database :

        $sql = "SELECT * FROM `users`
                WHERE Username = '$username'";
        $result = mysqli_query($connect,$sql);
        
        // checking no. of rows
        
        $numRows = mysqli_num_rows($result);

        if($numRows == 1){
            
            $row = mysqli_fetch_assoc($result);
              
            // sql query to check weather user pass. is matched with the database :

            if($password == $row['Password']){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['sno'] = $row['sno'];
            }else{
                $showErr = "Incorrect Password";
            }
           
        }else{
            $showErr = "Incorrect Username"; 
        } 
         header("location: /PROJECT/index.php?msg=$showErr");
         
       
        
    }
    
?>