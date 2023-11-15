<?php
require 'database.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!empty($_POST['tipo']) && !empty($_POST['nombre']) && !empty($_POST['email']) && !empty($_POST['mensaje'])) {
    $tipo = $_POST['tipo'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $mensaje = $_POST['mensaje'];

    // Validar y limpiar los datos si es necesario

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO pqrs (tipo, nombre, email, mensaje) VALUES (:tipo, :nombre, :email, :mensaje)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mensaje', $mensaje);

    if ($stmt->execute()) {
      $message = 'Se ha enviado el formulario PQRS con éxito';
    } else {
      $message = 'Lo siento, ha ocurrido un error al enviar el formulario PQRS';
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
        <title>Tarandruss - PQRS</title>
        <link rel="stylesheet" href="./assets/css/PQRS.css">
        <link rel="stylesheet" href="./assets/css/reset.css">
    </head>
   <body>
        <header class="cabecera__ingresar">
          <img src="media/logotarandruss.png" alt="logotarandruss" class="cabecera__logo">
          <div class="cabecera__iconos">
           <a href=""><img src="media/iconocomprar.png" alt="iconocomprar" class="cabecera__icono"></a>
           <a href="ingresar.html"><img src="media/iconoingresar.png" alt="iconoingresar" class="cabecera__icono"></a>
          </div> 
        </header>

        <div class="container">
            <form method="POST" action="PQRS.php">
              <h2 class="Titulo__Form">Formulario PQRS</h2>
              <div class="form-group">
                <label for="tipo">Tipo:</label>
                <select id="tipo" name="tipo" required>
                  <option value="peticion">Peticion</option>
                  <option value="queja">Queja</option>
                  <option value="reclamo">Reclamo</option>
                  <option value="sugerencia">Sugerencia</option>
                </select>
              </div>
              <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
              </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
              </div>
              <div class="form-group">
                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="mensaje" rows="5" required></textarea>
              </div>
              <input type="submit" value="Enviar">
            </form>
          </div>
   </body>

</html>