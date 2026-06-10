<?php
session_start();
require_once("conexion.php");

if (!isset($_SESSION["usuario_id"])) {
    exit("No autorizado");
}

$id = $_POST["id"];

$sql = "DELETE FROM tareas
        WHERE id = ?
        AND usuario_id = ?";

$stmt = $conexion->prepare($sql);
$stmt->execute([$id, $_SESSION["usuario_id"]]);

echo "Tarea eliminada correctamente";
?>