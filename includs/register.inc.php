<?php
include 'db.inc.php';

if(isset($_POST['username']) && isset($_POST["password"]) && isset($_POST["passwordr"]) && isset($_POST["email"])){
    if(!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["passwordr"]) && !empty($_POST["email"])){
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $passwordr = htmlspecialchars($_POST['passwordr']);
        $email = htmlspecialchars($_POST['email']);

       
        // Pattern for username
         $usernamePattern = "/^(?!.*\d)(?=.*[a-z])(?!.*[A-Z])(?!.*[^a-zA-Z0-9])(?!.*\s).{8,20}/";
         if(preg_match($usernamePattern,$username)){
             echo "<h3>PHP: Username is good!</h3>";
             
            // Pattern for password
            $passwordPattern = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,20}/";
                if(preg_match($passwordPattern,$password)){
                    
                    echo "<h3>PHP: Password is good!</h3>";
                
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                       
                    if($password == $passwordr){
                        
                        $hash = password_hash($password, PASSWORD_DEFAULT);
                        
                        
                        try {
                        $sql = $conn->prepare("INSERT INTO user (username, password, email) VALUES( :username, :hash, :email)");
                        $sql->execute(['username' => $username, 'hash' => $hash, 'email' => $email]);
                            echo "Registered successufuly!";
                        }catch(PDOException $e) {
                            echo $sql . "<br>" . $e->getMessage();
                        }
                    
                    }else{
                        header ("Location: ../index.php?errors=Passwords are not the same!");
                        //echo "Passwords are not the same!";
                    }
                }else{
                    header ("Location: ../index.php?errors=Invalid email format!");
                    //$emailErr = "Invalid email format";
                }
            }else{
                header ("Location: ../index.php?errors=Password must contain 8-20 characters, at leaste one uppercase, one lowercase letters, number and a special character!");
            }
        }else{
            header ("Location: ../index.php?errors=Username must contain 8-20 characters and only lowercase letters!");
        }
    
    }else{
        header ("Location: ../index.php?errors=Username or password are empty!");
    }
}else{
    header ("Location: ../index.php?errors=No data entered!");
}