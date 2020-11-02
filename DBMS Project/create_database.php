<!DOCTYPE html>
<html>
    <head>
        <title>Creat Database</title>
    </head>
    <body>
        <?php 
            require "dashboard/connection.php";
            $done = 0;
            // create department table 
            $sql = "CREATE TABLE IF NOT EXISTS department (
                dept_id	int,
                dept_name varchar(30) not null,
                budget int,
                check (budget >= 0),
                primary key	(dept_id)
                )";
            if ($conn->query($sql) === TRUE) {
                $done = $done + 1;
            } else {
                echo "Error creating department table: " . $conn->error;
            }
            // create instructor table 
            $sql = "CREATE TABLE IF NOT EXISTS instructor (
                i_mis int,
                fname varchar(20) not null,
                lname varchar(20),
                salary int,
                check (salary > 0),
                mobile bigint not null,
                email varchar(50) not null,
                city varchar(20),
                dob date not null ,
                joining_year year(4),
                dept_id	int not null,
                photo varchar(50),
                primary key	(i_mis),
                foreign key (dept_id) references department(dept_id) on delete restrict
                )";
            if ($conn->query($sql) === TRUE) {
                $done = $done + 1;
            } else {
                echo "Error creating instructor table: " . $conn->error;
            }
            // create course table
            $sql = "CREATE TABLE IF NOT EXISTS course (
                course_id	varchar(8),
                title		varchar(50) not null,
                credits		int not null,
                check (credits >= 0),
                dept_id	int not null,
                i_mis		int not null,
                primary key	(course_id),
                foreign key	(dept_id) references department(dept_id) on delete restrict,
                foreign key	(i_mis) references instructor(i_mis) on delete restrict
                )";

            if ($conn->query($sql) === TRUE) {
                $done = $done + 1;
            } else {
                echo "Error creating course table: " . $conn->error;
            }
            // create student table
            $sql = "CREATE TABLE IF NOT EXISTS student (
                mis		int,
                fname		varchar(20) not null,
                lname		varchar(20),
                mobile		bigint not null,
                email		varchar(50) not null,
                city		varchar(20),
                dob		date not null,
                joining_year	year(4),
                total_credits	int,
                dept_id	int not null,
                photo varchar(50),
                primary key 	(mis),
                foreign key 	(dept_id) references department(dept_id) on delete restrict
                )";

            if ($conn->query($sql) === TRUE) {
                $done = $done + 1;
            } else {
                echo "Error creating student table: " . $conn->error;
            }
            // create takes table 
            $sql = "CREATE TABLE IF NOT EXISTS takes (
                mis		int,
                course_id	varchar(8),
                primary key (mis, course_id),
                foreign key (mis) references student(mis) on delete cascade,
                foreign key (course_id) references course(course_id) on delete restrict
                )";

            if ($conn->query($sql) === TRUE) {
                $done = $done + 1;
            } else {
                echo "Error creating takes table: " . $conn->error;
            }
            // create attendence table
            $sql = "CREATE TABLE IF NOT EXISTS attendance (
                mis		int,
                course_id	varchar(8),
                attendance	int,
                check (attendance >= 0 and attendance <= 100),
                primary key (mis, course_id),
                foreign key (mis, course_id) references takes(mis, course_id) on delete cascade
                )";

            if ($conn->query($sql) === TRUE) {
                $done = $done + 1;
            } else {
                echo "Error creating attendence table: " . $conn->error;
            }
            // create marks table
            $sql = "CREATE TABLE IF NOT EXISTS marks(
                mis 		int,
                course_id 	varchar(8),
                test1		int,
                check(test1 <= 20),
                test2		int,
                check(test2 <= 20),
                endsem 	int, 
                check(endsem <= 60),
                primary key (mis, course_id),
                foreign key (mis, course_id) references takes(mis, course_id) on delete cascade
                )";

            if ($conn->query($sql) === TRUE) {
                $done = $done + 1;
            } else {
                echo "Error creating marks table: " . $conn->error;
            }
            // create adviser table
            $sql = "CREATE TABLE IF NOT EXISTS advisor (
                mis int,
                i_mis int,
                primary key (mis),
                foreign key (mis) references student(mis) on delete cascade,
                foreign key (i_mis) references instructor(i_mis) on delete restrict
                )";

            if ($conn->query($sql) === TRUE) {
                $done = $done + 1;
            } else {
                echo "Error creating adviser table: " . $conn->error;
            }
            // create classroom table 
            $sql = "CREATE TABLE IF NOT EXISTS classroom (
                course_id		varchar(8),
                class_no		int,
                capacity		int,
                primary key (course_id),
                foreign key (course_id) references course(course_id) on delete restrict
                )";

            if ($conn->query($sql) === TRUE) {
                $done = $done + 1;
            } else {
                echo "Error creating classroom table: " . $conn->error;
            }
        ?>
        <h2>
            <?php 
                if ($done == 9) {
                    echo "Database created successfully";
                } else {
                    echo "Unable to create database. Please check the mysql server is on and database is created";
                }
            ?>
        </h2>
    </body>
</html>