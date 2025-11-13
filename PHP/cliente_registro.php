<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "empresa");

// Verificar conexión
if ($conexion->connect_error) {
    die("Error al conectar a la base de datos: " . $conexion->connect_error);
}

// --- REGISTRAR CLIENTE ---
if (isset($_POST['registrar'])) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];

    $sql = "INSERT INTO clientes (nombre, correo, telefono) VALUES ('$nombre', '$correo', '$telefono')";
    if ($conexion->query($sql) === TRUE) {
        echo "<script>alert('Cliente registrado correctamente');</script>";
    } else {
        echo "<script>alert('Error al registrar cliente');</script>";
    }
}

// --- ELIMINAR CLIENTE ---
if (isset($_POST['eliminar'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM clientes WHERE id = $id";
    if ($conexion->query($sql) === TRUE) {
        echo "<script>alert('Cliente eliminado correctamente');</script>";
    } else {
        echo "<script>alert('Error al eliminar cliente');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Clientes</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0fff0;
      display: flex;
      flex-direction: column;
      align-items: center;
      margin: 0;
      padding: 40px;
    }
    h1, h2 {
      color: #006600;
    }
    .container {
      background: white;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 90%;
      max-width: 600px;
      text-align: center;
    }
    form {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    input, button {
      margin: 8px 0;
      padding: 10px;
      width: 90%;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    button {
      background-color: #008000;
      color: white;
      font-weight: bold;
      cursor: pointer;
      border: none;
    }
    button:hover {
      background-color: #66bb66;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: center;
    }
    th {
      background-color: #e8f5e9;
      color: #006600;
    }
    .eliminar {
      background-color: #ff4d4d;
      color: white;
      border: none;
    }
    .eliminar:hover {
      background-color: #e60000;
    }
  </style>
</head>
<body>

  <div class="container">
    <h1>Gestión de Clientes</h1>

    <section>
      <h2>Registrar nuevo cliente</h2>
      <form method="POST">
        <input type="text" name="nombre" placeholder="Nombre completo" required>
        <input type="email" name="correo" placeholder="Correo electrónico" required>
        <input type="text" name="telefono" placeholder="Teléfono" required>
        <button type="submit" name="registrar">Registrar cliente</button>
      </form>
    </section>

    <section>
      <h2>Lista de clientes registrados</h2>
      <table>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Correo</th>
          <th>Teléfono</th>
          <th>Acción</th>
        </tr>

        <?php
        $resultado = $conexion->query("SELECT * FROM clientes");
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>
                        <td>{$fila['id']}</td>
                        <td>{$fila['nombre']}</td>
                        <td>{$fila['correo']}</td>
                        <td>{$fila['telefono']}</td>
                        <td>
                          <form method='POST' onsubmit='return confirm(\"¿Deseas eliminar este cliente?\");'>
                            <input type='hidden' name='id' value='{$fila['id']}'>
                            <button type='submit' name='eliminar' class='eliminar'>Dar de baja</button>
                          </form>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No hay clientes registrados</td></tr>";
        }
        ?>
      </table>
    </section>
  </div>

</body>
</html>

<?php
$conexion->close();
?>
