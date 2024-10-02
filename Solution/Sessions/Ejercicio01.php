<?php
session_start();

// Define session products if they do not exist
if (!isset($_SESSION['softDrink'])) {
    $_SESSION['softDrink'] = 0;
}
if (!isset($_SESSION['milk'])) {
    $_SESSION['milk'] = 0;
}
// if form POST has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // get form data
    $worker = $_POST['worker'];
    $product = $_POST['product'];
    $quantity = $_POST['quantity'];
    // save in session worker
    $_SESSION["worker"] = $worker;

    // save products
    if (isset($_POST["add"])) {
        // update session variables
        switch ($product) {
            case 'milk':
                $_SESSION['milk'] += $quantity;
                break;

            case 'softDrink':
                $_SESSION['softDrink'] += $quantity;
                break;

            default:
                echo "<br> <font color='red'><p>Error: Product not found.</p></font>";
                break;
        }

    //remove products
    } elseif (isset($_POST["remove"])) {
        switch ($product) {
            case 'milk':
                if ($_SESSION['milk'] - $quantity < 0) {
                    echo "<br> <font color='red'><p>Error: It is not possible remove more quantity than we have in store.</p></font>";
                } else {
                    $_SESSION['milk'] -= $quantity;
                }
                break;

            case 'softDrink':
                if ($_SESSION['softDrink'] - $quantity < 0) {
                    echo "<br> <font color='red'><p>Error: It is not possible remove more quantity than we have in store.</p></font>";
                } else {
                    $_SESSION['softDrink'] -= $quantity;
                }
                break;

            default:
                echo "<br> <font color='red'><p>Error: Product not found.</p></font>";
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Supermarket management</title>
</head>

<body>
    <h1>Supermarket management</h1>
    <form action="ejercicio01.php" method="POST">
        <label for="worker">Worker name:</label>
        <input type="text" id="worker" name="worker" value="<?php echo isset($_POST['worker']) ? $_POST['worker'] : ''; ?>"><br><br>
        <h2>Choose product:</h2>
        <select name="product" id="product">
            <option value="milk">Milk</option>
            <option value="softDrink">Soft Drink</option>
        </select>
        <h2>Product quantity:</h2>
        <input type="number" id="quantity" name="quantity" min="1"><br><br>
        <input type="submit" value="add" name="add">
        <input type="submit" value="remove" name="remove">
        <input type="reset" value="reset">
    </form>
    <h2>Inventary:</h2>
    <p>worker: <?php echo isset($_SESSION['worker']) ? $_SESSION['worker'] : ''; ?></p>
    <p>units milk: <?php echo isset($_SESSION['milk']) ? $_SESSION['milk'] : ''; ?></p>
    <p>units soft drink: <?php echo isset($_SESSION['softDrink']) ? $_SESSION['softDrink'] : ''; ?></p>
</body>

</html>