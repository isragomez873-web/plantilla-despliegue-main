<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#9333ea">
    <title>To-do List</title>

    <link rel="stylesheet" href="/proyecto/styles.css">
    <script src="/proyecto/script.js"></script>
</head>

<body>

    <div class="contenedor">

        <h1>Lista de Tareas</h1>

        <p> Hola, <strong><?php echo $_SESSION["nombre"]; ?></strong></p>

        <input type="text" id="nuevaTarea" placeholder="Ingresa nueva tarea">

        <button class="btn-agregar" onclick="agregarTarea()">
            Agregar Tarea
        </button>

        <ul id="listaTareas"></ul>

        <br><br>

        <a href="logout.php">Cerrar sesión</a>

    </div>

    <link rel="manifest" href="/proyecto/manifest.json">

</body>
</html>