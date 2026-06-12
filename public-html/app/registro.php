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
        header("Location: login.php");
        exit;
    } else {
        $error = "Error al registrar usuario";
    }
}
?>

<!DOCTYPE html>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>

```
<link rel="stylesheet" href="styles.css">
```

</head>
<body>

<div class="form-contenedor">


<h2>Registro de Usuario</h2>

<?php
if (isset($error)) {
    echo "<p class='error'>$error</p>";
}
?>

<form method="POST">

    <input
        type="text"
        name="nombre"
        placeholder="Nombre"
        required>

    <input
        type="email"
        name="correo"
        placeholder="Correo"
        required>

    <input
        type="password"
        name="password"
        placeholder="Contraseña"
        required>

    <button type="submit">
        Registrarse
    </button>

</form>

<br>

<a href="login.php">
    ¿Ya tienes cuenta? Inicia sesión
</a>


</div>

</body>
</html>
