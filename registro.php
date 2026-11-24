<?php
    session_start();

    if (isset($_SESSION['id_usuario'])) {
        header("Location: index.php");
        exit;
    }

    $estados = array(
        "Aguascalientes", "Baja California", "Baja California Sur", "Campeche", "Chiapas",
        "Chihuahua", "Ciudad de México", "Coahuila", "Colima", "Durango", "Estado de México",
        "Guanajuato", "Guerrero", "Hidalgo", "Jalisco", "Michoacán", "Morelos", "Nayarit",
        "Nuevo León", "Oaxaca", "Puebla", "Querétaro", "Quintana Roo", "San Luis Potosí",
        "Sinaloa", "Sonora", "Tabasco", "Tamaulipas", "Tlaxcala", "Veracruz", "Yucatán", "Zacatecas"
    );

    $nombre = "";
    $correo = "";
    $fecha_nacimiento = "";
    $numero_tarjeta = "";
    $calle = "";
    $numero_exterior = "";
    $numero_interior = "";
    $colonia = "";
    $codigo_postal = "";
    $ciudad = "";
    $estado = "";

    $errores = array();
    $registrado = false;

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $nombre = trim($_POST['nombre']);
        $correo = trim($_POST['correo']);
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $contrasena = $_POST['contrasena'];
        $confirmar = $_POST['confirmar'];
        $numero_tarjeta = trim($_POST['numero_tarjeta']);
        $calle = trim($_POST['calle']);
        $numero_exterior = trim($_POST['numero_exterior']);
        $numero_interior = trim($_POST['numero_interior']);
        $colonia = trim($_POST['colonia']);
        $codigo_postal = trim($_POST['codigo_postal']);
        $ciudad = trim($_POST['ciudad']);
        $estado = $_POST['estado'];

        if ($nombre == "" || $calle == "" || $numero_exterior == "" || $colonia == "" || $ciudad == "") {
            $errores[] = "Llena todos los campos obligatorios.";
        }
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $errores[] = "El correo no es válido.";
        }
        if (strlen($contrasena) < 8) {
            $errores[] = "La contraseña debe tener al menos 8 caracteres.";
        }
        if ($contrasena != $confirmar) {
            $errores[] = "Las contraseñas no coinciden.";
        }
        $fecha = DateTime::createFromFormat("Y-m-d", $fecha_nacimiento);
        if (!$fecha || $fecha->format("Y-m-d") != $fecha_nacimiento || $fecha_nacimiento > date("Y-m-d")) {
            $errores[] = "La fecha de nacimiento no es válida.";
        }
        if (!preg_match("/^[0-9]{13,19}$/", $numero_tarjeta)) {
            $errores[] = "El número de tarjeta debe tener de 13 a 19 dígitos.";
        }
        if (!preg_match("/^[0-9]{5}$/", $codigo_postal)) {
            $errores[] = "El código postal debe tener 5 dígitos.";
        }
        if (!in_array($estado, $estados)) {
            $errores[] = "Selecciona un estado.";
        }

        if (count($errores) == 0) {
            include "includes/conexion.php";

            $stmt = mysqli_prepare($con, "SELECT id_usuario FROM usuarios WHERE correo = ?;");
            mysqli_stmt_bind_param($stmt, "s", $correo);
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($resultado) > 0) {
                $errores[] = "Ya existe una cuenta con ese correo.";
            }
            mysqli_stmt_close($stmt);

            if (count($errores) == 0) {
                $hash = password_hash($contrasena, PASSWORD_DEFAULT);
                if ($numero_interior == "") {
                    $numero_interior = null;
                }
                mysqli_begin_transaction($con);
                try {
                    $stmt = mysqli_prepare($con, "INSERT INTO usuarios (nombre, correo, contrasena, fecha_nacimiento, numero_tarjeta) VALUES (?, ?, ?, ?, ?);");
                    mysqli_stmt_bind_param($stmt, "sssss", $nombre, $correo, $hash, $fecha_nacimiento, $numero_tarjeta);
                    mysqli_stmt_execute($stmt);
                    $id_usuario = mysqli_insert_id($con);
                    mysqli_stmt_close($stmt);

                    $stmt = mysqli_prepare($con, "INSERT INTO direcciones (id_usuario, calle, numero_exterior, numero_interior, colonia, codigo_postal, ciudad, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
                    mysqli_stmt_bind_param($stmt, "isssssss", $id_usuario, $calle, $numero_exterior, $numero_interior, $colonia, $codigo_postal, $ciudad, $estado);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);

                    mysqli_commit($con);
                    $registrado = true;
                } catch (mysqli_sql_exception $e) {
                    mysqli_rollback($con);
                    $errores[] = "No se pudo crear la cuenta. Intenta de nuevo.";
                }
            }

            mysqli_close($con);
        }
    }

    $titulo = "Crear cuenta";
    $pagina = "registro";
    include "includes/header.php";
?>

    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php if ($registrado) { ?>
                    <div class="tarjeta p-5 text-center">
                        <p class="etiqueta mb-1">Cuenta creada</p>
                        <h1>¡Bienvenido, <?php echo htmlspecialchars($nombre); ?>!</h1>
                        <p class="mb-4">Tu cuenta se registró con el correo <strong><?php echo htmlspecialchars($correo); ?></strong>.</p>
                        <a class="btn btn-musgo" href="login.php">Iniciar sesión</a>
                        <a class="btn btn-outline-carbon ms-2" href="catalogo.php">Ver catálogo</a>
                    </div>
                <?php } else { ?>
                <p class="etiqueta mb-1">Únete a rebuild.</p>
                <h1 class="mb-4">Crear cuenta</h1>

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

                <form class="tarjeta p-4" action="registro.php" method="post">
                    <h2 class="h5 mb-3">Datos personales</h2>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label" for="nombre">Nombre completo</label>
                            <input class="form-control" type="text" id="nombre" name="nombre" maxlength="100" value="<?php echo htmlspecialchars($nombre); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="correo">Correo electrónico</label>
                            <input class="form-control" type="email" id="correo" name="correo" maxlength="100" value="<?php echo htmlspecialchars($correo); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="fecha_nacimiento">Fecha de nacimiento</label>
                            <input class="form-control" type="date" id="fecha_nacimiento" name="fecha_nacimiento" max="<?php echo date("Y-m-d"); ?>" value="<?php echo htmlspecialchars($fecha_nacimiento); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="contrasena">Contraseña</label>
                            <input class="form-control" type="password" id="contrasena" name="contrasena" minlength="8" required>
                            <div class="form-text">Mínimo 8 caracteres.</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="confirmar">Confirmar contraseña</label>
                            <input class="form-control" type="password" id="confirmar" name="confirmar" minlength="8" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="numero_tarjeta">Número de tarjeta</label>
                            <input class="form-control" type="text" id="numero_tarjeta" name="numero_tarjeta" inputmode="numeric" pattern="[0-9]{13,19}" maxlength="19" value="<?php echo htmlspecialchars($numero_tarjeta); ?>" required>
                            <div class="form-text">Solo números, sin espacios (de 13 a 19 dígitos).</div>
                        </div>
                    </div>

                    <h2 class="h5 mt-4 mb-3">Dirección de envío</h2>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label" for="calle">Calle</label>
                            <input class="form-control" type="text" id="calle" name="calle" maxlength="150" value="<?php echo htmlspecialchars($calle); ?>" required>
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label" for="numero_exterior">Núm. exterior</label>
                            <input class="form-control" type="text" id="numero_exterior" name="numero_exterior" maxlength="10" value="<?php echo htmlspecialchars($numero_exterior); ?>" required>
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label" for="numero_interior">Núm. interior</label>
                            <input class="form-control" type="text" id="numero_interior" name="numero_interior" maxlength="10" placeholder="Opcional" value="<?php echo htmlspecialchars($numero_interior); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="colonia">Colonia</label>
                            <input class="form-control" type="text" id="colonia" name="colonia" maxlength="100" value="<?php echo htmlspecialchars($colonia); ?>" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" for="codigo_postal">Código postal</label>
                            <input class="form-control" type="text" id="codigo_postal" name="codigo_postal" inputmode="numeric" pattern="[0-9]{5}" maxlength="5" value="<?php echo htmlspecialchars($codigo_postal); ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="ciudad">Ciudad</label>
                            <input class="form-control" type="text" id="ciudad" name="ciudad" maxlength="100" value="<?php echo htmlspecialchars($ciudad); ?>" required>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label" for="estado">Estado</label>
                            <select class="form-select" id="estado" name="estado" required>
                                <option value="">Selecciona un estado</option>
                                <?php
                                    foreach ($estados as $opcion) {
                                $seleccionado = "";
                                        if ($opcion == $estado) {
                                            $seleccionado = "selected";
                                        }
                                        echo "<option value='" . $opcion . "' " . $seleccionado . ">" . $opcion . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <button class="btn btn-musgo btn-lg w-100 mt-4" type="submit">Crear cuenta</button>
                    <p class="text-center mt-3 mb-0">¿Ya tienes cuenta? <a class="enlace-simple" href="login.php">Inicia sesión</a></p>
                </form>
                <?php } ?>
            </div>
        </div>
    </main>

<?php include "includes/footer.php"; ?>
