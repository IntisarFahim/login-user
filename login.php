<!DOCTYPE html>
<html>
    <body>
        <?php

            $username = $password ="";
            $emptyusername = $emptypassword ="";

            if($_SERVER['REQUEST_METHOD'] == "POST") {

                if(empty($_POST['uname'])) {                    
                    $emptyusername = "Please Fill up the Username!";
                }

                else if(empty($_POST['pass'])) {                    
                    $emptypassword = "Please Fill up the password!";
                }

                else {
                    $username = $_POST['uname'];
                    $password = $_POST['pass'];

                    $log_file = fopen("Login.txt", "r");
                    
                    $data = fread($log_file, filesize("Login.txt"));
                    
                    fclose($log_file);
                    
                    $data_filter = explode("\n", $data);
                    
                    for($i = 0; $i< count($data_filter)-1; $i++) {

                        $json_decode = json_decode($data_filter[$i], true);
                        if($json_decode['username'] == $username && $json_decode['password'] == $password) 
                        {
                            session_start();
                            $_SESSION['user'] = $username;
                            header("Location: details.php");
                        }
                    }
                    echo "Wrong Password! Please Try Again.";
                }
            }
        ?>
        
        <h1 style="background-color:DodgerBlue;">Login Form</h1>
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

            <fieldset>
              <legend><h2 style="background-color:Violet;">Login</h2></legend>
            
                <label for="username">Username:</label>
                <input type="text" name="uname" id="username">
                <?php echo $emptyusername; ?>

                <br>

                <label for="parmanent_address">Password:</label>
                <input type="password" name="pass" id="password">
                <?php echo $emptypassword; ?>
                
                </fieldset>

            <input type="submit" value="Login"> 
        </form>
        
    </body>
</html># login-user
