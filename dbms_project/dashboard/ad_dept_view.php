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
        $dept_id = $_SESSION['ad_dept_view_id'];
        $done = 0;
        if ($read_data == 1) {
            $sql = "SELECT dept_name, budget FROM department WHERE dept_id=".$dept_id;
            if ($result = $conn->query($sql)) {
                if ($result->num_rows == 1) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $dept_name = $row['dept_name'];
                        $budget = $row['budget'];
                    }
                }
            } else {
                echo "Query Failed";
            }
            $read_data = 0;
        }
        $budget_error = "";
        $dept_name_err = "";
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
            }
        }	

        // total subjects
        $total_courses = "0";
        $sql = "SELECT course_id FROM course WHERE dept_id = '".$dept_id."'";
        if ($result = $conn->query($sql)) {
            $total_courses = strval($result->num_rows);
        } else {
            echo "Query Failed";
        }
        // total faculty
        $total_faculty = "0";
        $sql = "SELECT i_mis FROM instructor WHERE dept_id = '".$dept_id."'";
        if ($result = $conn->query($sql)) {
            $total_faculty = strval($result->num_rows);
        } else {
            echo "Query Failed";
        }
        // total students
        $total_students = "0";
        $sql = "SELECT mis FROM student WHERE dept_id = '".$dept_id."'";
        if ($result = $conn->query($sql)) {
            $total_students = strval($result->num_rows);
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
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="ad_profile.php" aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i><span class="hide-menu">Profile</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link active"
                                href="ad_department.php" aria-expanded="false"><i class="fa fa-users"
                                    aria-hidden="true"></i><span class="hide-menu">Departments</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
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
                                <h3 class="box-title">DEPARTMENT DETAILS : </h3><br>
                                <form class="form-horizontal form-material" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Dept Id</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?php echo $dept_id ?>" class="form-control p-0 border-0" name="dept_id" disabled> </div>
                                    </div>
                                    <p id="dept_name_err" style="color:red"><?php echo $dept_name_err;?></p>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Department Name</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?php echo $dept_name ?>" class="form-control p-0 border-0" name="dept_name"  > </div>
                                    </div>
                                    <p id="budget_error" style="color:red"><?php echo $budget_error;?></p>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Budget</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?php echo $budget ?>" class="form-control p-0 border-0" name="budget">
                                        </div>
                                    </div>
                                    <div class="row form-group mb-4">
                                        <div >
                                            <div class="col-sm-12">
                                                <button type="submit" name="submit" class="btn btn-success" value="submit">Update Details</button>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="col-sm-12">
                                                <button name="submit" class="btn btn-block btn-danger text-white" value="delete">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Total Courses</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash"><canvas width="67" height="30"
                                            style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ml-auto"><span class="counter text-success"><?php echo $total_courses;?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Total Faculty</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash2"><canvas width="67" height="30"
                                            style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ml-auto"><span class="counter text-purple"><?php echo $total_faculty;?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Total Students</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash3"><canvas width="67" height="30"
                                            style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ml-auto"><span class="counter text-info"><?php echo $total_students;?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Courses in this Department : </h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Course Id</th>
                                            <th class="border-top-0">Title</th>
                                            <th class="border-top-0">Credits</th>
                                            <th class="border-top-0">Dept Id</th>
                                            <th class="border-top-0">Instructor Id</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $sql = "SELECT course_id, title,  credits, dept_id, i_mis FROM course WHERE dept_id = '".$dept_id."'";
                                            if ($result = $conn->query($sql)) {
                                                $total_courses = strval($result->num_rows);
                                                if ($total_courses >= 1) {
                                                    // echo "<script>alert(".$result->num_rows.")</script>";
                                                    // output data of each row
                                                    while($row = $result->fetch_assoc()) {
                                                        echo "<tr><td>" . $row["course_id"]. "</td><td>" . $row["title"]. "</td><td>" . $row["credits"]. "</td><td>" . $row["dept_id"]. "</td><td>" . $row["i_mis"]. "</td><td><button onclick='view(\"ad_course_view_id\", " . $row["course_id"]. ", \"ad_course_view.php\")' class='btn btn-block btn-danger text-white'>View</button></td></tr>";
                                                    }
                                                } else {
                                                    $total_courses = "0";
                                                }
                                            } else {
                                                echo "Query Failed";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Faculty in this Department : </h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">MIS</th>
                                            <th class="border-top-0">Name</th>
                                            <th class="border-top-0">Email</th>
                                            <th class="border-top-0">Dept Id</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $sql = "SELECT i_mis, fname, lname, email, dept_id FROM instructor WHERE dept_id = '".$dept_id."'";
                                            if ($result = $conn->query($sql)) {
                                                if ($result->num_rows >= 1) {
                                                    $total_faculty = strval($result->num_rows);
                                                    // output data of each row
                                                    while($row = $result->fetch_assoc()) {
                                                        echo "<tr><td>" . $row["i_mis"] . "</td><td>" . $row["fname"] . " " . $row["lname"] . "</td><td>" . $row["email"]. "</td><td>" . $row["dept_id"]. "</td><td><button onclick='view(\"ad_fact_view_id\", " . $row["i_mis"]. ", \"ad_fact_view.php\")' class='btn btn-block btn-danger text-white'>View</button></td></tr>";
                                                    }
                                                } else {
                                                    $total_faculty = "0";
                                                }
                                            } else {
                                                echo "Query Failed";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Students in this Department : </h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">MIS</th>
                                            <th class="border-top-0">Name</th>
                                            <th class="border-top-0">Email</th>
                                            <th class="border-top-0">Dept Id</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $sql = "SELECT mis, fname, lname, email, dept_id FROM student WHERE dept_id = '".$dept_id."'";
                                            if ($result = $conn->query($sql)) {
                                                if ($result->num_rows >= 1) {
                                                    $total_students = strval($result->num_rows);
                                                    // output data of each row
                                                    while($row = $result->fetch_assoc()) {
                                                        echo "<tr><td>" . $row["mis"] . "</td><td>" . $row["fname"] . " " . $row["lname"] . "</td><td>" . $row["email"]. "</td><td>" . $row["dept_id"]. "</td><td><button onclick='view(\"ad_std_view_id\", " . $row["mis"]. ", \"ad_std_view.php\")' class='btn btn-block btn-danger text-white'>View</button></td></tr>";
                                                    }
                                                } else {
                                                    $total_students = "0";
                                                }
                                            } else {
                                                echo "Query Failed";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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
        if($done == 2) {
            $sql = "UPDATE department SET dept_name = '".$dept_name."', budget = '".$budget."' WHERE dept_id = '".$dept_id."'";
            if ($result = mysqli_query($conn, $sql)) {
            } else {
                echo "query failed".$conn->error;
            }
        } else {
            
        }
        $done = 0;
        if (isset($_POST['submit'])) {
            if ($_POST['submit'] == "delete") {
                $sql = "DELETE FROM department WHERE dept_id = '".$dept_id."'";
                if ($result = $conn->query($sql)) {
                    echo "<script>alert('Department Deleted Successfully!!');</script>";
                    echo "<script>window.location.replace('ad_department.php');</script>";
                } else {
                    echo "<script>alert('Unable to delete Department as many other elements in this database depends on it!!');</script>";
                    echo "<script>window.location.replace('ad_dept_view.php');</script>";
                }
            }
        }
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