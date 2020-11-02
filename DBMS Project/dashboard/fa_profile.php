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
    <title>Faculty Dashboard</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />

    <link href="css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <?php 
        require "connection.php";
        session_start();
        $i_mis = $_SESSION['login_user_mis'];
        $login_mode = $_SESSION['login_mode'];
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
        $done = 0;
        $read_data = 1;
        if ($read_data == 1) {
            $sql = "SELECT fname, lname, salary, mobile, email, city, dob, joining_year, dept_id, photo FROM instructor WHERE i_mis = ".$i_mis." ";
            if ($result = $conn->query($sql)) {
                if ($result->num_rows == 1) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $fname = $row['fname'];
                        $lname = $row['lname'];
                        $salary = $row['salary'];
                        $mobile = $row['mobile'];
                        $email = $row['email'];
                        $city = $row['city'];
                        $dob = $row['dob'];
                        $joining_year = $row['joining_year'];
                        $dept_id = $row['dept_id'];
                        $photo = $row['photo'];
                    }
                }
            } else {
                echo "Query Failed";
            }
            $read_data = 0;
        }
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $mobile = test_input($_POST['mobile']);
            if (empty($_POST['mobile'])) {
                $mobile_err = "Mobile is required";
            } else {
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
            // total students
        }
        $total_courses = "0";
        $sql = "SELECT course_id FROM course WHERE i_mis = '".$i_mis."'";
        if ($result = $conn->query($sql)) {
            $total_courses = strval($result->num_rows);
        } else {
            echo "Query Failed";
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
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link active"
                                href="fa_profile.php" aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i><span class="hide-menu">Profile</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="fa_courses.php" aria-expanded="false"><i class="fa fa-users"
                                    aria-hidden="true"></i><span class="hide-menu">Courses</span></a></li>
                        <li class="text-center p-20 upgrade-btn">
                            <a href="http://localhost:8080/dbms_project/logout.php"
                                class="btn btn-block btn-danger text-white" target="_blank">Logout</a>
                        </li>
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        
        <div class="page-wrapper">
            <div class="container-fluid">
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-12">
                        <div class="white-box">
                            <div class="user-bg"> 
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <img href="javascript:void(0)"><img src="<?php echo $photo; ?>"
                                                class="thumb-lg img-circle" alt="img"></img>
                                        <h4 class="text-white mt-2"><?php echo $fname;echo " ";echo $lname; ?></h4>
                                        <h5 class="text-white mt-2"><?php echo $email; ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="user-btm-box mt-5 d-md-flex">
                                <h1> MIS : <?php echo $i_mis; ?></h1>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">MIS</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?php echo $i_mis ?>" class="form-control p-0 border-0" name="i_mis" disabled> </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">First Name</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?php echo $fname ?>" class="form-control p-0 border-0" name="fname" disabled> </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Last Name</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?php echo $lname ?>" class="form-control p-0 border-0" name="lname" disabled> </div>
                                    </div>
                                    <p id="email_err" style="color:red"><?php echo $email_err;?></p>
                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0">Email</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="email" value="<?php echo $email ?>" class="form-control p-0 border-0" name="email" id="example-email">
                                        </div>
                                    </div>
                                    <p id="mobile_err" style="color:red"><?php echo $mobile_err;?></p>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Phone No</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?php echo $mobile ?>" class="form-control p-0 border-0" name="mobile">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">City</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?php echo $city ?>" class="form-control p-0 border-0" name="city">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Joining Year</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="number" value="<?php echo $joining_year ?>" class="form-control p-0 border-0" name="joining_year" disabled></input>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Dept Id</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?php echo $dept_id ?>" class="form-control p-0 border-0" name="dept_id" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Date Of Birth</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="date" value="<?php echo $dob ?>" class="form-control p-0 border-0" name="dob" disabled></input>
                                        </div>
                                    </div>
                                    <div class="row form-group mb-4">
                                        <div >
                                            <div class="col-sm-12">
                                                <button type="submit" name="submit" class="btn btn-success" value="submit">Update Details</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
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
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>
    <?php 
        if($done == 2) {
            $sql = "UPDATE instructor SET email = '".$email."', mobile = ".$mobile.", city = '".$city."' WHERE i_mis = ".$i_mis." ";
            if ($result = mysqli_query($conn, $sql)) {
                echo "<script>window.location.replace('fa_profile.php');</script>";
            } else {
                echo "<script>alert('unable!!');</script>";
                echo "querydakufailed".$conn->error;
            }
            $done = 0;
        } else {
            
        }
    ?>
</body>

</html>