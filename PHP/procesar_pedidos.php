<?php
// Verificar que se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Recibir los datos del formulario
    $nombre = htmlspecialchars($_POST['nombre']);
    $correo = htmlspecialchars($_POST['correo']);
    $por_caja = intval($_POST['por_caja']); // Cantidad de cajas
    $por_kg = intval($_POST['por_kg']);     // Cantidad en kg

    // Validar que se haya seleccionado al menos una opción
    if ($por_caja == 0 && $por_kg == 0) {
        echo "<h2>Debes seleccionar al menos una opción de pedido.</h2>";
        echo "<a href='pedido.html'>Regresar</a>";
        exit;
    }

    // Crear un mensaje de confirmación
    echo "<h1>Pedido recibido con éxito</h1>";
    echo "<p>Nombre: $nombre</p>";
    echo "<p>Correo: $correo</p>";

    if ($por_caja > 0) {
        echo "<p>Pedido por cajas: $por_caja caja(s) (30 kg cada una)</p>";
    }

    if ($por_kg > 0) {
        echo "<p>Pedido por kilo: $por_kg kg</p>";
    }

    echo "<p>⚠️ Recuerda: Los pedidos se recogen en el lugar, no realizamos envíos.</p>";
    echo "<br><a href='pedido.html'>Realizar otro pedido</a> | <a href='index.html'>Ir al inicio</a>";

    // Opcional: aquí podrías guardar los pedidos en un archivo o base de datos
    // Por ejemplo, en un archivo CSV:
    /*
    $archivo = fopen("pedidos.csv", "a");
    fputcsv($archivo, [$nombre, $correo, $por_caja, $por_kg, date("Y-m-d H:i:s")]);
    fclose($archivo);
    */
    
} else {
    // Si se accede directamente al PHP sin enviar el formulario
    header("Location: pedido.html");
    exit;
}
?>
