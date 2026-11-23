<?php
    $titulo = "Crear cuenta";
    $pagina = "registro";
    include "includes/header.php";

    // Estados de México para la lista desplegable
    $estados = array(
        "Aguascalientes", "Baja California", "Baja California Sur", "Campeche", "Chiapas",
        "Chihuahua", "Ciudad de México", "Coahuila", "Colima", "Durango", "Estado de México",
        "Guanajuato", "Guerrero", "Hidalgo", "Jalisco", "Michoacán", "Morelos", "Nayarit",
        "Nuevo León", "Oaxaca", "Puebla", "Querétaro", "Quintana Roo", "San Luis Potosí",
        "Sinaloa", "Sonora", "Tabasco", "Tamaulipas", "Tlaxcala", "Veracruz", "Yucatán", "Zacatecas"
    );
?>

    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <p class="etiqueta mb-1">Únete a rebuild.</p>
                <h1 class="mb-4">Crear cuenta</h1>

                <!-- Por ahora el formulario solo se muestra; el registro se procesa en la siguiente fase -->
                <form class="tarjeta p-4" action="registro.php" method="post">
                    <h2 class="h5 mb-3">Datos personales</h2>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label" for="nombre">Nombre completo</label>
                            <input class="form-control" type="text" id="nombre" name="nombre" maxlength="100" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="correo">Correo electrónico</label>
                            <input class="form-control" type="email" id="correo" name="correo" maxlength="100" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="fecha_nacimiento">Fecha de nacimiento</label>
                            <input class="form-control" type="date" id="fecha_nacimiento" name="fecha_nacimiento" max="<?php echo date("Y-m-d"); ?>" required>
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
                            <input class="form-control" type="text" id="numero_tarjeta" name="numero_tarjeta" inputmode="numeric" pattern="[0-9]{13,19}" maxlength="19" required>
                            <div class="form-text">Solo números, sin espacios (de 13 a 19 dígitos).</div>
                        </div>
                    </div>

                    <h2 class="h5 mt-4 mb-3">Dirección de envío</h2>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label" for="calle">Calle</label>
                            <input class="form-control" type="text" id="calle" name="calle" maxlength="150" required>
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label" for="numero_exterior">Núm. exterior</label>
                            <input class="form-control" type="text" id="numero_exterior" name="numero_exterior" maxlength="10" required>
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label" for="numero_interior">Núm. interior</label>
                            <input class="form-control" type="text" id="numero_interior" name="numero_interior" maxlength="10" placeholder="Opcional">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="colonia">Colonia</label>
                            <input class="form-control" type="text" id="colonia" name="colonia" maxlength="100" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" for="codigo_postal">Código postal</label>
                            <input class="form-control" type="text" id="codigo_postal" name="codigo_postal" inputmode="numeric" pattern="[0-9]{5}" maxlength="5" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="ciudad">Ciudad</label>
                            <input class="form-control" type="text" id="ciudad" name="ciudad" maxlength="100" required>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label" for="estado">Estado</label>
                            <select class="form-select" id="estado" name="estado" required>
                                <option value="">Selecciona un estado</option>
                                <?php
                                    foreach ($estados as $estado) {
                                        echo "<option value='" . $estado . "'>" . $estado . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <button class="btn btn-musgo btn-lg w-100 mt-4" type="submit">Crear cuenta</button>
                    <!-- El enlace se conecta cuando exista login.php -->
                    <p class="text-center mt-3 mb-0">¿Ya tienes cuenta? <a class="enlace-simple" href="#">Inicia sesión</a></p>
                </form>
            </div>
        </div>
    </main>

<?php include "includes/footer.php"; ?>
