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
                $email = test_input($_POST['email']);
        		if (empty($_POST['email'])) {
        			$email_err = "email is required";
        		} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $invalid_email_err = "Invalid email format";
                } else {
                    $invalid_email_err = "";
        			$done = $done + 1;
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
                <!-- Login Form -->
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">
                    <input type="text" id="login" class="fadeIn second" value="<?php echo $mis;?>" name="mis" placeholder="<?php echo $mis_err;?>">
                    <p id="mode_error" style="color:red"><?php echo $invalid_email_err;?></p>
                    <input type="text" id="email" class="fadeIn third" value="<?php echo $email;?>" name="email" placeholder="<?php echo $email_err;?>"><br>
                    <p id="mode_error" style="color:red"><?php echo $login_mode_err;?></p>
                    <input type="radio" id="student" name="login_mode" value="student" checked>
                    <label for="student">Student</label>      
                    <input type="radio" id="faculty" name="login_mode" value="faculty">
                    <label for="faculty">Faculty</label>
                    <input type="radio" id="admin" name="login_mode" value="admin">
                    <label for="admin">Admin</label><br>
                    <input type="submit" class="fadeIn fourth" value="submit">
                </form>
        
                <!-- Remind Passowrd -->
                <div id="formFooter">
                    <a class="underlineHover" href="#">Forgot Password?</a>
                </div>
        
            </div>
        </div>
        <?php
            // supposed to work here
            if ($done == 3) {
                // echo "<script>alert('Form submitted successfully')</script>";
                if ($_POST['login_mode'] == "admin") {
                    $inp = file_get_contents('dashboard/admin_data.json');
                    $admin = json_decode($inp);
                    echo "<script>console.log(" + $admin->mis + $admin->email + ")</script>";
                    if ($admin->mis == $_POST['mis'] and $admin->email == $_POST['email']) {
                        session_start();
                        $_SESSION['login_user_mis'] = $mis;
                        $_SESSION['login_mode'] = "admin";
                        header("Location: dashboard/ad_profile.php");
                    } else {
                        echo "<script>alert('Invalid Credentials!!')</script>";
					}
                } else if ($_POST['login_mode'] == "faculty") {
                    $sql = "SELECT i_mis, email FROM instructor WHERE i_mis = '".$mis."' and email = '".$email."'";
                    if ($result = mysqli_query($conn, $sql)) {
                        $row = mysqli_num_rows($result);
                        if ($row == 0) {
                            echo '<script language="javascript">';
                            echo 'alert("Invalid Credentials!!")';
                            echo '</script>';
                        } else {
                            $row = mysqli_fetch_assoc($result);	
                            session_start();
                            $_SESSION['login_user_mis'] = $mis;
                            $_SESSION['login_mode'] = "faculty";
                            header("Location: dashboard/fa_profile.php");
                        }
                    } else {
                        echo "query failed".$conn->error;
                    }
				}else {
					$sql = "SELECT mis, email FROM student WHERE mis = '".$mis."' and email = '".$email."'";
                    if ($result = mysqli_query($conn, $sql)) {
                        $row = mysqli_num_rows($result);
                        if ($row == 0) {
                            echo '<script language="javascript">';
                            echo 'alert("Invalid Credentials!!")';
                            echo '</script>';
                        } else {
                            $row = mysqli_fetch_assoc($result);	
                            session_start();
                            $_SESSION['login_user_mis'] = $mis;
                            $_SESSION['login_mode'] = "student";
                            header("Location: dashboard/st_profile.php");
                        }
                    } else {
                        echo "query failed".$conn->error;
                    }
				}
            } else {
                $done = 0;
            }
        ?>
    </body>
</html>