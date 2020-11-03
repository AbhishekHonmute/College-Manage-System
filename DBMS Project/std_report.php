 <?php
$db_servername = "localhost";
	$db_username = "root";
	$db_password = "";
	$db1_name = "college";
require 'fpdf.php';
$conn = mysqli_connect($db_servername, $db_username, $db_password, $db1_name);
session_start();
$mis = $_SESSION['login_user_mis'];
//$mis = "7486";

$sql = "SELECT fname, lname, dept_id, dob FROM student WHERE mis=".$mis." ";
if ($result = $conn->query($sql)) {
    if ($result->num_rows == 1) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $fname = $row['fname'];
            $lname = $row['lname'];
            $dept_id = $row['dept_id'];
            $dob = $row['dob'];
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
    echo "Query failed";
}

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetLeftMargin(15);
$pdf->SetRightMargin(15);
// code for print Heading of tables
$pdf->SetFont('Arial','B',18);
// $sql ="SELECT mis, fname, lname, test1, test2, endsem, attendance FROM students, takes, marks, attendance WHERE takes.mis = student.mis AND takes.course_id = course.course_id";
// $sql ="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='college' AND `TABLE_NAME`='marks'";
$pdf->Cell(175,10,"MARKLIST", 0, 1, 'C');
$pdf->SetFont('Arial','BU',14);
$pdf->Cell(175,10,"Department of ".$dept_name, 0, 1, 'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(110,10,"Name: ".$fname." ".$lname." ", 0, 0, 'L');
$pdf->Cell(110,10,"DOB: ".$dob, 0, 1, 'L');
$pdf->Cell(110,10,"MIS Id: ".$mis, 0, 0, 'L');
$pdf->Cell(110,10,"Branch: ".$dept_name, 0, 1, 'L');
// if ($result = $conn -> query($sql)) {
// $header= mysqli_fetch_all($result, MYSQLI_ASSOC);
// $cnt=1;
// if($result->num_rows > 0) {
//     foreach($header as $heading) {
//         foreach($heading as $column_heading)
//             $pdf->Cell(30,10,$column_heading,1, 0, 'C');    
//     }
// }
$header = array("Course Id", "Course Name", "Credits", "Total Marks");
$count = 0;
foreach($header as $column_heading) {
    if ($count == 1) {
        $pdf->Cell(90,10,$column_heading,1, 0, 'C');  
    } else {
        $pdf->Cell(30,10,$column_heading,1, 0, 'C');  
    }
    $count = $count + 1;
}  

//code for print data
$sql ="SELECT course_id, test1, test2, endsem  FROM marks WHERE mis = ".$mis." ";
if ($result = $conn -> query($sql)) {
    $header=$result->fetch_assoc();
    $cnt=1;
    $course_id = $header['course_id'];
    if($result->num_rows > 0) {
        foreach($result as $row) {
            $pdf->SetFont('Arial','',12);
            $pdf->Ln();
            $total = 0;
            $count = 0;
            foreach($row as $column) {
                if ($count == 0 ) {
                    $pdf->Cell(30,10,$column,1, 0, 'C');
                    $sql1 ="SELECT title, credits FROM course WHERE course_id = ".$column." ";
                    if ($result1 = $conn -> query($sql1)) {
                        $header1=$result1->fetch_assoc();
                        $count1 = 0;
                        foreach($result1 as $row1) {
                            foreach($row1 as $column1) {
                            if ($count1 == 0) {
                                $pdf->Cell(90,10,$column1,1, 0, 'L');
                            } else {
                                $pdf->Cell(30,10,$column1,1, 0, 'C');
                            }
                            $count1 = 1;
                        }}
                    } else {
                        echo "Query Failed";
                    } 
                }
                else {
                        $total = $total + $column;
                }
                $count = $count + 1;
            }
            $pdf->Cell(30,10,$total,1, 0, 'C');
        }
    } else {
        echo $conn->error;
    }
}
// $pdf->Output(I, $course_id . ".pdf");
$pdf -> Output();
?>
