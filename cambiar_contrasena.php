<?php
    session_start();

    // Página privada: sin sesión se manda a iniciar sesión
    if (!isset($_SESSION['id_usuario'])) {
        header("Location: login.php");
        exit;
    }

    $errores = array();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $actual = $_POST['actual'];
        $nueva = $_POST['nueva'];
        $confirmar = $_POST['confirmar'];

        if (strlen($nueva) < 8) {
            $errores[] = "La nueva contraseña debe tener al menos 8 caracteres.";
        }
        if ($nueva != $confirmar) {
            $errores[] = "Las contraseñas nuevas no coinciden.";
        }

        if (count($errores) == 0) {
            include "includes/conexion.php";

            // Se pide la contraseña actual para confirmar que es el dueño de la cuenta
            $stmt = mysqli_prepare($con, "SELECT contrasena FROM usuarios WHERE id_usuario = ?;");
            mysqli_stmt_bind_param($stmt, "i", $_SESSION['id_usuario']);
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);
            $usuario = mysqli_fetch_array($resultado);
            mysqli_stmt_close($stmt);

            if (!$usuario || !password_verify($actual, $usuario['contrasena'])) {
                $errores[] = "La contraseña actual no es correcta.";
            } else if (password_verify($nueva, $usuario['contrasena'])) {
                $errores[] = "La nueva contraseña debe ser diferente a la actual.";
            } else {
                $hash = password_hash($nueva, PASSWORD_DEFAULT);
                $stmt = mysqli_prepare($con, "UPDATE usuarios SET contrasena = ? WHERE id_usuario = ?;");
                mysqli_stmt_bind_param($stmt, "si", $hash, $_SESSION['id_usuario']);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                mysqli_close($con);

                header("Location: cuenta.php?contrasena=1");
                exit;
            }

            mysqli_close($con);
        }
    }

    $titulo = "Cambiar contraseña";
    $pagina = "cuenta";
    include "includes/header.php";
?>

    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5">
                <a class="enlace-simple d-inline-block mb-4" href="cuenta.php">&larr; Volver a mi cuenta</a>
                <p class="etiqueta mb-1">Mi cuenta</p>
                <h1 class="mb-4">Cambiar contraseña</h1>

                <?php if (count($errores) > 0) { ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php
                                foreach ($errores as $error) {
                                    echo "<li>" . $error . "</li>";
                                }
                            ?>
                        </ul>
                    </div>
                <?php } ?>

                <!-- Las contraseñas nunca se vuelven a llenar en el formulario -->
                <form class="tarjeta p-4" action="cambiar_contrasena.php" method="post">
                    <div class="mb-3">
                        <label class="form-label" for="actual">Contraseña actual</label>
                        <input class="form-control" type="password" id="actual" name="actual" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="nueva">Nueva contraseña</label>
                        <input class="form-control" type="password" id="nueva" name="nueva" minlength="8" required>
                        <div class="form-text">Mínimo 8 caracteres.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="confirmar">Confirmar nueva contraseña</label>
                        <input class="form-control" type="password" id="confirmar" name="confirmar" minlength="8" required>
                    </div>

                    <div class="d-flex flex-column flex-sm-row gap-2 mt-4">
                        <button class="btn btn-musgo btn-lg flex-fill" type="submit">Guardar</button>
                        <a class="btn btn-outline-carbon btn-lg flex-fill" href="cuenta.php">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

<?php include "includes/footer.php"; ?>
