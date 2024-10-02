<?php
session_start();

if (!isset($_SESSION['list'])) {
    $_SESSION['list'] = array();
    $_SESSION['index']=0;
}

// Initialize variables
// array fields
$name = "";
$quantity = "";
$price = "";
$index = "";
$accion = "";
$message = "";
$error = "";
$totalValue = 0;

// add item to list
if (isset($_POST['add'])) {
    // get form data
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    // verify if values are numeric
    if (is_numeric($quantity) && is_numeric($price)) {

        // if list empty added
        if (empty($_SESSION['list'])) {

            $_SESSION['list'][$_SESSION['index']] = array("name" => $name,"quantity" => $quantity,"price" => $price);

            // array_push($_SESSION['list'], array(
            //      "name" => $name,
            //      "quantity" => $quantity,
            //      "price" => $price
            //  ));

            $_SESSION['index']++;
             echo '<pre>'; var_dump($_SESSION['list']); echo '</pre>';
            $message = "Item added properly.";
            //var_dump($_SESSION);
        } else {
            // check if item is included
            $isIncluded = FALSE;
            foreach ($_SESSION['list'] as $item) {
                if ($item['name'] == $name) {
                    # code...
                    $isIncluded = TRUE;
                    break;
                }
            }
            // if item is not in list, added
            if (!$isIncluded) {
                $_SESSION['list'][$_SESSION['index']] = array("name" => $name,"quantity" => $quantity,"price" => $price);
                $_SESSION['index']++;
                // array_push($_SESSION['list'], array(
                //     "name" => $name,
                //     "quantity" => $quantity,
                //     "price" => $price
                // ));
                $message = "Item added properly.";                
                echo '<pre>'; var_dump($_SESSION['list']); echo '</pre>';

            } else {
                // show error
                $error = "Item already in list, try to edit it.";
            }
        }
    } else {
        $error = "Quantity and price must be numeric.";
    }
}

// edit item existente in list
if (isset($_POST['edit'])) {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $index = $_POST['index'];
    if (is_numeric($quantity) && is_numeric($price)) {
        // $_SESSION['list'][$index] = array(
        //     "name" => $name,
        //     "quantity" => $quantity,
        //     "price" => $price
        // );
        $message = "Item selected properly.";
    } else {
        $error = "Quantity and price must be numeric.";
    }
}
// update item existente in list
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $index = $_POST['index'];
    if (is_numeric($quantity) && is_numeric($price)) {
        $_SESSION['list'][$index] = array(
            "name" => $name,
            "quantity" => $quantity,
            "price" => $price
        );
        $message = "Item updated properly.";
    } else {
        $error = "Quantity and price must be numeric.";
    }
}

// Delete an item from list
if (isset($_POST['delete'])) {
    $index = $_POST['index'];

    //array_splice($_SESSION['list'], $index, 1);
    unset($_SESSION['list'][$index]);
    
    $message = "Item deleted properly.";
}

// Calculate total cost list
if (isset($_POST['total'])) {
    foreach ($_SESSION['list'] as $item) {
        $totalValue += $item['quantity'] * $item['price'];
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Shopping list</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
        }

        input[type=submit] {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <h1>Shopping list</h1>
    <form method="post">
        <label for="name">name:</label>
        <input type="text" name="name" id="name" value="<?php echo $name; ?>">
        <br>
        <label for="quantity">quantity:</label>
        <input type="number" name="quantity" id="quantity" value="<?php echo $quantity; ?>">
        <br>
        <label for="price">price:</label>
        <input type="number" name="price" id="price" value="<?php echo $price; ?>">
        <br>
        <input type="hidden" name="index" value="<?php echo $index; ?>">
        <input type="submit" name="add" value="Add">
        <input type="submit" name="update" value="Update">
        <input type="submit" name="reset" value="Reset">
    </form>
    <p style="color:red;"><?php echo $error; ?></p>
    <p style="color:green;"><?php echo $message; ?></p>
    <table>
        <thead>
            <tr>
                <th>name</th>
                <th>quantity</th>
                <th>price</th>
                <th>cost</th>
                <th>actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['list'] as $index => $item) { ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo $item['price']; ?></td>
                    <td><?php echo $item['quantity'] * $item['price']; ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="name" value="<?php echo $item['name']; ?>">
                            <input type="hidden" name="quantity" value="<?php echo $item['quantity']; ?>">
                            <input type="hidden" name="price" value="<?php echo $item['price']; ?>">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <input type="submit" name="edit" value="Edit">
                            <input type="submit" name="delete" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="3" align="right"><strong>Total:</strong></td>
                <td><?php echo $totalValue; ?></td>
                <td>
                    <form method="post">
                        <input type="submit" name="total" value="Calculate total">
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</body>