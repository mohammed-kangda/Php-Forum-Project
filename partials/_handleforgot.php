<?php

    $showMsg = false;
    $showError = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // connecting with db

        include '_dbconnect.php';

        // storing in variables

        $loginUser = $_POST['loginUser'];
        $loginfPass = $_POST['loginfPass'];
        $loginfcPass = $_POST['loginfcPass'];

        // sql query to check username is same as db

        $sql = "SELECT * FROM `users`
                WHERE Username = '$loginUser'";
        $result = mysqli_query($connect,$sql); 
        
         // checking no. of rows
        
         $numRows = mysqli_num_rows($result);

         if($numRows == 1){

            $row = mysqli_fetch_assoc($result);

              // checking both password entered by the user are same

               if($loginfPass == $loginfcPass){

                    // sql query to change the password

                    $updateSql = "UPDATE `users`
                                  SET Password = '$loginfcPass'
                                  WHERE Username = '$loginUser'";
                    $updateResult = mysqli_query($connect,$updateSql);

                    if($updateResult){
                        $showMsg = true;
                        header("Location: /PROJECT/index.php?passwordchanged=true");
                        exit();
                    }   

               }else{
                   $showError = "Password Mismatch";
               }

         }else{
             $showError = "Invalid Username";
         }
         header("Location: /PROJECT/index.php?passError=$showError");
    }
    
?>