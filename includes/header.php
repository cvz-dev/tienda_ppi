<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rebuild - <?php echo htmlspecialchars($titulo); ?></title>

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
                    <li class="nav-item"><a class="nav-link <?php if ($pagina == "inicio") echo "active"; ?>" href="index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link <?php if ($pagina == "catalogo") echo "active"; ?>" href="catalogo.php">Catálogo</a></li>
                    <li class="nav-item"><a class="nav-link <?php if ($pagina == "contacto") echo "active"; ?>" href="contacto.php">Contacto</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">Carrito</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Iniciar sesión</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Crear cuenta</a></li>
                </ul>
            </div>
        </div>
    </nav>
