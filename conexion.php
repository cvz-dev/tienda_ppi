<?php
    $con = mysqli_connect("db", "root", "root_password", "tienda_ppi");

    if (mysqli_connect_errno()) {
        die("Error al conectar con MySQL: " . mysqli_connect_error());
    }

    echo "Conexión exitosa a la base de datos tienda_ppi";
?>
