<?php 

    $showAlert = false;
    $showError = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // connecting with db

        include '_dbconnect.php';

        // storing in variables

        $username = $_POST['signupEmail'];
        $password = $_POST['signupPassword'];
        $cpassword = $_POST['signupcPassword'];

        // Check whether this username exists in DB:

        $existSql = "SELECT * FROM `users`
                     WHERE Username = '$username'";
        $result = mysqli_query($connect,$existSql);   
        
        // finding no of rows :
        $numRows = mysqli_num_rows($result);

        if($numRows > 0){
            $showError = "Username Already Exists";
        }else{

            // Sql query for checking both the password are same :

            if($password == $cpassword){
                $sql = "INSERT INTO `users`(`Username`,`Password`,`timestamp`)
                        VALUES('$username','$password',current_timestamp())";
                $result = mysqli_query($connect,$sql); 
                if($result){
                    $showAlert = true;
                    header("Location: /PROJECT/index.php?signupsuccess=true");
                    exit();
                }       
            }else{
                $showError = "Password Mismatch";
            } 

        }
        header("Location: /PROJECT/index.php?error=$showError");

    }
    
?>