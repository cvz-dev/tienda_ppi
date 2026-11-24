<?php
    session_start();

    $titulo = "Catálogo";
    $pagina = "catalogo";
    include "includes/header.php";
?>

    <main class="container py-5">
        <p class="etiqueta mb-1">Hardware modular</p>
        <h1 class="mb-4">Catálogo</h1>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4">
            <?php
                include "includes/conexion.php";

                $sql = "SELECT id_producto, nombre, foto, precio, cantidad_almacen, fabricante FROM productos ORDER BY id_producto;";
                $resultado = mysqli_query($con, $sql);

                while ($row = mysqli_fetch_array($resultado)) {
                    echo "<div class='col'>";
                    echo "<div class='tarjeta producto h-100 position-relative'>";
                    echo "<img src='" . htmlspecialchars($row['foto']) . "' class='producto-foto' alt='" . htmlspecialchars($row['nombre']) . "'>";
                    echo "<div class='p-3'>";
                    echo "<p class='producto-fabricante mb-1'>" . htmlspecialchars($row['fabricante']) . "</p>";
                    // stretched-link hace que toda la tarjeta sea clic hacia el detalle
                    echo "<h2 class='producto-nombre'><a class='stretched-link' href='producto.php?id=" . $row['id_producto'] . "'>" . htmlspecialchars($row['nombre']) . "</a></h2>";
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

<?php include "includes/footer.php"; ?>
