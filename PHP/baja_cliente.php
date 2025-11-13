<?php
$conexion = new mysqli("localhost", "root", "", "empresa");

if ($conexion->connect_error) {
    die("Error al conectar: " . $conexion->connect_error);
}

$nombre = $_POST['nombre'];

// Elimina el cliente por nombre (coincidencia exacta)
$sql = "DELETE FROM clientes WHERE nombre = '$nombre'";

if ($conexion->query($sql) === TRUE) {
    if ($conexion->affected_rows > 0) {
        echo "<script>alert('Cliente eliminado correctamente'); window.location.href='baja_cliente.html';</script>";
    } else {
        echo "<script>alert('No se encontró ningún cliente con ese nombre'); window.location.href='baja_cliente.html';</script>";
    }
} else {
    echo "<script>alert('Error al eliminar cliente'); window.location.href='baja_cliente.html';</script>";
}

$conexion->close();
?>
