<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="css/login_style.css">
    </head>
    <body>
        <?php 
            require "connection.php";
        	$done = 0;
        	$mis = "";
            $email = "";
            $login_mode = "";
            $login_mode_err = "";
        	$mis_err = "MIS";
            $email_err = "Email";
            $invalid_email_err = "";
            $invalid_credentials_err = "";
        	function test_input($data) {
        				$data = trim($data);
        				$data = stripslashes($data);
        				$data = htmlspecialchars($data);
        				return $data;
        			}
        	if ($_SERVER["REQUEST_METHOD"] == "POST") {
        		if (empty($_POST['mis'])) {
        			$mis_err = "MIS is required";
        		} else {
        			$mis = test_input($_POST['mis']);
        			$done = $done + 1;
        		}
        		if (empty($_POST['email'])) {
        			$email_err = "Email is required";
        		} else {
                    $email = test_input($_POST['email']);
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $invalid_email_err = "Invalid email format";
                    } else {
                        $invalid_email_err = "";
                        $done = $done + 1;
                    }
                }
                if (empty($_POST['login_mode'])) {
                    $login_mode_err = "Mode required";
                } else {
                    $login_mode = test_input($_POST['login_mode']);
                    $done = $done + 1;
                }
        	}		
        ?>
        <div class="wrapper fadeInDown">
            <div id="formContent">
                <h1 style="font-family:Candara">College Of Engineering, Pune</h1>
                <p>Recover your Account Passowrd</p>
                <!-- Login Form -->
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">
                    <p id="invalid_credentials_err" style="color:red"><?php echo $invalid_credentials_err;?></p>
                    <input type="text" id="login" class="fadeIn second" value="<?php echo $mis;?>" name="mis" placeholder="<?php echo $mis_err;?>">
                    <p id="invalid_email_err" style="color:red"><?php echo $invalid_email_err;?></p>
                    <input type="text" id="email" class="fadeIn third" value="<?php echo $email;?>" name="email" placeholder="<?php echo $email_err;?>"><br>
                    <p id="mode_error" style="color:red"><?php echo $login_mode_err;?></p>
                    <input type="radio" id="student" name="login_mode" value="student" checked>
                    <label for="student">Student</label>      
                    <input type="radio" id="faculty" name="login_mode" value="faculty">
                    <label for="faculty">Faculty</label>
                    <input type="radio" id="admin" name="login_mode" value="admin">
                    <label for="admin">Admin</label><br>
                    <input type="submit" class="fadeIn fourth" value="Send Mail">
                </form>
        
            </div>
        </div>
        <?php
            // supposed to work here
            if ($done == 3) {
                // echo "<script>alert('Form submitted successfully')</script>";
                $sql = "SELECT username, password, admin FROM login_details_table WHERE username = '".$username."'";
				if ($result = mysqli_query($conn, $sql)) {
					$row = mysqli_num_rows($result);
					if ($row == 0) {
						echo '<script language="javascript">';
						echo 'alert("Username Not Found")';
						echo '</script>';
					} else {
						$row = mysqli_fetch_assoc($result);	
						if ($row['admin'] == 1) {
							if (strcasecmp($row["password"], $password) == 0) {
								echo "valid admin";	
								$login = 1;
								session_start();
								$_SESSION['login_user'] = $username;
								header("location: faculty_dashboard.php");
							}
						} else {
							echo '<script language="javascript">';
							echo 'alert("Incorrect Password")';
							echo '</script>';
						}
					}
				}else {
					echo "query failed".$conn->error;
				}
				$conn->close();
            }
        ?>
    </body>
</html>