<?php
	session_start();
	
	$taskTitle = "";
	$taskDescription = "";

	$edit_state = false;

	include("dbCon.php");

	//if save button is clicked
	if (isset($_POST['save'])){
		$taskTitle = $_POST['taskTitle'];
		$taskDescription = $_POST['taskDescription'];

		$query = "INSERT INTO patient (name, address, dateOfBirth, phoneNumber, sex, patientID) VALUES ('$patientName', '$patientAddress', '$patientDateOfBirth', '$patientNumber', '$patientSex', '$patientID')";
		mysqli_query($conn, $query);

		$_SESSION['msg'] = "Entry Saved";
		header('location: CRUDview.php');
	}

	//update Records
	if (isset($_POST['edit'])) {
		$taskTitle = ($_POST['taskTitle']);
		$taskDescription = ($_POST['taskDescription']);
		
		mysqli_query($conn, "UPDATE patient SET name='$patientName', patientID='$patientID', address ='$patientAddress', dateOfBirth='$patientDateOfBirth', phoneNumber='$patientNumber', sex='$patientSex' WHERE patientID='$patientID'");
		
		$_SESSION['msg'] = "Entry Updated";
		header('location: CRUDview.php');
	}


	//Delete Records
	if( isset($_GET['delete'])) {
		$patientID = $_GET['delete'];
		mysqli_query($conn, "DELETE FROM patient WHERE patientID = '$patientID'");
		
		$_SESSION['msg'] = "Entry Deleted";
		header('location: CRUDview.php');
	}



	//Retrieve Records
	$results = mysqli_query($conn, "SELECT p.address as patientAddress, p.dateOfBirth as patientDateOfBirth, p.name as patientName, p.phoneNumber as patientNumber, p.patientID as patientID, p.sex as patientSex FROM patient as p");
?>