<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $Email = $_POST['Email'] ?? '';
    $User_Password = $_POST['User_Password'] ?? '';
    
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
        
        $query = "SELECT * FROM user_info WHERE Email='" .$Email. "' AND User_Password='" .$User_Password."'";
        $result = $mysqli->query($query);

        if(!$result->fetch_assoc()){
            echo "<h1>Incorrect login information. Try again!</h1>";
        } else{
            header("location:index_employee.php?Email=$Email");
        }
        
        
        if(is_resource($mysqli)){
            $mysqli->close();
        }
    } 
}
?>


<form action='' method='post'>
<div>
        Email: <input type='text' name='Email'>
</div>
<div>
        Password: <input type='text' name='User_Password'>
</div>
<input type='submit' value='submit'>
</form>

<a href="create_employee.php">Create Account</a>