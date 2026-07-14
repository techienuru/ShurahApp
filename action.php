<?php
// Include the database connection file
include('includes/db_connect.php');

if (isset($_POST['stateId']) && !empty($_POST['stateId'])) {

	// Fetch state name base on country id
	$query = "SELECT * FROM local_govt WHERE state_id = ".$_POST['stateId'];
	$result = $db_connect->query($query);

	if ($result->num_rows > 0) {
		echo '<option value="">Select Local Govt.</option>'; 
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row['id'].'">'.$row['city_name'].'</option>'; 
		}
	} else {
		echo '<option value="">Local Govt. not available</option>'; 
	}
}
?>