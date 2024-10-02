<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario para sesiones de usuarios</title>
</head>
<body>
   <FORM METHOD="POST" ACTION="./principal.php">
       <INPUT TYPE="text" NAME="username" PLACEHOLDER="Nombre de usuario..." REQUIRED>
       <BR><INPUT TYPE="password" NAME="pwd" PLACEHOLDER="Contraseña" REQUIRED>
       <BR><INPUT TYPE="mail" NAME="mail" PLACEHOLDER="mail" REQUIRED>
       <BR><INPUT TYPE="text" NAME="tlf" PLACEHOLDER="tlf..." REQUIRED>
       <BR><INPUT TYPE="text" NAME="rol" PLACEHOLDER="rol..." REQUIRED>
       <INPUT TYPE="submit" NAME="envio" >
   </FORM> 
</body>
</html>