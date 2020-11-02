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
            $mobile = "";
            $login_mode = "";
            $login_mode_err = "";
        	$mis_err = "MIS";
            $mobile_err = "Mobile";
            $invalid_mobile_err = "";
            $invalid_credentials_err = "";
            $recovered_email = "";
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
        			$mis_err = "";
        			$done = $done + 1;
        		}
        		if (empty($_POST['mobile'])) {
        			$mobile_err = "Mobile is required";
        		} else {
                    $mobile = test_input($_POST['mobile']);
                    $mobile_err = "";
                    $done = $done + 1;
                }
                $login_mode = test_input($_POST['login_mode']);
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
                    <p id="invalid_mobile_err" style="color:red"><?php echo $invalid_mobile_err;?></p>
                    <input type="text" id="mobile" class="fadeIn third" value="<?php echo $mobile;?>" name="mobile" placeholder="<?php echo $mobile_err;?>"><br>
                    <p id="mode_error" style="color:red"><?php echo $login_mode_err;?></p>
                    <input type="radio" id="student" name="login_mode" value="student" checked>
                    <label for="student">Student</label>      
                    <input type="radio" id="faculty" name="login_mode" value="faculty">
                    <label for="faculty">Faculty</label>
                    <input type="radio" id="admin" name="login_mode" value="admin">
                    <label for="admin">Admin</label><br>
                    <input type="submit" class="fadeIn fourth" value="Recover Password">
        <?php
            // supposed to work here
            if ($done == 2) {
                if ($_POST['login_mode'] == "admin") {
                    $inp = file_get_contents('dashboard/admin_data.json');
                    $admin = json_decode($inp);
                    if ($admin->mis == $_POST['mis'] and $admin->mobile == $_POST['mobile']) {
                        $recovered_email =  $admin->email;
                    } else {
                        echo "<script>alert('Invalid Credentials!!')</script>";
					}
                } else if ($_POST['login_mode'] == "faculty") {
                    $sql = "SELECT i_mis, mobile, email FROM instructor WHERE i_mis = '".$mis."' and mobile = '".$mobile."'";
                    if ($result = mysqli_query($conn, $sql)) {
                        $row = mysqli_num_rows($result);
                        if ($row == 0) {
                            echo '<script language="javascript">';
                            echo 'alert("Invalid Credentials!!")';
                            echo '</script>';
                        } else {
                            $row = mysqli_fetch_assoc($result);	
                            $recovered_email =  $row['email'];
                        }
                    } else {
                        echo "query failed".$conn->error;
                    }
				}else {
					$sql = "SELECT mis, mobile, email FROM student WHERE mis = '".$mis."' and mobile = '".$mobile."'";
                    if ($result = mysqli_query($conn, $sql)) {
                        $row = mysqli_num_rows($result);
                        if ($row == 0) {
                            echo '<script language="javascript">';
                            echo 'alert("Invalid Credentials!!")';
                            echo '</script>';
                        } else {
                            $row = mysqli_fetch_assoc($result);
                            $recovered_email =  $row['email'];
                        }
                    } else {
                        echo "query failed".$conn->error;
                    }
				}
            }
        ?>
                </form>
                <div id="formFooter">
                    <p>Your Password Is : </P>
                    <p class="underlineHover"><?php echo $recovered_email;?></p>
                </div>
            </div>
        </div>
    </body>
</html>