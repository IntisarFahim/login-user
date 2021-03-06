<!DOCTYPE html>
<html>
    
    <body>
        <?php

            $firstname = $lastname = $gender = $email = $username = $password = $rec_email ="";
            $emptyfirstname = $emptylastname= $emptygender = $emptyemail = $emptyusername = $emptypassword = $emptyrec_email = $notavailable = "";

            if($_SERVER['REQUEST_METHOD'] == "POST") {

                if(empty($_POST['fname'])) {
                     $emptyfirstname = "Please Fill up the firstname!";
                }

                else if(empty($_POST['lname'])) {                    
                    $emptylastname = "Please Fill up the lastname!";
                    
                }

                else if(empty($_POST['gender'])) {                    
                    $emptygender= "Please Fill up the gender!";
                    
                }

                else if(empty($_POST['e-mail'])) {                    
                   $emptyemail = "Please Fill up the email!";
                    
                }

                else if(empty($_POST['uname'])) {                    
                   $emptyusername  = "Please Fill up the username!";
                }

                else if(empty($_POST['pass'])) {                    
                   $emptypassword = "Please Fill up the password!";
                }

                else if(empty($_POST['remail'])) {                    
                   $emptyrec_email = "Please Fill up the recovery email!";
                }

                else {

                    $firstname = $_POST['fname'];
                    $lastname = $_POST['lname'];
                    $gender = $_POST['gender'];
                    $email = $_POST['e-mail'];
                    $username = $_POST['uname'];
                    $password = $_POST['pass'];
                    $rec_email = $_POST['remail'];
        

                    $log_file = fopen("Login.txt", "r");
                    
                    $data = fread($log_file, filesize("Login.txt"));
                    
                    fclose($log_file);
                    
                    $data_filter = explode("\n", $data);

                    for($i = 0; $i< count($data_filter)-1; $i++) {

                        $json_decode = json_decode($data_filter[$i], true);

                        if( $json_decode['username'] == $username ) 
                        {
                            $notavailable = "Username not available!";
                        }
                        else {                       
                            $details = array('firstname' => $firstname, 'lastname' => $lastname, 'gender' => $gender, 'email' => $email, 'username' => $username, 'password' => $password, 'rec_email' => $rec_email);
                            $details_encoded = json_encode($details);

                            $filepath = "Registration.txt";

                            $reg_file = fopen($filepath, "a");
                            fwrite($reg_file, $details_encoded . "\n");	
                            fclose($reg_file);

                            $usertable = array('username' => $username, 'password' => $password);
                            $usertable_encoded = json_encode($usertable);

                            $log_filepath = "Login.txt";

                            $log_file = fopen($log_filepath, "a");
                            fwrite($log_file, $usertable_encoded . "\n");	
                            fclose($log_file);

                          header('Location: login.php');
                            }
                        }
                    }
            }
        ?>

        <h1 style="background-color:DodgerBlue;">Registration Form</h1>
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

            <fieldset>
               <legend><h2 style="background-color:Violet;">Basic Information</h2></legend>

                <label for="firstname">First Name:</label>
                <input type="text" name="fname" id="firstname">
                <?php echo $emptyfirstname; ?>

                <br>

                <label for="lastname"> LastName:</label>
                <input type="text" name="lname" id="lastname">
                <?php echo $emptylastname; ?>

                <br>

                <label for="gender">Gender:  </label>
                <input type="radio" name="gender" id="male" value="male">  
                <label for="gender">Male </label>
                <input type="radio" name="gender" id="female" value="female">
                <label for="gender">Female </label>
                <input type="radio" name="gender" id="other" value="other">
                <label for="gender">Other </label>
                <?php echo $emptygender; ?>

                <br>

                <label for="email">Email:</label>
                <input type="email" placeholder="example@gmail.com" id="email" name="e-mail">
                <?php echo $emptyemail; ?>

            </fieldset>

            <fieldset>
             <legend> <h2 style="background-color:Violet;">Account Information</h2></legend>

                <label for="username">Username:</label>
                <input type="text" name="uname" id="username">
                <?php echo $emptyusername; echo $notavailable; ?>

                <br>

                <label for="parmanent_address">Password:</label>
                <input type="password" name="pass" id="password">
                <?php echo $emptypassword; ?>

                <br>

                <label for="rec_email">Recovery email:</label>
                <input type="email" id="rec_email" name="remail">
                <?php echo $emptyrec_email; ?>
                
                </fieldset>

            <input type="submit" value="Submit" > 
        </form>
        
    </body>
</html>


login-user
