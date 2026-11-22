<?php
    // Conexión a la base de datos de la tienda.
    // Las páginas que consultan la BD lo incluyen y usan la variable $con.
    $con = mysqli_connect("db", "root", "root_password", "tienda_ppi");

    if (mysqli_connect_errno()) {
        die("Error al conectar con MySQL: " . mysqli_connect_error());
    }
?>
