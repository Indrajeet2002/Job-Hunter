<link rel="stylesheet" type="text/css" href="/styles.css">
<?php echo '<body style="background-color:white">'; ?>
<h1 text-align: center;>Job Hunter</h1>

<?php 

    define("DB_SERVER", "localhost");
    define("DB_USER", "root");
    define("DB_PWD", "");
    define("DB_NAME", "thebar_database");

    try{
        $mysqli = new mysqli(DB_SERVER, DB_USER, DB_PWD, "thebar_database");
    } catch(Exception $e){

        $mysqli = new mysqli(DB_SERVER, DB_USER, DB_PWD);

        $mysqli -> query("CREATE DATABASE IF NOT EXISTS thebar_database");

        $mysqli = new mysqli(DB_SERVER, DB_USER, DB_PWD, "thebar_database");
        
        
        if($mysqli -> connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
            exit();
        }

        $mysqli = new mysqli(DB_SERVER, DB_USER, DB_PWD, "thebar_database");

        $query = "CREATE TABLE IF NOT EXISTS employer
        (
            CompanyID INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
            Company_Name VARCHAR(50) NULL, 
            Company_Address VARCHAR(50) NULL, 
            Company_PNum VARCHAR(50) NULL, 
            Company_Email VARCHAR(50) NULL 
        )";

        $mysqli -> query($query);

        $query = "CREATE TABLE IF NOT EXISTS user_info
        (
            Email VARCHAR(50) NOT NULL PRIMARY KEY, 
            FName VARCHAR(50) NULL, 
            LName VARCHAR(50) NULL, 
            Pnum INT NULL, 
            User_Password VARCHAR(50) NOT NULL
        )";

        $mysqli -> query($query);

        $query = "CREATE TABLE IF NOT EXISTS job_post
        (
            Job_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
            Job_Type VARCHAR(50) NULL, 
            Title VARCHAR(50) NOT NULL, 
            Date_Posted DATE NULL, 
            Deadline DATE NULL, 
            Qualifications VARCHAR(1000) NULL, 
            Responsibilities VARCHAR(1000) NULL, 
            SalaryRangeID INT NULL,
            CompanyID INT
        )";

        $mysqli -> query($query);
        
        $query = "CREATE TABLE IF NOT EXISTS applications
        (
            Job_ID INT NOT NULL, 
            Email VARCHAR(50),
            PRIMARY KEY(Job_ID, Email)
        )";

        $mysqli -> query($query);

        $query = "ALTER TABLE `applications`
        ADD CONSTRAINT `test2` FOREIGN KEY (`Email`) REFERENCES `user_info` (`Email`),
        ADD CONSTRAINT `test3` FOREIGN KEY (`Job_ID`) REFERENCES `job_post` (`Job_ID`);";

        $mysqli -> query($query);

        $query = "INSERT INTO `employer` (`Company_Name`, `Company_Address`, `Company_PNum`, `Company_Email`) VALUES
        ('Google', 'San Francisco', '3541354', '@google'),
        ('Meta', 'Los Angeles', '123456', '@meta'),
        ('Amazon', 'Seattle', '123456', '@amazon'),
        ('Microsoft', 'New York', '123456', '@micro');";

        $mysqli -> query($query);


        $query = "INSERT INTO `job_post` (`Job_Type`, `Title`, `Date_Posted`, `Deadline`, `Qualifications`, `Responsibilities`, `SalaryRangeID`, `CompanyID`) VALUES
        ('Engineer', 'Software', '2022-05-11', '2022-05-30', 'Bachelors Degree', 'Making Websites', 90000, 1),
        ('Business', 'Analyst', '2022-03-08', '2022-07-21', 'C++ experience', 'Analyze Stock Prices', 70000, 2),
        ('Database', 'Engineer', '2022-05-11', '2022-11-11', 'Knows SQL', 'Managing Database', 110000, 3),
        ('Manager', 'Project Manager', '2022-04-01', '2022-05-30', '5 years experience', 'Manage team', 150000, 4);";

        $mysqli -> query($query);

    }


?>

<h3>Click below for Employee login</h3>
<a href="employee_login.php">Login</a>
<br>
<a href="create_employee.php">Create Account</a>
<h3>Click below for Employer login</h3>
<a href="index_company.php">Employer</a>
<br>
<a href="create_company.php">Register Company</a>

<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>

<footer>By Joel Anil John, Indrajeet Patwardhan, Andrew Doan, and Quinn Curry</footer>