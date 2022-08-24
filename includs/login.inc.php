<?php
session_start();

include "db.inc.php";

if(isset($_POST["username"]) && isset($_POST['password']))  
     {  
           if(empty($_POST["username"]) || empty($_POST["password"]))  
           {  
                $message = '<label>All fields are required</label>';  
           }  
           else  
           {  
               $password = trim($_POST['password']);
                $query = "SELECT * FROM user WHERE username = :username";  
                $statement = $conn->prepare($query);  
                $statement->execute(  
                     array(  
                          'username'     =>     $_POST["username"],  
                          
                     )  
                );  
                $count = $statement->rowCount(); 
                if($count > 0)  {
                    $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
                    $results = $statement->fetchAll();
                    foreach($results as $column=>$type)
                         
                    if(password_verify($password, $type['password'])){
                         if($type['type'] == 0){
                         $_SESSION["username"] = $_POST["username"];  
                              $_SESSION['id'] = $type["id"];
                         
                         header("Location:user.php");  
                         }else{
                         header("Location: ../admin-page/admin.php");
                         }
                    }else{
                         header("Location: ../index.php?error=Username or password are wrong!"); 
                    }
                  
               }else  
                {  
                    header("Location: ../index.php?error=Username ili password su pogresni!");  
                }  
           }
     }else{
          header("Location: ../index.php?error=Username ili password nisu poslani!");
     }
 