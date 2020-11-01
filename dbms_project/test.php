<?php 
    class admin_class {
        public $mis;
        public $password;
    }
    $admin = new admin_class();
    $admin->mis = "333333";
    $admin->password = "333333";
    $tempArray = json_encode($admin);
    file_put_contents('admin_data.json', $tempArray);
    $inp = file_get_contents('admin_data.json');
    $admin = json_decode($inp);
    echo $admin->password;
?>