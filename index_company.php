<link rel="stylesheet" type="text/css" href="/styles.css">

<h2>Adding Employees to Database</h2>

<a href="create_company.php">Register Company</a>
<br>
<?php

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

$sql = "SELECT * FROM employer";


//execute query
$result = $mysqli->query($sql);
//validate query
if (!$result) {
    exit("Database query failed.");
}

//display query
?>

<h3>Current list of employers:</h3>
<table class="list">
  	<tr>
        <th>Company ID</th>
        <th>Name</th>
        <th>Address</th>
        <th>Number</th>
        <th>Email</th>
  	</tr>
    <?php while($emp = $result->fetch_assoc()) { ?>
        <tr>
          <td><?php echo $emp['CompanyID']; ?></td>
          <td><?php echo $emp['Company_Name']; ?></td>
          <td><?php echo $emp['Company_Address']; ?></td>
          <td><?php echo $emp['Company_PNum']; ?></td>
          <td><?php echo $emp['Company_Email']; ?></td>
          <td><?php echo ("<a href='edit_company.php?CompanyID=" .$emp['CompanyID']. "'>Edit</a>") ?></td>
    	</tr>
    <?php } ?>
</table>

<?php
//free memeory
$result->free_result();
//close connection
if(is_resource($mysqli)){
    $mysqli->close();
}
?>

<a href="index.php">Home</a>