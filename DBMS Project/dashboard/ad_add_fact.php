<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 4 admin, bootstrap 4, css3 dashboard, bootstrap 4 dashboard, Ample lite admin bootstrap 4 dashboard, frontend, responsive bootstrap 4 admin template, Ample admin lite dashboard bootstrap 4 dashboard template">
    <meta name="description"
        content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Admin Dashboard</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />
    
    <link href="css/style.min.css" rel="stylesheet">
    
</head>

<body>
    <?php 
        require "connection.php";
        session_start();
        $inp = file_get_contents('admin_data.json');
        $admin = json_decode($inp);
        $fname = $admin->fname;
        $lname = $admin->lname;
        $email = $admin->email;
        $city = $admin->city;
        $mobile = $admin->mobile;
        $joining_year =  $admin->joining_year;
        $dob = $admin->dob;
        $read_data = 1;
        $done = 0;
        $i_mis = "";
        $fname = "";
        $lname = "";
        $salary = "";
        $mobile = "";
        $email = "";
        $city = "";
        $dob = "";
        $joining_year = "";
        $dept_id = "";
        $photo = "";
        $i_mis_err = "";
        $fname_err = "";
        $lname_err = "";
        $salary_err = "";
        $mobile_err = "";
        $email_err = "";
        $city_err = "";
        $dob_err = "";
        $joining_year_err = "";
        $dept_id_err = "";
        $photo_err = "";
        // $dept_id = "";
        // $dept_name = "";
        // $budget = "";
        // $budget_error = "";
        // $dept_name_err = "";
        // $dept_id_err = "";
        if (isset($_POST['submit'])) {
            if($_POST['submit'] == "cancel") {
                echo "<script>window.location.replace('ad_faculty.php');</script>";
            }
        }
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['i_mis'])) {
        		$i_mis_err = "MIS is required";
        	} else {
                $i_mis = test_input($_POST['i_mis']);
                $i_mis_err = "";
        		$done = $done + 1;
            }
            if (empty($_POST['fname'])) {
                $fname_err = "fname is required";
            } else {
                $fname = test_input($_POST['fname']);
                $fname_err = "";
                $done = $done + 1;
            }
            $lname = test_input($_POST['lname']);
            $salary = test_input($_POST['salary']);
            if (empty($_POST['mobile'])) {
                $mobile_err = "Mobile is required";
            } else {
                $mobile = test_input($_POST['mobile']);
                $mobile_err = "";
                $done = $done + 1;
            }
            $email = test_input($_POST['email']);
        	if (empty($_POST['email'])) {
        		$email_err = "email is required";
        	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_err = "Invalid email format";
            } else {
                $email_err = "";
        		$done = $done + 1;
            }
            $city = test_input($_POST['city']);
            if (empty($_POST['dob'])) {
                $dob_err = "Date of Birth is required";
            } else {
                $dob = test_input($_POST['dob']);
                $dob_err = "";
                $done = $done + 1;
            }
            $joining_year = test_input($_POST['joining_year']);
            if (empty($_POST['dept_id'])) {
                $dept_id_err = "Department ID is required";
            } else {
                $dept_id = test_input($_POST['dept_id']);
                $dept_id_err = "";
                $done = $done + 1;
            } 
            if(isset($_FILES['photo'])){
                                
                $check = getimagesize($_FILES['photo']['tmp_name']);
                if($check !== false) {
                    $target_dir = "faculty_photos/";
                    $target_file =  $target_dir . basename($_FILES["photo"]["name"]);
                    $name       = $_FILES['photo']['name'];  
                    $tmp_name  = $_FILES['photo']['tmp_name'];  
                    
                    // $uploadok = 1;
                    $image_file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    echo "File is an image - " . $check["mime"] . ".";
                    $photo_err = "";
                    // if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                    //     echo "The file ". htmlspecialchars( basename( $_FILES["photo"]["name"])). " has been uploaded.";
                    // } else {
                    //     echo "Sorry, there was an error uploading your file.";
                    // }
                    $done = $done + 1;
                } }
            else {
                $photo_err = "Profile Photo is not of any size";
            }
            /* if (empty($_POST['dept_id'])) {
        		$dept_id_err = "department id is required";
        	} else {
                $dept_id = test_input($_POST['dept_id']);
                $dept_id_err = "";
        		$done = $done + 1;
            }
        	if (empty($_POST['dept_name'])) {
        		$dept_name_err = "department name is required";
        	} else {
                $dept_name = test_input($_POST['dept_name']);
                $dept_name_err = "";
        		$done = $done + 1;
            }
            if (empty($_POST['budget'])) {
                $budget_err = "budget is required";
            } else {
                $budget = test_input($_POST['budget']);
                $done = $done + 1;
            } */
        }
    ?>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a style="font-size: 30px;margin: 0px;color: black;margin-left: 20px;" href="https://www.coep.org.in/">COEP</a>  
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- toggle and nav items when window is small menue icon -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <span style="font-size: 30px;margin: 0px;color: white;margin-left: 20px;">College Of Engineering, Pune</span>
                    
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav ml-auto d-flex align-items-center">

                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        
                        <li><a class="profile-pic" href="#"></a>
                                    <span class="text-white font-medium" style="margin-right: 20px;"><?php echo $fname;echo " ";echo $lname; ?></span></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="ad_profile.php" aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i><span class="hide-menu">Profile</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="ad_department.php" aria-expanded="false"><i class="fa fa-users"
                                    aria-hidden="true"></i><span class="hide-menu">Departments</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link active"
                            href="ad_faculty.php" aria-expanded="false"><i class="fab fa-black-tie"
                                aria-hidden="true"></i><span class="hide-menu">Faculty</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="ad_courses.php" aria-expanded="false"><i class="fa fa-book"
                                    aria-hidden="true"></i><span class="hide-menu">Courses</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="ad_student.php" aria-expanded="false"><i class="fas fa-child"
                                    aria-hidden="true"></i><span class="hide-menu">Students</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="ad_enroll.php" aria-expanded="false"><i class="fas fa-pen-square"
                                    aria-hidden="true"></i><span class="hide-menu">Enroll</span></a></li>
                        <li class="text-center p-20 upgrade-btn">
                            <a href="http://localhost:8080/dbms_project/logout.php"
                                class="btn btn-block btn-danger text-white">Logout</a>
                        </li>
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        
        <div class="page-wrapper">
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="col-lg-12 col-xlg-10 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="box-title">ADD FACULTY : </h3><br>
                                <form  enctype="multipart/form-data" class="form-horizontal form-material" method="POST" ecntype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">
                                    <p id="i_mis_err" style="color:red"><?php echo $i_mis_err;?></p>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">MIS</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="number" value="<?php echo $i_mis ?>" class="form-control p-0 border-0" name="i_mis"> </div>
                                    </div>
                                    <p id="fname_err" style="color:red"><?php echo $fname_err;?></p>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">First Name</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?php echo $fname ?>" class="form-control p-0 border-0" name="fname"  > </div>
                                    </div>
                                    <p id="lname_err" style="color:red"><?php echo $lname_err;?></p>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Last Name</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?php echo $lname ?>" class="form-control p-0 border-0" name="lname"  > </div>
                                    </div>
                                    <p id="salary_err" style="color:red"><?php echo $salary_err;?></p>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Salary</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="number" value="<?php echo $salary ?>" class="form-control p-0 border-0" name="salary"> </div>
                                    </div>
                                    <p id="mobile_err" style="color:red"><?php echo $mobile_err;?></p>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Mobile</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="number" value="<?php echo $mobile ?>" class="form-control p-0 border-0" name="mobile">
                                        </div>
                                     <p id="email_err" style="color:red"><?php echo $email_err;?></p>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">email</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?php echo $email ?>" class="form-control p-0 border-0" name="email"  > </div>
                                    </div>
                                    <p id="city_err" style="color:red"><?php echo $city_err;?></p>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">City</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?php echo $city ?>" class="form-control p-0 border-0" name="city"  > </div>
                                    </div>
                                    <p id="dob_err" style="color:red"><?php echo $dob_err;?></p>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Date of Birth</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="date" value="<?php echo $dob ?>" class="form-control p-0 border-0" name="dob"  > </div>
                                    </div>
                                    <p id="joining_year_err" style="color:red"><?php echo $joining_year_err;?></p>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Joining Year</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="number" value="<?php echo $joining_year ?>" class="form-control p-0 border-0" name="joining_year"  > </div>
                                    </div>
                                    <p id="dept_id_err" style="color:red"><?php echo $dept_id_err;?></p>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Department</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control p-0 border-0" name="dept_id">
                                                <?php
                                                    $sql = "SELECT dept_id, dept_name FROM department";
                                                    if ($result = $conn->query($sql)) {
                                                        if ($result->num_rows >= 1) {
                                                            while($row = $result->fetch_assoc()) {
                                                                echo "<option value='".$row['dept_id']."'>" . $row["dept_id"]. " - ".$row['dept_name']."</option>";
                                                            }
                                                        }
                                                    } else {
                                                        echo "Query Failed";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <p id="photo_err" style="color:red"><?php echo $photo_err;?></p>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Profile Photo</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="file" name="photo"  />
                                         </div> 
                                    </div>
                                    <div class="row form-group mb-4">
                                        <div >
                                            <div class="col-sm-12">
                                                <button type="submit" name="submit" class="btn btn-success" value="upload">Add</button>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="col-sm-12">
                                                <button name="submit" class="btn btn-block btn-danger text-white" value="cancel">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center"> 2020 © www.coep.org.in
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="plugins/bower_components/popper.js/dist/umd/popper.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="js/app-style-switcher.js"></script>
    <script src="plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>
    <!-- Chart -->
    <script src="plugins/bower_components/chartist/dist/chartist.min.js"></script>
    <script src="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="js/pages/dashboards/dashboard1.js"></script>
    <?php 
        if($done == 7) {
            $sql = "SELECT i_mis FROM instructor WHERE i_mis = ".$i_mis." ";
            if ($result = $conn->query($sql)) {
                if ($result->num_rows == 0) {
                    $target_file =  "faculty_photos/" . basename($_FILES["photo"]["name"]);
                    echo $target_file;
                    $sql = "INSERT INTO instructor VALUES (".$i_mis.", '".$fname."', '".$lname."', ".$salary.", ".$mobile.", '".$email."', '".$city."', '".$dob."', ".$joining_year.", ".$dept_id.", '".$target_file."')";
                    if ($result = mysqli_query($conn, $sql)) {
                        $_SESSION['ad_fact_view_id'] = $i_mis;
                        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                            echo "<script>alert('Image Uploaded successfully')</script>";
                        } else {
                            echo "<script>alert('Unable to upload image.')</script>";
                        }
                        echo "<script>window.location.replace('ad_fact_view.php');</script>";
                    } else {
                        echo "<script>alert('MIS of fac.')</script>";
                    }
                } else {
                    echo "<script>alert('MIS of faculty already exists. Please choose unique one.')</script>";
                }
            } else {
                echo "<script>alert('MIS of faculty e unique one.')</script>";
            }
        }
        $done = 0;
        
    ?>
    <script> 
        function view(name, value, loc) {
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "set_session.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("session_name=" + name + "&session_value=" + value);
            window.location.replace(loc);
        }
    </script>
</body>

</html>