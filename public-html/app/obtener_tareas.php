<?php
session_start();
require_once("conexion.php");

if (!isset($_SESSION["usuario_id"])) {
    exit("Acceso denegado");
}

$usuario_id = $_SESSION["usuario_id"];

$sql = "SELECT * FROM tareas WHERE usuario_id = ? ORDER BY id DESC";
$stmt = $conexion->prepare($sql);
$stmt->execute([$usuario_id]);
$tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($tareas);
?>