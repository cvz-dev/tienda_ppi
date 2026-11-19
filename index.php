<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rebuild - Inicio</title>

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
                    <li class="nav-item"><a class="nav-link active" href="index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="catalogo.php">Catálogo</a></li>
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
                        <a class="btn btn-outline-carbon btn-lg mt-2 ms-2" href="#">Crear cuenta</a>
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
    </main>

    <footer class="footer-rebuild py-4">
        <div class="container text-center">
            <p class="mb-0">rebuild. Hardware hecho para durar.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
