<html>
<head><link rel="stylesheet" href="style.css" type="text/css"></head>
<div class ="box">
	<a href ="index.html">Home</a>
</div>
<?php include('crud.php');

if(isset($_GET['edit'])) {
	$taskID = $_GET['edit'];
	$edit_state = true;
	$rec = mysqli_query($conn, "SELECT t.taskID as taskID, t.title as taskTitle, t.description as taskDescription FROM tasks as t WHERE taskID = '$taskID'");
	$record = mysqli_fetch_array($rec);

	$taskID = $record['taskID'];
	$taskTitle = $record['taskTitle'];
	$taskDescription = $record['taskDescription'];
}

?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css" type="text/css"></head>
<body>
	<?php if(isset($_SESSION['msg'])): ?>
		<?php
		echo $_SESSION['msg'];
		unset($_SESSION['msg']);
		?>
	<?php endif ?>
	<table>
		<thead>
			<tr>
				<th>Task Title</th>
				<th>Description</th>
				<th colspan="2">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php while($row = mysqli_fetch_array($results)) {?>
			<tr>
				<td><?php echo $row['taskTitle'] ?></td>
				<td><?php echo $row['taskDescription'] ?></td>
				<td>
					<a href="crudView.php?edit=<?php echo $row['taskID']; ?>">Edit</a>
				</td>
				<td> 
					<a href="crudView.php?delete=<?php echo $row['taskID']; ?>">Delete</a>
				</td>	
			</tr>

			<?php } ?>
		</table>
		<form method="post" action="crud.php">
			<input type="hidden" name="taskId" value ="<?php echo $taskID ?>">
			<br>
			<div class ="box">
				<label>Task Title</label>
			</div>
			<input type="text" name="taskTitle" placeholder=" Title" value ="<?php echo $taskTitle?>">	
			<div class ="box">
				<label>Description</label>
			</div>
			<input type="text" name="taskDescription" placeholder=" A short description of what neesd to be done." value ="<?php echo $taskDescription ?>">

			<?php if($edit_state == false): ?>
				<button type="submit" name="save">Save</button>
			<?php else: ?>
				<button type="submit" name="edit">Edit</button>
			<?php endif ?>

		</form>
	</body>
	</html>