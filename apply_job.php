<?php 
    $Email = $_GET['Email'];
    
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

    $sql_listings = "SELECT * FROM job_post";

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
          <td><?php echo ("<a href='success.php?Job_ID=" .$emp['Job_ID']. "&Email=" .$Email. "'>Apply</a>") ?></td>
    	</tr>
    <?php } ?>
</table>

<?php
//free memeory
$listings->free_result();
//close connection
if(is_resource($mysqli)){
    $mysqli->close();
}
?>