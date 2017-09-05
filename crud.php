<?php
	session_start();
	
	$taskID = "";
	$taskTitle = "";
	$taskDescription = "";

	$edit_state = false;

	include("dbCon.php");

	//if save button is clicked
	if (isset($_POST['save'])){
		$taskTitle = $_POST['taskTitle'];
		$taskDescription = $_POST['taskDescription'];

		$query = "INSERT INTO tasks (title, description) VALUES ('$taskTitle', '$taskDescription')";
		mysqli_query($conn, $query);

		$_SESSION['msg'] = "Entry Saved";
		header('location: crudView.php');
	}

	//update Records
	if (isset($_POST['edit'])) {
		$taskTitle = ($_POST['taskTitle']);
		$taskDescription = ($_POST['taskDescription']);
		
		mysqli_query($conn, "UPDATE tasks SET title='$taskTitle', description='$taskDescription' WHERE taskID='$taskID'");
		
		$_SESSION['msg'] = "Entry Updated";
		header('location: crudView.php');
	}


	//Delete Records
	if( isset($_GET['delete'])) {
		$patientID = $_GET['delete'];
		mysqli_query($conn, "DELETE FROM tasks WHERE taskID = '$taskID'");
		
		$_SESSION['msg'] = "Entry Deleted";
		header('location: CRUDview.php');
	}



	//Retrieve Records
	$results = mysqli_query($conn, "SELECT t.taskID as taskID, t.title as taskTitle, t.description as taskDescription FROM tasks as t");
?>