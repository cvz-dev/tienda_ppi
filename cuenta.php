<?php
    session_start();

    // Página privada: sin sesión se manda a iniciar sesión
    if (!isset($_SESSION['id_usuario'])) {
        header("Location: login.php");
        exit;
    }

    include "includes/conexion.php";

    // Datos del usuario junto con su dirección
    $sql = "SELECT u.nombre, u.correo, u.fecha_nacimiento, u.numero_tarjeta,
                   d.calle, d.numero_exterior, d.numero_interior, d.colonia, d.codigo_postal, d.ciudad, d.estado
            FROM usuarios u
            LEFT JOIN direcciones d ON d.id_usuario = u.id_usuario
            WHERE u.id_usuario = ?;";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['id_usuario']);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $usuario = mysqli_fetch_array($resultado);
    mysqli_stmt_close($stmt);
    mysqli_close($con);

    // Si la cuenta ya no existe se cierra la sesión
    if (!$usuario) {
        header("Location: logout.php");
        exit;
    }

    // De la tarjeta solo se muestran los últimos 4 dígitos
    $tarjeta = "•••• " . substr($usuario['numero_tarjeta'], -4);
    $fecha = date("d/m/Y", strtotime($usuario['fecha_nacimiento']));

    $titulo = "Mi cuenta";
    $pagina = "cuenta";
    include "includes/header.php";
?>

    <main class="container py-5">
        <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
            <div>
                <p class="etiqueta mb-1">Mi cuenta</p>
                <h1 class="mb-0"><?php echo htmlspecialchars($usuario['nombre']); ?></h1>
            </div>
            <div class="d-flex gap-2">
                <a class="btn btn-musgo" href="editar_cuenta.php">Editar datos</a>
                <a class="btn btn-outline-carbon" href="logout.php">Cerrar sesión</a>
            </div>
        </div>

        <?php if (isset($_GET['guardado'])) { ?>
            <div class="alert alert-success">Tus datos se guardaron correctamente.</div>
        <?php } ?>
        <?php if (isset($_GET['contrasena'])) { ?>
            <div class="alert alert-success">Tu contraseña se cambió correctamente.</div>
        <?php } ?>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="tarjeta p-4 h-100">
                    <h2 class="h4">Datos personales</h2>
                    <table class="table detalle-ficha mb-0">
                        <tr>
                            <th>Nombre</th>
                            <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                        </tr>
                        <tr>
                            <th>Correo</th>
                            <td class="text-break"><?php echo htmlspecialchars($usuario['correo']); ?></td>
                        </tr>
                        <tr>
                            <th>Fecha de nacimiento</th>
                            <td><?php echo $fecha; ?></td>
                        </tr>
                        <tr>
                            <th>Tarjeta</th>
                            <td><?php echo $tarjeta; ?></td>
                        </tr>
                        <tr>
                            <th>Contraseña</th>
                            <td>•••••••• <a class="enlace-simple ms-2" href="cambiar_contrasena.php">Cambiar</a></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="tarjeta p-4 h-100">
                    <h2 class="h4">Dirección de envío</h2>
                    <?php if ($usuario['calle']) { ?>
                        <table class="table detalle-ficha mb-0">
                            <tr>
                                <th>Calle</th>
                                <td>
                                    <?php
                                        echo htmlspecialchars($usuario['calle']) . " " . htmlspecialchars($usuario['numero_exterior']);
                                        if ($usuario['numero_interior']) {
                                            echo ", int. " . htmlspecialchars($usuario['numero_interior']);
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Colonia</th>
                                <td><?php echo htmlspecialchars($usuario['colonia']); ?></td>
                            </tr>
                            <tr>
                                <th>Código postal</th>
                                <td><?php echo htmlspecialchars($usuario['codigo_postal']); ?></td>
                            </tr>
                            <tr>
                                <th>Ciudad</th>
                                <td><?php echo htmlspecialchars($usuario['ciudad']); ?></td>
                            </tr>
                            <tr>
                                <th>Estado</th>
                                <td><?php echo htmlspecialchars($usuario['estado']); ?></td>
                            </tr>
                        </table>
                    <?php } else { ?>
                        <p class="mb-0">No tienes una dirección registrada.</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>

<?php include "includes/footer.php"; ?>
