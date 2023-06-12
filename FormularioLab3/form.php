<?php
// Data DB
$dbservername = "localhost";
$dbusername = "root";
$dbpassword = '';
$dbname = "SQLDB";

// form data
$name = $_POST['name'] ?? '';
$lastName = $_POST['lastName'] ?? '';
$secondLastName = $_POST['secondLastName'] ?? '';
$mail = $_POST['mail'] ?? '';
$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';


// Check data
if (empty($name) || empty($lastName) || empty($secondLastName) || empty($mail) || empty($login) || empty($password)) {
  echo "Por favor, rellene todos los campos.";
} elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
  echo "ERROR: El email no es válido.";
} elseif (strlen($password) < 4 || strlen($password) > 8) {
  echo "ERROR: La contraseña debe tener entre 4 y 8 caracteres.";
} else {
  // Create Connection
  $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname); 
  if ($conn->connect_error) {
    die("Connection failure: " . $conn->connect_error);
  }
  
  // Check duplicate email
  $checkEmail = false;
  $checkEmailQuery = "SELECT * FROM TABLEFORM WHERE mail='$mail'";
  $checkEmailResult = $conn->query($checkEmailQuery);
  if ($checkEmailResult->num_rows > 0) {
    $checkEmail = true;
  }
  
  if ($checkEmail) {
    echo "Este email ya existe.";
  } else {

    // Password Hash
    $hashPswd = password_hash($password, PASSWORD_BCRYPT);

    // Insert
    $insertQuery = "INSERT INTO TABLEFORM (name, lastName, secondLastName, mail, login, password) VALUES ('$name', '$lastName', '$secondLastName', '$mail', '$login', '$hashPswd')";
    if ($conn->query($insertQuery) === true) {
    
     // return:
     ?>
      <!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register Form</title>
        <link rel="stylesheet" href="styles.css">
      </head>
      <body>
        <div class="container">
            <h1>Success</h1>
            <p>Se ha completado su registro.</p>
            <a href="index.html">Volver</a>
        </div>
      </body>
      </html>
    <?php
  
    } else {
      echo "Registration Error: " . $conn->error;
    }
  }
// Cerrar conexión
$conn->close();
}
?>
