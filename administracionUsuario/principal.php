<?php
    if(isset($_POST["envio"])){
        //Aquí ya sé que se ha enviado la información
        //Ahora la recibo y la almaceno en variables
        $username = $_POST["username"];
        $pwd = $_POST["pwd"];
        $mail = $_POST["mail"];
        $tlf = $_POST["tlf"];
        $rol = $_POST["rol"];

        session_start();
        $conexion_bbdd = new mysqli("localhost","root","", "pruebas");
        $insert_query = "INSERT INTO usuarios(username, password, rol) VALUES ('$username','$pwd','$rol')";
        $resultado = $conexion_bbdd->query($insert_query);
        if($resultado){
            //Sin select, a través de la información captada en el formulario 
            //Directamente
            $_SESSION[$username] = array("Contraseña" => $pwd, "Rol" => $rol, "Tlf" => $tlf, "mail" => $mail );
            foreach($_SESSION[$username] as $campo_usuario => $valor){
                echo("<FONT COLOR='GREEN'> $campo_usuario : $valor </FONT><BR>");
            }
            //Con SELECT
            $resultado = $conexion_bbdd->query("SELECT * FROM usuarios WHERE username='$username'");
            $usuario_registrado = $resultado->fetch_assoc();
            
            $username_sql = $usuario_registrado['username'];
            $_SESSION[$username_sql] = array(
                "Contraseña" => $usuario_registrado["password"], 
                "Rol" => $usuario_registrado["rol"], 
                "Tlf" => $tlf, 
                "mail" => $mail  
            );
            foreach($_SESSION[$username_sql] as $campo_usuario => $valor){
                echo("<FONT COLOR='GREEN'> $campo_usuario : $valor </FONT><BR>");
            }
        }else{
            echo("No se ha podido registrar el usuario en la bbdd");
        }
    }
