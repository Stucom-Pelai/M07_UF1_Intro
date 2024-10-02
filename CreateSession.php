<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<h1>Create session</h1>
<?php
// Set session variables
$_SESSION["user"] = "admin";
$_SESSION["password"] = "1234";
echo "Session variables are set in id: " . session_id();
?>
<br>
<a href="ShowSession.php">Show session</a>
<br>
<a href="DeleteSession.php">Delete session</a>
</body>
</html>