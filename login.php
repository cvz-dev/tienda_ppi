<?php
    session_start();

    if (isset($_SESSION['id_usuario'])) {
        header("Location: index.php");
        exit;
    }

    $correo = "";
    $error = "";

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $correo = trim($_POST['correo']);
        $contrasena = $_POST['contrasena'];

        include "includes/conexion.php";

        $stmt = mysqli_prepare($con, "SELECT id_usuario, nombre, contrasena, rol FROM usuarios WHERE correo = ?;");
        mysqli_stmt_bind_param($stmt, "s", $correo);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        $usuario = mysqli_fetch_array($resultado);
        mysqli_stmt_close($stmt);
        mysqli_close($con);

        if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
            session_regenerate_id(true);
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['rol'] = $usuario['rol'];

            header("Location: index.php");
            exit;
        } else {
            $error = "Correo o contraseña incorrectos.";
        }
    }

    $titulo = "Iniciar sesión";
    $pagina = "login";
    include "includes/header.php";
?>

    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5">
                <p class="etiqueta mb-1">Bienvenido de vuelta</p>
                <h1 class="mb-4">Iniciar sesión</h1>

                <?php if ($error != "") { ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php } ?>

                <form class="tarjeta p-4" action="login.php" method="post">
                    <div class="mb-3">
                        <label class="form-label" for="correo">Correo electrónico</label>
                        <input class="form-control" type="email" id="correo" name="correo" maxlength="100" value="<?php echo htmlspecialchars($correo); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="contrasena">Contraseña</label>
                        <input class="form-control" type="password" id="contrasena" name="contrasena" required>
                    </div>

                    <button class="btn btn-musgo btn-lg w-100 mt-2" type="submit">Iniciar sesión</button>
                    <p class="text-center mt-3 mb-0">¿No tienes cuenta? <a class="enlace-simple" href="registro.php">Crea una</a></p>
                </form>
            </div>
        </div>
    </main>

<?php include "includes/footer.php"; ?>
