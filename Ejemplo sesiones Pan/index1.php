<!DOCTYPE html>
<HTML lang="es">
    <HEAD>
        <TITLE>Prueba Form</TITLE>
        <META CHARSET='utf-8'>
    </HEAD>
    <BODY>
        <FORM ACTION="./session_test2.php" method="POST">
            <LABEL>Nombre usuario: </LABEL><INPUT TYPE="text" NAME="user" REQUIRED>
            <LABEL>Contraseña</LABEL><INPUT TYPE="password" NAME="pwd" REQUIRED>            
            <LABEL>Cantidad pan: </LABEL><INPUT TYPE="number" MIN="0" MAX="20" NAME="cantidadPan" VALUE="0">
            <INPUT TYPE="submit">
        </FORM>
    </BODY>
</HTML>