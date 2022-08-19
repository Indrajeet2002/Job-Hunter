<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $CompanyID = $_POST['CompanyID'] ?? '';
    $Company_Name = $_POST['Company_Name'] ?? '';
    $Company_Address = $_POST['Company_Address'] ?? '';
    $Company_PNum = $_POST['Company_PNum'] ?? '';
    $Company_Email = $_POST['Company_Email'] ?? '';
    //validate form
    $isvalid = true;
    
    //if valid, insert employee
    if($isvalid){
        //configuration
        define("DB_SERVER", "localhost");
        define("DB_USER", "root");
        define("DB_PWD", "");
        define("DB_NAME", "thebar_database");
        //database connection
        $mysqli = new mysqli(DB_SERVER, DB_USER, DB_PWD, DB_NAME);
        if($mysqli -> connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
            exit();
        }
        
        $query = "insert into employer(Company_Name, Company_Address, Company_PNum, Company_Email) values('" . $Company_Name ."','" . $Company_Address . "','". $Company_PNum . "','" . $Company_Email . "')" ;
        echo $query;
        $isInserted = $mysqli -> query($query);
        //check update
        if($isInserted) {
            //if success redirect to index
             header("location:index_company.php");
          } else {
            // UPDATE failed
            echo $mysqli->error();
          }
        
        //free memeory
        $isInserted->free_result();
        //close connection
        if(is_resource($mysqli)){
            $mysqli->close();
        }
    } 
}
?>
<!-- create from -->
<form action='' method='post'>
<div>
        Name: <input type='text' name='Company_Name'>
</div>
<div>
        Address: <input type='text' name='Company_Address'>
</div>
<div>
        Phone Number: <input type='text' name='Company_PNum'>
</div>
<div>
        Email: <input type='text' name='Company_Email'>
</div>
<input type='submit' value='submit'>
</form>

