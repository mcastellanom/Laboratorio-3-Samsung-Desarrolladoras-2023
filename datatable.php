<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
    <link rel="stylesheet" href="datatableStyle.css">
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "SQLDB";

    // This is the Connection 
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failure: " . $conn->connect_error);
    }

    // SQL QUERIES
    $sql = "SELECT * FROM TABLEFORM";
    $result = $conn->query($sql);

    // DEBUG
    if ($result->num_rows > 0) {
        
        echo "<table>";
        echo "<tr><th>Nombre</th><th>Primer Apellido</th><th>Segundo Apellido</th><th>Email</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["lastName"] . "</td>";
            echo "<td>" . $row["secondLastName"] . "</td>";
            echo "<td>" . $row["mail"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";

    } else {
        echo "No existen registros.";
    }

    // Close
    $conn->close();
    ?>
</body>
</html>