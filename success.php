<?php
    $Email = $_GET['Email'];
    $Job_ID = $_GET['Job_ID'];

    $isvalid = true;

    if($isvalid){

        define("DB_SERVER", "localhost");
        define("DB_USER", "root");
        define("DB_PWD", "");
        define("DB_NAME", "thebar_database");

        $mysqli = new mysqli(DB_SERVER, DB_USER, DB_PWD, DB_NAME);
        if($mysqli -> connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
            exit();
        }

        $query = "insert into applications(Email, Job_ID) values('" . $Email ."','" . $Job_ID . "')" ;

        try{
            $isInserted = $mysqli -> query($query);
            echo "<h1>You have successfully applied for this job!</h1>";
        } catch(Exception $e){
            echo "<h1>You have already applied for this job!</h1>";
        }

        //free memeory
        // $isInserted->free_result();
        //close connection
        if(is_resource($mysqli)){
            $mysqli->close();
        }

        echo "<a href='index_employee.php?Email=$Email'>Home</a>";

    }

?>