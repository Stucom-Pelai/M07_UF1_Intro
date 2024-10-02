<?php
	session_start();

	// Define initial array first time
	if (!isset($_SESSION['numbers'])) {
		$_SESSION['numbers'] = array(10, 20, 30);
	}

	// if form POST has been submitted
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// modify functionality
		if (isset($_POST["modify"])) {
			// get form data
			$position = $_POST['position'];
			$value = $_POST['value'];
			
			// Modify selected position
			$_SESSION['numbers'][$position] = $value;

		// average functionality
		} elseif((isset($_POST["average"]))) {
			// Calculate the average value
			$average = array_sum($_SESSION['numbers']) / count($_SESSION['numbers']);
			$average = number_format($average,2);
		}
	}

?>

<!DOCTYPE html>
<html>
	<head>
	<title>Modify array saved in session</title>
</head>
<body>
	<h1>Modify array saved in session</h1>
	<form action="ejercicio02.php" method="POST">
		<label for="position">Position to modify:</label>
		<select id="position" name="position">
			<?php for ($i = 0; $i < count($_SESSION['numbers']); $i++) { ?>
				<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php } ?>
			</select><br><br>
		<label for="value">New value:</label>
		<input type="number" id="value" name="value" value=""><br><br>
		<input type="submit" value="Modify" name="modify">
		<input type="submit" value="Average" name="average">
		<input type="reset" value="Reset">
	</form>
	<p>Current array: <?php echo implode(", ", $_SESSION['numbers']); ?></p>
	<?php if (isset($average)) {
		echo "<p>Average:  $average </p>";
	} ?>
</body>
</html>
