<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css" type="text/css"></head>
<div class ="box">
	<a href ="index.html">Home</a>
</div>

<?php 
	include('crud.php');
?>

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
				<th>Task Title |</th>
				<th>Description |</th>
				<th>Due Date |</th>
				<th colspan="2">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php while($row = mysqli_fetch_array($results)) {?>
			<tr>
				<td><?php echo $row['taskTitle'] ?></td>
				<td><?php echo $row['taskDetails'] ?></td>
				<td><?php echo $row['dueDate'] ?></td>
				<td> 
					<a href="crudView.php?delete=<?php echo $row['taskID']; ?>">Delete</a>
				</td>	
			</tr>

			<?php } ?>
		</table>
		<form method="post" action="crud.php">
			<input type="hidden" name="taskID" value ="<?php echo $taskID ?>">
			<br>
			<div class ="box">
				<label>Task Title</label>
			</div>
			<input type="text" name="taskTitle" placeholder=" Title" value ="<?php echo $taskTitle?>">	
			<div class ="box">
				<label>Description</label>
			</div>
			<input type="text" name="taskDetails" placeholder=" A short description of what neesd to be done." value ="<?php echo $taskDetails ?>">
			<div class ="box">
				<label>Due Date</label>
			</div>
			<input type="text" name="dueDate" placeholder="MM/DD/YYYY" value ="<?php echo $dueDate ?>">

			<button type="submit" name="save">Save</button>

		</form>
	</body>
	</html>