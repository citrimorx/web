<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "empresa");

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];
$area = $_POST['area'];

// Encriptar la contraseña antes de guardarla
$contraseña_segura = password_hash($contraseña, PASSWORD_DEFAULT);

// Preparar la consulta para evitar inyección SQL
$stmt = $conexion->prepare("INSERT INTO empleados (nombre, correo, contraseña, area) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nombre, $correo, $contraseña_segura, $area);

// Ejecutar e informar resultado
if ($stmt->execute()) {
    echo "<h2>Empleado registrado correctamente.</h2>";
    echo "<p><a href='../HTML/empleado_app.html'>Ir al panel</a></p>";
} else {
    echo "<h2>Error al registrar empleado: " . $stmt->error . "</h2>";
}

// Cerrar conexión
$stmt->close();
$conexion->close();
?>
