<?php
	session_start();
	$descriptionID = "";
	$dueDateID = "";	
	$taskID = "";
	$taskTitle = "";
	$taskDetails = "";
	$dueDate = "";

	include("dbCon.php");

	//if save button is clicked
	if (isset($_POST['save'])){

		$taskDetails = $_POST['taskDetails'];
		$dueDate = $_POST['dueDate'];
		$taskTitle = $_POST['taskTitle'];

		$query1 = "INSERT INTO description (details) VALUES ('$taskDetails')";
		mysqli_query($conn,$query1);
		$descriptionQuery = mysqli_query($conn, "SELECT MAX(descriptionID) FROM description");
		$resultDescription = mysqli_fetch_row($descriptionQuery);
		$desForeignKey = $resultDescription[0];

		$query2 = "INSERT INTO duedate (setDate) VALUES ('$dueDate')";
		mysqli_query($conn,$query2);
		$dateQuery = mysqli_query($conn, "SELECT MAX(dueDateID) FROM duedate");
		$resultDate = mysqli_fetch_row($dateQuery);
		$dateForeignKey = $resultDate[0];

		$query = "INSERT INTO tasks (title, description_fk, duedate_fk) VALUES ('$taskTitle', '$desForeignKey', '$dateForeignKey')";
		mysqli_query($conn,$query);

		$_SESSION['msg'] = "Entry Saved";
		header('location: crudView.php');
	}

	//Delete Records
	if( isset($_GET['delete'])) {
		$taskID = $_GET['delete'];
		mysqli_query($conn, "DELETE FROM tasks WHERE taskID = '$taskID'");
		
		$_SESSION['msg'] = "Entry Deleted";
		header('location: crudView.php');
	}


	//Retrieve Records
	$results = mysqli_query($conn, "
		SELECT 
			t.taskID as taskID,
			t.title as taskTitle, 
			d.descriptionID as descriptionID,
			d.details as taskDetails,
			du.dueDateID as dueDateID,
			du.setDate as dueDate
		FROM tasks as t
		INNER JOIN description as d ON d.descriptionID=t.description_fk
		INNER JOIN duedate as du on du.dueDateID=t.duedate_fk");
?>