// Function for checking the password when user type it
        // Front-end provjera
    function checkPassword(password){
            // Regex pattern
        var passwordPattern =  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,20}/;
            if(!password.match(passwordPattern)){
                    document.getElementById("error").innerText = "Password is not good!";
            }else{
                    document.getElementById("error").innerText = "Password is good!";
            }
        }