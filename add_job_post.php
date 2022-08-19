<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(!isset($_GET['CompanyID'])) {
        header("location:index_company.php");
    }
    $CompanyID = $_GET['CompanyID'];

    $Job_Type = $_POST['Job_Type'] ?? '';
    $Title = $_POST['Title'] ?? '';
    $Date_Posted = $_POST['Date_Posted'] ?? '';
    $Deadline = $_POST['Deadline'] ?? 'aaa';
    $Qualifications = $_POST['Qualifications'] ?? 'bbb';
    $Responsibilities = $_POST['Responsibilities'] ?? 'ccc';
    $SalaryRangeID = $_POST['SalaryRangeID'] ?? 'ddd';

    // checks to see if all fields are valid
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

        $query = "insert into job_post(Job_Type, Title, Date_Posted, Deadline, Qualifications, Responsibilities, SalaryRangeID, CompanyID) values('" . $Job_Type ."','" . $Title . "','". $Date_Posted . "','" . $Deadline . "','" .$Qualifications. "','" .$Responsibilities. "','" .$SalaryRangeID. "','" .$CompanyID. "')" ;
        echo $query;
        $isInserted = $mysqli -> query($query);

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
            Job Type: <input type='text' name='Job_Type'>
    </div>
    <div>
            Title: <input type='text' name='Title'>
    </div>
    <div>
            Date Posted: <input type='text' name='Date_Posted' placeholder='YYYY-MM-DD'>
    </div>
    <div>
            Deadline: <input type='text' name='Deadline' placeholder='YYYY-MM-DD'>
    </div>
    <div>
            Qualifications: <input type='text' name='Qualifications'>
    </div>
    <div>
            Responsibilities: <input type='text' name='Responsibilities'>
    </div>
    <div>
            SalaryRange: <input type='text' name='SalaryRangeID'>
    </div>
    <input type='submit' value='submit'>
</form>
