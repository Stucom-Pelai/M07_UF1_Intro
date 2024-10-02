<?php
// start session
session_start();

// save data from form
$name = $_POST["user"];
$pwd = $_POST["pwd"];
$cantidad_pan = $_POST["cantidadPan"];

// save in session
if (!array_key_exists('usuario', $_SESSION)) {
    $_SESSION["usuario"] = [
        "user" => $name,
        "pwd" => $pwd,
        "carritoProductos" => ["cantidad" => $cantidad_pan]
    ];
} else {
    $_SESSION["usuario"]["carritoProductos"]['cantidad'] += $cantidad_pan;
}


//unset($_SESSION["usuario"]);
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
echo "<br>";
echo "<pre>";
var_dump($_SESSION);
echo "</pre>";
