<?php
$db_servername = "localhost";
	$db_username = "root";
	$db_password = "";
	$db1_name = "college";
require 'fpdf.php';
$conn = mysqli_connect($db_servername, $db_username, $db_password, $db1_name);
session_start();
$course_id = $_SESSION['fa_course_view_id'];

$sql = "SELECT title, credits, dept_id, i_mis FROM course WHERE course_id=".$course_id." ";
if ($result = $conn->query($sql)) {
    if ($result->num_rows == 1) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $title = $row['title'];
            $credits = $row['credits'];
            $dept_id = $row['dept_id'];
            $i_mis = $row['i_mis'];
        }
    }
} else {
    echo "Query Failed";
}

$sql = "SELECT dept_name FROM department WHERE dept_id=".$dept_id." ";
if ($result = $conn->query($sql)) {
    if ($result->num_rows == 1) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $dept_name = $row['dept_name'];
        }
    }
} else {
    echo "Query Failed";
}

$sql = "SELECT fname, lname FROM instructor WHERE i_mis=".$i_mis." ";
if ($result = $conn->query($sql)) {
    if ($result->num_rows == 1) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $fname = $row['fname'];
            $lname = $row['lname'];
            $instructor_name = $fname." ".$lname;
        }
    }
} else {
    echo "Query Failed";
}

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetLeftMargin(15);
$pdf->SetRightMargin(15);
// code for print Heading of tables
$pdf->SetFont('Arial','B',18);
// $sql ="SELECT mis, fname, lname, test1, test2, endsem, attendance FROM students, takes, marks, attendance WHERE takes.mis = student.mis AND takes.course_id = course.course_id";
// $sql ="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='college' AND `TABLE_NAME`='marks'";
$pdf->Cell(175,10,"COURSE REPORT", 0, 1, 'C');
$pdf->SetFont('Arial','BU',14);
$pdf->Cell(175,10,"Department of ".$dept_name, 0, 1, 'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(110,10,"Course Name: ".$title, 0, 0, 'L');
$pdf->Cell(110,10,"Course Id: ".$course_id, 0, 1, 'L');
$pdf->Cell(110,10,"Credits: ".$credits, 0, 0, 'L');
$pdf->Cell(110,10,"Instructor: ".$instructor_name, 0, 1, 'L');
// if ($result = $conn -> query($sql)) {
// $header= mysqli_fetch_all($result, MYSQLI_ASSOC);
// $cnt=1;
// if($result->num_rows > 0) {
//     foreach($header as $heading) {
//         foreach($heading as $column_heading)
//             $pdf->Cell(35,10,$column_heading,1, 0, 'C');    
//     }
// }
$header = array("MIS", "Test 1", "Test 2", "End Sem", "Total");
foreach($header as $column_heading) {
    $pdf->Cell(35,10,$column_heading,1, 0, 'C');  
}  


//code for print data
$sql ="SELECT mis, test1, test2, endsem  FROM marks WHERE course_id = ".$course_id." ";
if ($result = $conn -> query($sql)) {
$header=$result->fetch_assoc();
$cnt=1;
if($result->num_rows > 0) {
    foreach($result as $row) {
        $pdf->SetFont('Arial','',12);
        $pdf->Ln();
        $total = 0;
        $count = 0;
        foreach($row as $column) {
            $pdf->Cell(35,10,$column,1, 0, 'C');
            if ($count != 0) {
                $total = $total + $column;
            }
            $count = 1;
        }
        $pdf->Cell(35,10,$total,1, 0, 'C');
    } 
}
} else {
    echo $conn->error;
}
// $pdf->Output(I, $course_id . ".pdf");
$pdf -> Output();
?>