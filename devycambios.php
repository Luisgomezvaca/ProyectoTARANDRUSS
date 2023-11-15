<?php
require 'database.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!empty($_POST['nombre']) && !empty($_POST['email']) && !empty($_POST['pedido']) && !empty($_POST['motivo'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $pedido = $_POST['pedido'];
    $motivo = $_POST['motivo'];

    // Validar y limpiar los datos si es necesario

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO devolucion (nombre, email, pedido, motivo) VALUES (:nombre, :email, :pedido, :motivo)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':pedido', $pedido);
    $stmt->bindParam(':motivo', $motivo);

    if ($stmt->execute()) {
      $message = 'Se ha enviado el formulario deDevolucion con éxito';
    } else {
      $message = 'Lo siento, ha ocurrido un error al enviar el formulario Devolucion';
    }
  } else {
    $message = 'Por favor, complete todos los campos del formulario';
  }
}
?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tarandruss - Devoluciones y Cambios</title>
        <link rel="stylesheet" href="./assets/css/reset.css">
        <link rel="stylesheet" href="./assets/css/devycambios.css">
    </head>

    <body>
        <header class="cabecera__ingresar">
          <img src="media/logotarandruss.png" alt="logotarandruss" class="cabecera__logo">
          <div class="cabecera__iconos">
           <a href=""><img src="media/iconocomprar.png" alt="iconocomprar" class="cabecera__icono"></a>
           <a href="ingresar.html"><img src="media/iconoingresar.png" alt="iconoingresar" class="cabecera__icono"></a>
          </div> 
        </header>
        <main>
            <section id="cambios-devoluciones">
              <h2>Solicitar Cambios y Devoluciones de Productos</h2>
              <form method="POST" action="devycambios.php">
                <div class="form-group">
                  <label for="nombre">Nombre:</label>
                  <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                  <label for="pedido">Número de pedido:</label>
                  <input type="text" id="pedido" name="pedido" required>
                </div>
                <div class="form-group">
                  <label for="motivo">Motivo:</label>
                  <textarea id="motivo" name="motivo" rows="5" required></textarea>
                </div>
                <input type="submit" value="Enviar solicitud">
              </form>
            </section>
        </main>
        
    </body>
</html>