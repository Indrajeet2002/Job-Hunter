<link rel="stylesheet" type="text/css" href="/styles.css">



<?php

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


$sql = "SELECT * FROM user_info WHERE user_info.Email='".$Email. "'";

$result = $mysqli->query($sql);

if (!$result) {
    exit("Database query failed.");
}


?>


<h2>Welcome!</h2>


<h3></h3>
<table class="list">
  	<tr>
        <th>Email</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Pnum</th>
        <th>User_Password</th>
  	</tr>
    <?php while($emp = $result->fetch_assoc()) { ?>
        <tr>
          <td><?php echo $emp['Email']; ?></td>
          <td><?php echo $emp['FName']; ?></td>
          <td><?php echo $emp['LName']; ?></td>
          <td><?php echo $emp['Pnum']; ?></td>
          <td><?php echo $emp['User_Password']; ?></td>
          <td><?php echo ("<a href='edit_employee.php?Email=" .$emp['Email']. "'>Edit Profile</a>") ?></td>
    	</tr>
    <?php } ?>
</table>

<?php

$result->free_result();

if(is_resource($mysqli)){
    $mysqli->close();

}
?>

<?php


$descriptions = "SELECT Job_Type, Title, CompanyID FROM job_post INNER JOIN applications ON job_post.job_ID=applications.job_ID AND applications.Email='".$Email."'";
$result_applied = $mysqli->query($descriptions);
if (!$result_applied) {
    exit("Database query failed.");
}


?>

<h3>Your current applications:</h3>
<table class="list">
  	<tr>
        <th>Job Type</th> 
        <th>Title</th>
        <th>Company</th>
  	</tr>
    <?php while($apps = $result_applied->fetch_assoc()) { ?>
        <tr>
          <td><?php echo $apps['Job_Type']; ?></td>
          <td><?php echo $apps['Title']; ?></td>
          <td>
          <?php 
          $comp_name = "SELECT Company_Name FROM employer WHERE employer.CompanyID='" .$apps['CompanyID']. "'";
          $company_name = $mysqli->query($comp_name);
          while($name = $company_name->fetch_assoc()){
            echo($name['Company_Name']);
          }
          ?>
          </td>
    	</tr>
    <?php } ?>
</table>





<?php

$result_applied->free_result();


if(is_resource($mysqli)){
    $mysqli->close();
}
?>

<br>
<?php
    echo ("<a href='apply_job.php?Email=" .$Email. "'>Apply for a job!</a>");
?>

<br>
<a href="index.php">Log Out</a>
