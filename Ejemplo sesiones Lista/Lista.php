<HTML>
    <HEAD>
        <META CHARSET="UTF-8" />
        <TITLE>Añadir-Quitar Productos</TITLE>
    </HEAD>
    <BODY>
        <FORM  METHOD="POST">
            <DIV>
                <LABEL>Trabajador</LABEL>
                <INPUT TYPE="text" NAME="nom_trab">
            </DIV>
            <DIV>
                <LABEL>Nombre del producto</LABEL>
                <INPUT TYPE="text" NAME = "nom_prod" >
            </DIV>
            <DIV>
                <LABEL>Seleccione la cantidad que desea eliminar o añadir</LABEL>
                <INPUT TYPE="number" MIN="1" NAME="cant_prod" REQUIRED VALUE="1"> 
            </DIV>
   
            <INPUT TYPE="submit" VALUE="Eliminar" NAME="del_prod">
            <INPUT TYPE="submit" VALUE="Añadir" NAME="add_prod">
            <INPUT TYPE="submit" VALUE="Cerrar sesión" NAME="close_sess">

        </FORM>
    </BODY>
</HTML>
<?php
session_start();
//Primero hacemos la parte que se corresponde con la adición de un producto
if (isset($_POST['nom_prod']) && isset($_POST['nom_trab']) && !isset($_POST['close_sess'])) {
    $nom_prod = $_POST['nom_prod'];
    $nom_trab = $_POST['nom_trab'];
    //Mantenemos el nombre del trabajador que está usando la aplicación
    $_SESSION["Trabajador"] = $nom_trab;
    if (isset($_POST['add_prod'])) {
        if (!isset($_SESSION["Producto"][$_POST["nom_prod"]])) {
            //Entonces en este caso no se ha añadido ningún producto hasta ahora
            $_SESSION["Producto"][$_POST["nom_prod"]] = ["cant_prod" => $_POST["cant_prod"]];
        } else {
            //Ya tenemos al menos una sesión inicializada para la cual se ha recibido un producto
            //Por lo cual puedo añadir o quitar productos
            $_SESSION['Producto'][$_POST["nom_prod"]]["cant_prod"] += $_POST["cant_prod"];
        }
        echo ("<H2>NOMBRE DEL TRABAJADOR: " . $_SESSION["Trabajador"] . "</H2>");
        foreach ($_SESSION["Producto"] as $nom_prod => $detalle_prod) {
            echo ("-------------------------------------<br>");
            echo ("<p>Nombre del producto: $nom_prod </p>");
            echo ("<p>Cantidad del producto:" . $detalle_prod['cant_prod'] . "</p>");
            echo ("-------------------------------------<br>");
        }
        echo('<pre>');
        print_r($_SESSION);
        echo('</pre>');

    } else if (isset($_POST['del_prod']) && isset($_SESSION["Producto"][$_POST["nom_prod"]])&& !isset($_POST['close_sess'])) {
        //1. En este caso como queremos eliminar un producto tenemos que comprobar si ya existe como variable de sesión.
        //2.Tras esto restamos a la cantidad almacenada ya en la variable de sesión, la cantidad que se ha indicado a través del formulario
        echo ("Se van a eliminar un producto ");
        //3. Para que nos sea más sencillo de manejar almacenaremos la actual cantidad del producto en una variable aparte
        $cant_prod = $_SESSION['Producto'][$_POST["nom_prod"]]["cant_prod"];
        $cant_prod_eliminar = $_POST["cant_prod"];
        if ($cant_prod -  $cant_prod_eliminar >= 0) {
            $_SESSION['Producto'][$_POST["nom_prod"]]["cant_prod"] -= $_POST["cant_prod"];
            foreach ($_SESSION["Producto"] as $nom_prod => $detalle_prod) {
                echo ("-------------------------------------<br>");
                echo ("<p>Nombre del producto: $nom_prod </p>");
                echo ("<p>Cantidad del producto:" . $detalle_prod['cant_prod'] . "</p>");
                echo ("-------------------------------------<br>");
            }
        } else {
            echo ("<BR>Error!!! Has eliminado MÁS productos con nombre ". $_POST["nom_prod"] . " de los que hay disponibles.");
        }
    }else if(isset($_POST['del_prod']) && !isset($_SESSION["Producto"][$_POST["nom_prod"]]) && !isset($_POST['close_sess'])){
        echo("Error: No hay ningún producto con este nombre en la sesión!");
    }
    if(isset($_POST['close_sess'])){
        session_destroy();
    }
}