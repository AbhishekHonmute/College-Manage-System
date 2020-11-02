
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

        $done = 0;
        $read_data = 1;
        if ($read_data == 1) {
            $sql = "SELECT fname, lname, salary, mobile, email, city, dob, joining_year, dept_id FROM instructor WHERE i_mis = ".$i_mis." ";
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
                    }
                }
            } else {
                echo "Query Failed";
            }
            $read_data = 0;
        }
        $course_id = $_SESSION['fa_course_view_id'];
        $std_mis = $_SESSION['fa_std_view_id'];
        $std_fname = "";
        $std_lname = "";
        $std_mobile = "";
        $std_email = "";
        $std_dept_id = "";
        $read_std_data = 1;
        // $dept_id = "";
        // $dept_name = "";
        // $budget = "";
        // $budget_error = "";
        // $dept_name_err = "";
        // $dept_id_err = "";
        if ($read_std_data == 1) {
            $sql = "SELECT fname, lname, mobile, email, dept_id FROM student WHERE mis = ".$std_mis." ";
            if ($result = $conn->query($sql)) {
                if ($result->num_rows == 1) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $std_fname = $row['fname'];
                        $std_lname = $row['lname'];
                        $std_mobile = $row['mobile'];
                        $std_email = $row['email'];
                        $std_dept_id = $row['dept_id'];
                    }
                }
            } else {
                echo "<script>console.log('not')</script>";
            }
            $read_std_data = 0;
        }
        $attendance = "";
        $marks_t1 = "";
        $marks_t2 = "";
        $marks_end_sem = "";
        $attendance_err = "";
        $marks_t1_err = "";
        $marks_t2_err = "";
        $marks_end_sem_err = "";
        $read_attendance_data = 1;
        if ($read_attendance_data == 1) {
            $sql = "SELECT attendance FROM attendance WHERE mis = ".$std_mis." and course_id = '".$course_id."' ";
            if ($result = $conn->query($sql)) {
                if ($result->num_rows == 1) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $attendance = $row['attendance'];
                    }
                }
            } else {
                echo "<script>console.log('not')</script>";
            }
            $read_attendance_data = 0;
        }
        $read_marks_data = 1;
        if ($read_marks_data == 1) {
            $sql = "SELECT test1, test2, endsem FROM marks WHERE mis = ".$std_mis." and course_id = '".$course_id."' ";
            if ($result = $conn->query($sql)) {
                if ($result->num_rows == 1) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $marks_t1 = $row['test1'];
                        $marks_t2 = $row['test2'];
                        $marks_end_sem = $row['endsem'];
                    }
                }
            } else {
                echo "<script>console.log('not')</script>";
            }
            $read_marks_data = 0;
        }
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $done = 0;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo "uf";
            $attendance = test_input($_POST['attendance']);
            if ($attendance < 0 or $attendance > 100) {
                echo "<script>alert('unable!!');</script>";
                $attendance_err = "Attendance should be in percentage";
            } else {
                $attendance_err = "";
                $done = $done + 1;
            }
            $marks_t1 = test_input($_POST['marks_t1']);
            if ($marks_t1 < 0 or $marks_t1 > 20) {
                echo "uf";
                $marks_t1_err = "T1 marks should be in out of 20";
            } else {
                $marks_t1_err = "";
                $done = $done + 1;
            }
            $marks_t2 = test_input($_POST['marks_t2']);
            if ($marks_t2 < 0 or $marks_t2 > 20) {
                echo "uf";
                $marks_t2_err = "T2 marks should be in out of 20";
            } else {
                $marks_t2_err = "";
                $done = $done + 1;
            }
            $marks_end_sem = test_input($_POST['marks_end_sem']);
            if ($marks_end_sem < 0 or $marks_end_sem > 60) {
                echo "uf";
                $marks_end_sem_err = "End Sem marks should be in out of 60";
            } else {
                $marks_end_sem_err = "";
                $done = $done + 1;
            }
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
                                href="fa_profile.php" aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i><span class="hide-menu">Profile</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link active"
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
                <div class="col-lg-12 col-xlg-10 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="box-title">STUDENT DETAILS : </h3><br>
                                <form class="form-horizontal form-material" method="POST" ecntype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">From Course Id</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="number" value="<?php echo $course_id ?>" class="form-control p-0 border-0" name="course_id" disabled> </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">MIS</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="number" value="<?php echo $std_mis ?>" class="form-control p-0 border-0" name="mis" disabled> </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">First Name</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?php echo $std_fname ?>" class="form-control p-0 border-0" name="fname" disabled> </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Last Name</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?php echo $std_lname ?>" class="form-control p-0 border-0" name="lname" disabled> </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Mobile</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="number" value="<?php echo $std_mobile ?>" class="form-control p-0 border-0" name="mobile" disabled>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Email</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?php echo $std_email ?>" class="form-control p-0 border-0" name="email" disabled> </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Department</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?php echo $std_dept_id ?>" class="form-control p-0 border-0" name="email" disabled> </div>
                                    </div>
                                    <p id="attendance_err" style="color:red"><?php echo $attendance_err;?></p>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Attendance (%)</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="number" value="<?php echo $attendance ?>" class="form-control p-0 border-0" name="attendance"> </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0 mb-4">Marks</label>
                                            <div class="form-group mb-4 ml-4">
                                                <p id="attendance_err" style="color:red"><?php echo $marks_t1_err;?></p>
                                                <label class="col-md-12 p-0">T1 Marks (/20)</label>
                                                <div class="col-md-12 border-bottom p-0">
                                                    <input type="number" value="<?php echo $marks_t1 ?>" class="form-control p-0 border-0" name="marks_t1"> </div>
                                            </div>
                                            <div class="form-group mb-4 ml-4">
                                                <p id="attendance_err" style="color:red"><?php echo $marks_t2_err;?></p>
                                                <label class="col-md-12 p-0">T2 Marks (/20)</label>
                                                <div class="col-md-12 border-bottom p-0">
                                                    <input type="number" value="<?php echo $marks_t2 ?>" class="form-control p-0 border-0" name="marks_t2"> </div>
                                            </div>
                                            <div class="form-group mb-4 ml-4">
                                                <p id="attendance_err" style="color:red"><?php echo $marks_end_sem_err;?></p>
                                                <label class="col-md-12 p-0">End Sem Marks (/60)</label>
                                                <div class="col-md-12 border-bottom p-0">
                                                    <input type="number" value="<?php echo $marks_end_sem ?>" class="form-control p-0 border-0" name="marks_end_sem"> </div>
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
    <script src="plugins/bower_components/chartist/dist/chartist.min.js"></script>
    <script src="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="js/pages/dashboards/dashboard1.js"></script>
    <?php    
        if($done == 4) {
             echo "querydakufailed";
            $sql = "UPDATE attendance SET attendance = ".$attendance." WHERE mis = ".$std_mis." AND course_id = '".$course_id."'";
            if ($result = mysqli_query($conn, $sql)) {
                echo "<script>window.location.replace('fa_std_view.php');</script>";
            } else {
                echo "<script>alert('unable!!');</script>";
                echo "querydakufailed".$conn->error;
            }
            $sql = "UPDATE marks SET  test1= ".$marks_t1.", test2 = ".$marks_t2.", endsem = ".$marks_end_sem." WHERE mis = ".$std_mis." AND course_id = '".$course_id."'";
            if ($result = mysqli_query($conn, $sql)) {
                echo "<script>window.location.replace('fa_std_view.php');</script>";
            } else {
                echo "<script>alert('unable!!');</script>";
                echo "querydakufailed".$conn->error;
            }
            $done = 0;
        }
    ?>
</body>

</html>