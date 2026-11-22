<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rebuild - Contacto</title>

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
                    <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="catalogo.php">Catálogo</a></li>
                    <li class="nav-item"><a class="nav-link active" href="contacto.php">Contacto</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">Carrito</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Iniciar sesión</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Crear cuenta</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-5">
        <p class="etiqueta mb-1">Estamos para ayudarte</p>
        <h1 class="mb-4">Contacto</h1>

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="tarjeta p-4 h-100">
                    <h2 class="h4">Sobre rebuild.</h2>
                    <p>
                        rebuild. es una tienda de hardware modular. Vendemos laptops, PCs y teléfonos
                        que se pueden abrir, reparar y mejorar por partes, además de los módulos y
                        repuestos para hacerlo.
                    </p>
                    <p class="mb-0">
                        Creemos que un equipo bien hecho debe durar años. Por eso cada producto usa
                        tornillos estándar, piezas que se consiguen por separado y guías de reparación
                        abiertas.
                    </p>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="tarjeta p-4 h-100">
                    <h2 class="h4">Datos de contacto</h2>
                    <table class="table detalle-ficha mb-0">
                        <tr>
                            <th>Correo</th>
                            <td>contacto@rebuild.mx</td>
                        </tr>
                        <tr>
                            <th>Teléfono</th>
                            <td>55 1234 5678</td>
                        </tr>
                        <tr>
                            <th>Horario</th>
                            <td>Lunes a viernes, 9:00 a 18:00</td>
                        </tr>
                        <tr>
                            <th>Taller</th>
                            <td>Av. Presidente Masaryk 250, Polanco V Sección, Miguel Hidalgo, 11560, Ciudad de México</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <h2 class="h4 mt-5 mb-3">Preguntas frecuentes</h2>
        <div class="accordion" id="preguntas">
            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#pregunta1">
                        ¿Hacen envíos a todo el país?
                    </button>
                </h3>
                <div id="pregunta1" class="accordion-collapse collapse show" data-bs-parent="#preguntas">
                    <div class="accordion-body">
                        Sí. Los pedidos salen en 1 a 2 días hábiles y llegan en 3 a 5 días según la ciudad.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pregunta2">
                        ¿Qué garantía tienen los productos?
                    </button>
                </h3>
                <div id="pregunta2" class="accordion-collapse collapse" data-bs-parent="#preguntas">
                    <div class="accordion-body">
                        Los equipos nuevos tienen dos años de garantía y los reacondicionados un año.
                        Cambiar un módulo por tu cuenta no anula la garantía.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pregunta3">
                        ¿Necesito herramientas especiales para reparar mi equipo?
                    </button>
                </h3>
                <div id="pregunta3" class="accordion-collapse collapse" data-bs-parent="#preguntas">
                    <div class="accordion-body">
                        No. Con el desarmador del kit de herramientas rebuild. se abren todos nuestros equipos.
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer-rebuild py-4">
        <div class="container text-center">
            <p class="mb-0">rebuild. Hardware hecho para durar.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
