<?php

session_start();
require_once("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $correo = $_POST["correo"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$correo]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($password, $usuario["password"])) {

        $_SESSION["usuario_id"] = $usuario["id"];
        $_SESSION["nombre"] = $usuario["nombre"];

        header("Location: index.php");
        exit;

    } else {
        $error = "Correo o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

<h2>Iniciar Sesión</h2>

<?php
if (isset($error)) {
    echo "<p>$error</p>";
}
?>

<form method="POST">

    <input type="email"
           name="correo"
           placeholder="Correo"
           required>

    <br><br>

    <input type="password"
           name="password"
           placeholder="Contraseña"
           required>

    <br><br>

    <button type="submit">
        Ingresar
    </button>

</form>

<br>

<a href="registro.php">
    Regístrate
</a>

</body>
</html>