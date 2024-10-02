<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<h1>Show session</h1>
<?php
// Echo session variables that were set on previous page
echo "User is " . $_SESSION["user"] . ".<br>";
echo "Password is " . $_SESSION["password"] . ".";
?>

</body>
</html>