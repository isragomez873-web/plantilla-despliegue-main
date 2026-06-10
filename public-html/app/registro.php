<?php

require_once("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, correo, password)
            VALUES (?, ?, ?)";

    $stmt = $conexion->prepare($sql);

    if ($stmt->execute([$nombre, $correo, $password])) {
        echo "Usuario registrado correctamente";
    } else {
        echo "Error al registrar usuario";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>

<h2>Registro de Usuario</h2>

<form method="POST">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <br><br>

    <input type="email" name="correo" placeholder="Correo" required>
    <br><br>

    <input type="password" name="password" placeholder="Contraseña" required>
    <br><br>

    <button type="submit">Registrarse</button>
</form>

</body>
</html>