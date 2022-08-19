<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $Email = $_POST['Email'] ?? '';
    $FName = $_POST['FName'] ?? '';
    $LName = $_POST['LName'] ?? '';
    $Pnum = $_POST['Pnum'] ?? '';
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
        
        $query = "insert into User_Info(Email, FName, LName, Pnum, User_Password) values('" . $Email ."','" . $FName ."','" . $LName . "','". $Pnum . "','" . $User_Password . "')" ;
        echo $query;
        $isInserted = $mysqli -> query($query);
        
        if($isInserted) {
            header("location:index_employee.php?Email=$Email");
          } else {
            echo $mysqli->error();
          }
        
          
        $isInserted->free_result();
        
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
        First Name: <input type='text' name='FName'>
</div>
<div>
        Last Name: <input type='text' name='LName'>
</div>
<div>
        Phone Number: <input type='text' name='Pnum'>
</div>
<div>
        Password: <input type='text' name='User_Password'>
</div>
<input type='submit' value='submit'>
</form>

<?php

?>