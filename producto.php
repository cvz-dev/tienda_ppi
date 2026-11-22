<?php
    // Se busca el producto antes de mostrar la página para poder usar su nombre en el título
    $producto = null;

    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];

        $con = mysqli_connect("db", "root", "root_password", "tienda_ppi");

        if (mysqli_connect_errno()) {
            die("Error al conectar con MySQL: " . mysqli_connect_error());
        }

        $sql = "SELECT nombre, descripcion, foto, precio, cantidad_almacen, fabricante, origen FROM productos WHERE id_producto = ?;";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        $producto = mysqli_fetch_array($resultado);

        mysqli_stmt_close($stmt);
        mysqli_close($con);
    }

    if ($producto) {
        $titulo = $producto['nombre'];
    } else {
        http_response_code(404);
        $titulo = "Producto no encontrado";
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rebuild - <?php echo htmlspecialchars($titulo); ?></title>

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
        <a class="enlace-simple d-inline-block mb-4" href="catalogo.php">&larr; Volver al catálogo</a>

        <?php if ($producto) { ?>
            <div class="row g-5">
                <div class="col-md-6">
                    <img src="<?php echo htmlspecialchars($producto['foto']); ?>" class="detalle-foto tarjeta" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                </div>

                <div class="col-md-6">
                    <p class="producto-fabricante mb-1"><?php echo htmlspecialchars($producto['fabricante']); ?></p>
                    <h1 class="detalle-nombre"><?php echo htmlspecialchars($producto['nombre']); ?></h1>
                    <p class="detalle-precio my-3">$<?php echo number_format($producto['precio'], 2); ?> MXN</p>

                    <?php if ($producto['cantidad_almacen'] > 0) { ?>
                        <span class="badge badge-disponible"><?php echo $producto['cantidad_almacen']; ?> disponibles</span>
                    <?php } else { ?>
                        <span class="badge badge-agotado">Agotado</span>
                    <?php } ?>

                    <p class="mt-4"><?php echo htmlspecialchars($producto['descripcion']); ?></p>

                    <table class="table detalle-ficha mt-4">
                        <tr>
                            <th>Fabricante</th>
                            <td><?php echo htmlspecialchars($producto['fabricante']); ?></td>
                        </tr>
                        <tr>
                            <th>Origen</th>
                            <td><?php echo htmlspecialchars($producto['origen']); ?></td>
                        </tr>
                        <tr>
                            <th>En almacén</th>
                            <td><?php echo $producto['cantidad_almacen']; ?> piezas</td>
                        </tr>
                    </table>

                    <!-- El carrito se activa en una fase posterior -->
                    <button type="button" class="btn btn-musgo btn-lg w-100" disabled>Agregar al carrito</button>
                </div>
            </div>
        <?php } else { ?>
            <div class="tarjeta p-5 text-center">
                <h1>Producto no encontrado</h1>
                <p class="mb-4">El producto que buscas no existe o ya no está disponible.</p>
                <a class="btn btn-musgo" href="catalogo.php">Ir al catálogo</a>
            </div>
        <?php } ?>
    </main>

    <footer class="footer-rebuild py-4">
        <div class="container text-center">
            <p class="mb-0">rebuild. Hardware hecho para durar.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
