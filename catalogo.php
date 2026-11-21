<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rebuild - Catálogo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-rebuild">
        <div class="container">
            <a class="navbar-brand" href="index.php">rebuild<span>.</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menuPrincipal">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link active" href="catalogo.php">Catálogo</a></li>
                    <li class="nav-item"><a class="nav-link" href="contacto.php">Contacto</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">Carrito</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Iniciar sesión</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Crear cuenta</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-5">
        <p class="etiqueta mb-1">Hardware modular</p>
        <h1 class="mb-4">Catálogo</h1>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4">
            <?php
                $con = mysqli_connect("db", "root", "root_password", "tienda_ppi");

                if (mysqli_connect_errno()) {
                    echo "<p>Error al conectar con MySQL: " . mysqli_connect_error() . "</p>";
                }

                $sql = "SELECT id_producto, nombre, foto, precio, cantidad_almacen, fabricante FROM productos ORDER BY id_producto;";
                $resultado = mysqli_query($con, $sql);

                while ($row = mysqli_fetch_array($resultado)) {
                    echo "<div class='col'>";
                    echo "<div class='tarjeta producto h-100'>";
                    echo "<img src='" . htmlspecialchars($row['foto']) . "' class='producto-foto' alt='" . htmlspecialchars($row['nombre']) . "'>";
                    echo "<div class='p-3'>";
                    echo "<p class='producto-fabricante mb-1'>" . htmlspecialchars($row['fabricante']) . "</p>";
                    echo "<h2 class='producto-nombre'>" . htmlspecialchars($row['nombre']) . "</h2>";
                    echo "<p class='producto-precio mb-2'>$" . number_format($row['precio'], 2) . " MXN</p>";

                    if ($row['cantidad_almacen'] > 0) {
                        echo "<span class='badge badge-disponible'>" . $row['cantidad_almacen'] . " disponibles</span>";
                    } else {
                        echo "<span class='badge badge-agotado'>Agotado</span>";
                    }

                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }

                mysqli_close($con);
            ?>
        </div>
    </main>

    <footer class="footer-rebuild py-4">
        <div class="container text-center">
            <p class="mb-0">rebuild. Hardware hecho para durar.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
