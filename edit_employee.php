<?php


if(!isset($_GET['Email'])) {
    header("location:index_employee.php");
}
$Email = $_GET['Email'];

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PWD", "");
define("DB_NAME", "thebar_database");

$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PWD, DB_NAME);
if($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $FName = $_POST['FName'] ?? '';
    $LName = $_POST['LName'] ?? '';
    $Pnum = $_POST['Pnum'] ?? '';
    $User_Password = $_POST['User_Password'] ?? '';
    
    $isvalid = true;
    if(!isset($FName) || trim($FName) === ''){
        echo "FName cannot be empty";        
        $isvalid = false;
    }
    if(!isset($LName) || trim($LName) === ''){
        echo "LName cannot be empty";
        $isvalid = false;
    }
    
    if($isvalid){
        
        $uquery = "update user_info set FName='". $FName ."', LName='" . $LName ."', Pnum='".$Pnum."', User_Password='".$User_Password."' where Email='". $Email ."'" ;
        $isupdated = $mysqli -> query($uquery);
        
        if($isupdated) {
            header("location:index_employee.php?Email=$Email");
          } else {
              
            echo $mysqli->error();
          }
          
    } 
}

$sql = "SELECT * FROM user_info WHERE Email='". $Email ."'";

//execute query
$result = $mysqli->query($sql);
//validate query
if (!$result) {
    exit("Database query failed.");
}
//display query
$emp = $result->fetch_assoc();
?>

<div>
       Email: <?php echo $emp['Email']; ?>
        
</div>

<form action='' method='post'>

<div>
        First Name: <input type='text' name='FName' value="<?php echo $emp['FName']; ?>">
</div>
<div>
        Last Name: <input type='text' name='LName' value="<?php echo $emp['LName']; ?>">
</div>
<div>
        Phone Number: <input type='text' name='Pnum' value="<?php echo $emp['Pnum']; ?>">
</div>
<div>
        Password: <input type='text' name='User_Password' value="<?php echo $emp['User_Password']; ?>">
</div>
<input type='submit' value='submit'>
</form>

