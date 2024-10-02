<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<h1>Delete session</h1>
<?php
// remove all session variables
session_unset();

//regenerate session
session_regenerate_id(TRUE);

// destroy the session
session_destroy();

echo "Session variables are set in id: " . session_id();
?>
<br>
<a href="ShowSession.php">Show session</a>

</body>
</html>