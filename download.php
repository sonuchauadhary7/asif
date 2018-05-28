<?php 

$id = $_GET["id"];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "company_data";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$query="select c.name as company, d.name as designation, s.salary from company_details c join salary s on c.id = s.company_id join designations d on s.designation_id = d.id where s.id=" . $id;
$result = $conn->query($query);

$filename = time();
header('Content-Type: text/csv');
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");


$flag = false;
while ($row = mysqli_fetch_assoc($result)) {
    if (!$flag) {
        // display field/column names as first row
        echo implode(",", array_keys($row)) . "\r\n";
        $flag = true;
    }
    echo implode(",", array_values($row)) . "\r\n";
}