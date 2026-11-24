<?php
    session_start();

    $producto = null;

    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];

        include "includes/conexion.php";

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

    $pagina = "catalogo";
    include "includes/header.php";
?>

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

<?php include "includes/footer.php"; ?>
