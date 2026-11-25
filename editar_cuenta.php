<?php
    session_start();

    // Página privada: sin sesión se manda a iniciar sesión
    if (!isset($_SESSION['id_usuario'])) {
        header("Location: login.php");
        exit;
    }

    include "includes/estados.php";
    include "includes/conexion.php";

    $id_usuario = $_SESSION['id_usuario'];
    $errores = array();

    // Datos actuales del usuario y su dirección
    $sql = "SELECT u.nombre, u.correo, u.fecha_nacimiento, u.numero_tarjeta,
                   d.id_direccion, d.calle, d.numero_exterior, d.numero_interior, d.colonia, d.codigo_postal, d.ciudad, d.estado
            FROM usuarios u
            LEFT JOIN direcciones d ON d.id_usuario = u.id_usuario
            WHERE u.id_usuario = ?;";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_usuario);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $usuario = mysqli_fetch_array($resultado);
    mysqli_stmt_close($stmt);

    if (!$usuario) {
        mysqli_close($con);
        header("Location: logout.php");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Lo que escribió el usuario
        $nombre = trim($_POST['nombre']);
        $correo = trim($_POST['correo']);
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
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
        $fecha = DateTime::createFromFormat("Y-m-d", $fecha_nacimiento);
        if (!$fecha || $fecha->format("Y-m-d") != $fecha_nacimiento || $fecha_nacimiento > date("Y-m-d")) {
            $errores[] = "La fecha de nacimiento no es válida.";
        }
        // La tarjeta es opcional: vacía significa conservar la actual
        if ($numero_tarjeta != "" && !preg_match("/^[0-9]{13,19}$/", $numero_tarjeta)) {
            $errores[] = "El número de tarjeta debe tener de 13 a 19 dígitos.";
        }
        if (!preg_match("/^[0-9]{5}$/", $codigo_postal)) {
            $errores[] = "El código postal debe tener 5 dígitos.";
        }
        if (!in_array($estado, $estados)) {
            $errores[] = "Selecciona un estado.";
        }

        // El correo no puede ser de otra cuenta (el propio sí se puede dejar igual)
        if (count($errores) == 0) {
            $stmt = mysqli_prepare($con, "SELECT id_usuario FROM usuarios WHERE correo = ? AND id_usuario != ?;");
            mysqli_stmt_bind_param($stmt, "si", $correo, $id_usuario);
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($resultado) > 0) {
                $errores[] = "Ya existe otra cuenta con ese correo.";
            }
            mysqli_stmt_close($stmt);
        }

        if (count($errores) == 0) {
            if ($numero_tarjeta == "") {
                $numero_tarjeta = $usuario['numero_tarjeta'];
            }
            // El interior vacío se guarda como NULL; se usa otra variable para que el
            // formulario no reciba un null si hay que volver a mostrarlo
            $interior_bd = $numero_interior;
            if ($interior_bd == "") {
                $interior_bd = null;
            }

            // Transacción: se actualizan los datos y la dirección, o nada
            mysqli_begin_transaction($con);
            try {
                $stmt = mysqli_prepare($con, "UPDATE usuarios SET nombre = ?, correo = ?, fecha_nacimiento = ?, numero_tarjeta = ? WHERE id_usuario = ?;");
                mysqli_stmt_bind_param($stmt, "ssssi", $nombre, $correo, $fecha_nacimiento, $numero_tarjeta, $id_usuario);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                if ($usuario['id_direccion']) {
                    $stmt = mysqli_prepare($con, "UPDATE direcciones SET calle = ?, numero_exterior = ?, numero_interior = ?, colonia = ?, codigo_postal = ?, ciudad = ?, estado = ? WHERE id_direccion = ?;");
                    mysqli_stmt_bind_param($stmt, "sssssssi", $calle, $numero_exterior, $interior_bd, $colonia, $codigo_postal, $ciudad, $estado, $usuario['id_direccion']);
                } else {
                    // Por si la cuenta no tenía dirección guardada
                    $stmt = mysqli_prepare($con, "INSERT INTO direcciones (id_usuario, calle, numero_exterior, numero_interior, colonia, codigo_postal, ciudad, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
                    mysqli_stmt_bind_param($stmt, "isssssss", $id_usuario, $calle, $numero_exterior, $interior_bd, $colonia, $codigo_postal, $ciudad, $estado);
                }
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                mysqli_commit($con);
                mysqli_close($con);

                // El nombre también se muestra desde la sesión
                $_SESSION['nombre'] = $nombre;

                header("Location: cuenta.php?guardado=1");
                exit;
            } catch (mysqli_sql_exception $e) {
                mysqli_rollback($con);
                $errores[] = "No se pudieron guardar los cambios. Intenta de nuevo.";
            }
        }
    } else {
        // Primera vez: el formulario se llena con los datos actuales.
        // Los campos de dirección pueden venir en NULL (número interior vacío o cuenta
        // sin dirección); con ?? "" se cambian por texto vacío, porque htmlspecialchars(null)
        // marca "Deprecated" en PHP 8.1 o más nuevo.
        $nombre = $usuario['nombre'];
        $correo = $usuario['correo'];
        $fecha_nacimiento = $usuario['fecha_nacimiento'];
        $calle = $usuario['calle'] ?? "";
        $numero_exterior = $usuario['numero_exterior'] ?? "";
        $numero_interior = $usuario['numero_interior'] ?? "";
        $colonia = $usuario['colonia'] ?? "";
        $codigo_postal = $usuario['codigo_postal'] ?? "";
        $ciudad = $usuario['ciudad'] ?? "";
        $estado = $usuario['estado'] ?? "";
    }

    mysqli_close($con);

    $titulo = "Editar mis datos";
    $pagina = "cuenta";
    include "includes/header.php";
?>

    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <a class="enlace-simple d-inline-block mb-4" href="cuenta.php">&larr; Volver a mi cuenta</a>
                <p class="etiqueta mb-1">Mi cuenta</p>
                <h1 class="mb-4">Editar mis datos</h1>

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

                <form class="tarjeta p-4" action="editar_cuenta.php" method="post">
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
                        <div class="col-12">
                            <label class="form-label" for="numero_tarjeta">Número de tarjeta</label>
                            <!-- No se muestra el número completo; vacío conserva la tarjeta actual -->
                            <input class="form-control" type="text" id="numero_tarjeta" name="numero_tarjeta" inputmode="numeric" pattern="[0-9]{13,19}" maxlength="19" placeholder="Tarjeta actual: •••• <?php echo substr($usuario['numero_tarjeta'], -4); ?>">
                            <div class="form-text">Déjalo vacío para conservar tu tarjeta actual.</div>
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

                    <div class="d-flex flex-column flex-sm-row gap-2 mt-4">
                        <button class="btn btn-musgo btn-lg flex-fill" type="submit">Guardar cambios</button>
                        <a class="btn btn-outline-carbon btn-lg flex-fill" href="cuenta.php">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

<?php include "includes/footer.php"; ?>
