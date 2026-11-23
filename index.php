<?php
    $titulo = "Inicio";
    $pagina = "inicio";
    include "includes/header.php";
?>

    <main>
        <section class="hero">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <p class="etiqueta">Hardware modular</p>
                        <h1>Arma la tuya. Repárala. Mejórala.</h1>
                        <p class="lead mt-3">
                            Laptops, PCs y teléfonos hechos por módulos. Tú decides qué cambiar,
                            cuándo cambiarlo y cómo se ve.
                        </p>
                        <a class="btn btn-musgo btn-lg mt-2" href="catalogo.php">Ver catálogo</a>
                        <a class="btn btn-outline-carbon btn-lg mt-2 ms-2" href="registro.php">Crear cuenta</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="container pb-5">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="tarjeta p-4 h-100">
                        <h3>Laptops</h3>
                        <p class="mb-0">Pantalla, puertos, teclado y batería intercambiables.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="tarjeta p-4 h-100">
                        <h3>PCs</h3>
                        <p class="mb-0">Gabinetes y componentes para armar desde cero.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="tarjeta p-4 h-100">
                        <h3>Teléfonos</h3>
                        <p class="mb-0">Pantalla, cámara y batería que puedes reemplazar.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="container pb-5">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <p class="etiqueta mb-1">Del catálogo</p>
                    <h2 class="mb-0">Destacados</h2>
                </div>
                <a class="enlace-simple" href="catalogo.php">Ver todo &rarr;</a>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
                <?php
                    include "includes/conexion.php";

                    // Cuatro productos con existencias, elegidos al azar en cada visita
                    $sql = "SELECT id_producto, nombre, foto, precio, cantidad_almacen, fabricante FROM productos WHERE cantidad_almacen > 0 ORDER BY RAND() LIMIT 4;";
                    $resultado = mysqli_query($con, $sql);

                    while ($row = mysqli_fetch_array($resultado)) {
                        echo "<div class='col'>";
                        echo "<div class='tarjeta producto h-100 position-relative'>";
                        echo "<img src='" . htmlspecialchars($row['foto']) . "' class='producto-foto' alt='" . htmlspecialchars($row['nombre']) . "'>";
                        echo "<div class='p-3'>";
                        echo "<p class='producto-fabricante mb-1'>" . htmlspecialchars($row['fabricante']) . "</p>";
                        echo "<h3 class='producto-nombre'><a class='stretched-link' href='producto.php?id=" . $row['id_producto'] . "'>" . htmlspecialchars($row['nombre']) . "</a></h3>";
                        echo "<p class='producto-precio mb-0'>$" . number_format($row['precio'], 2) . " MXN</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }

                    mysqli_close($con);
                ?>
            </div>
        </section>
    </main>

<?php include "includes/footer.php"; ?>
