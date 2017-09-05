<?php include('crud.php');
	if(isset($_GET['edit'])) {
		$taskID = $_GET['edit'];
		$edit_state = true;
		$rec = mysqli_query($conn, "SELECT t.taskID as taskID, t.title as taskTitle, t.description as taskDescription FROM tasks as t");
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
				<th>Title</th>
				<th>Description</th>
			</tr>
		</thead>
		<tbody>
			<?php while($row = mysqli_fetch_array($results)) { ?>
				<tr>
					<td><?php echo $row['taskTitle'] ?></td>
					<td><?php echo $row['taskDescription'] ?></td>
					<td>
						<a href="crud.php?edit=<?php echo $row['taskID']; ?>">Edit</a>
					</td>
					<td>
						<a href="crud.php?delete=<?php echo $row['taskID'] ?>">Delete</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>

	<form method="post" action="crud.php">
	<input type="hidden" name="taskID" value="<?php echo $taskID ?>">

	<br><label>Title</label>
		<input type="text" name="taskTitle" value="<?php echo $taskTitle ?>">
	<label>Description</label>
		<input type="text" name="taskDescription" value="<?php echo $taskDescription ?>">

		<?php if($edit_state == false): ?>
			<button type="submit" name="save">Save</button>
		<?php else: ?>
			<button type="submit" name="edit">Edit</button>
		<?php endif ?>
	</form>

</body>
</html>			