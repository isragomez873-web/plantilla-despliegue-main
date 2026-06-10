<?php
session_start();
require_once("conexion.php");

if (!isset($_SESSION["usuario_id"])) {
    exit("Acceso denegado");
}

$descripcion = trim($_POST["descripcion"]);
$usuario_id = $_SESSION["usuario_id"];

$sql = "INSERT INTO tareas (descripcion, usuario_id) VALUES (?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->execute([$descripcion, $usuario_id]);

echo "Tarea guardada correctamente";
?>