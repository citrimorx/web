<?php
$conexion = new mysqli("localhost", "root", "", "empresa");

if ($conexion->connect_error) {
    die("Error al conectar: " . $conexion->connect_error);
}

$correo = $_POST['correo'];

// Consultar historial de compras del cliente
$sql = "SELECT * FROM compras WHERE correo_cliente = '$correo' ORDER BY fecha_compra DESC";
$resultado = $conexion->query($sql);

echo "<div class='container'>";
echo "<h2>Historial de compras de $correo</h2>";

if ($resultado->num_rows > 0) {
    echo "<table>
            <tr>
              <th>ID</th>
              <th>Producto</th>
              <th>Cantidad</th>
              <th>Precio</th>
              <th>Fecha</th>
            </tr>";
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>
                <td>{$fila['id']}</td>
                <td>{$fila['producto']}</td>
                <td>{$fila['cantidad']}</td>
                <td>\${$fila['precio']}</td>
                <td>{$fila['fecha_compra']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No se encontraron compras para este cliente.</p>";
}

echo "<p><a href='historial_cliente.html'>Volver</a></p>";
echo "</div>";

$conexion->close();
?>
