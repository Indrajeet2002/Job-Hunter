<?php



if(!isset($_GET['CompanyID'])) {
    header("location:index_company.php");
}
$CompanyID = $_GET['CompanyID'];
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

//if user post update
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //get data from form post
    $Company_Name = $_POST['Company_Name'] ?? '';
    $Company_Address = $_POST['Company_Address'] ?? '';
    $Company_PNum = $_POST['Company_PNum'] ?? '';
    $Company_Email = $_POST['Company_Email'] ?? '';
    //validate form
    $isvalid = true;
    
    //update database
    if($isvalid){
        
        $uquery = "update employer set Company_Name='". $Company_Name ."', Company_Address='" . $Company_Address ."', Company_PNum='".$Company_PNum."', Company_Email='".$Company_Email."' where CompanyID='". $CompanyID ."'" ;
        $isupdated = $mysqli -> query($uquery);
        //check update
        if($isupdated) {
             header("location:index_company.php");
          } else {
            // UPDATE failed
            echo $mysqli->error();
          }
        //if success redirect to index
    } 
}

$sql = "SELECT * FROM employer WHERE CompanyID='". $CompanyID ."'";

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
       Company ID: <?php echo $emp['CompanyID']; ?>
        
</div>

<form action='' method='post'>

<div>
        Name: <input type='text' name='Company_Name' value="<?php echo $emp['Company_Name']; ?>">
</div>
<div>
        Address: <input type='text' name='Company_Address' value="<?php echo $emp['Company_Address']; ?>">
</div>
<div>
        Phone Number: <input type='text' name='Company_PNum' value="<?php echo $emp['Company_PNum']; ?>">
</div>
<div>
        Email: <input type='text' name='Company_Email' value="<?php echo $emp['Company_Email']; ?>">
</div>
<input type='submit' value='submit'>
</form>
<?php
echo ("<a href='add_job_post.php?CompanyID=" .$emp['CompanyID']. "'>Add job listing!</a>");
?>

<?php 

    $sql_listings = "SELECT * FROM job_post WHERE job_post.CompanyID=$CompanyID";

    //execute query
    $listings = $mysqli->query($sql_listings);
    //validate query
    if (!$listings) {
        exit("Database query failed.");
    }

?>

<table class="list">
  	<tr>
        <th>Job Id</th>
        <th>Job Type</th>
        <th>Title</th>
        <th>Date Posted</th>
        <th>Deadline</th>
        <th>Qualifications</th>
        <th>Responsibilities</th>
        <th>Salary</th>
  	</tr>
    <?php while($emp = $listings->fetch_assoc()) { ?>
        <tr>
          <td><?php echo $emp['Job_ID']; ?></td>
          <td><?php echo $emp['Job_Type']; ?></td>
          <td><?php echo $emp['Title']; ?></td>
          <td><?php echo $emp['Date_Posted']; ?></td>
          <td><?php echo $emp['Deadline']; ?></td>
          <td><?php echo $emp['Qualifications']; ?></td>
          <td><?php echo $emp['Responsibilities']; ?></td>
          <td><?php echo $emp['SalaryRangeID']; ?></td>
    	</tr>
    <?php } ?>
</table>


<a href="index_company.php">Home</a>

<?php
//free memeory
$result->free_result();
$listings->free_result();
//close connection
if(is_resource($mysqli)){
    $mysqli->close();
}
?>